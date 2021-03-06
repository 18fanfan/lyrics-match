#!/usr/bin/python
# -*- coding:utf-8 -*-
#
# generate_lyrics_feature_model.py to generate lyrics feature model
#
# Python version 2.6.8
#
# @category Python
# @package  /p-library/model/
# @author   Fukuball Lin <fukuball@gmail.com>
# @license  No Licence
# @version  Release: <1.0>
# @link     http://sarasti.cs.nccu.edu.tw
#
# hard code

import sys
import numpy as np
import MySQLdb as mysql
import json
import nimfa
import scipy.sparse
from scipy import sparse
from sparsesvd import sparsesvd
np.set_printoptions(threshold=np.nan)

sys.path.append("/Users/Fukuball/localhost/lyrics-match/p-library/model")
import ImportPath
ImportPath.Import()

import db_stage
CONST = db_stage._Const()

# connect to db
db = mysql.connect(host    = CONST.DBHOST,
                   user    = CONST.DBUSER,
                   passwd  = CONST.DBPASS,
                   db      = CONST.DBNAME,
                   charset = 'UTF8')

# 從資料庫抓資料
cur = db.cursor()
cur.execute("SET NAMES UTF8")
cur.execute("SET CHARACTER_SET_CLIENT=UTF8")
cur.execute("SET CHARACTER_SET_RESULTS=UTF8")
db.commit()

cur.execute("SELECT * FROM lyrics_feature_matrix WHERE id=12")


lyrics_feature_matrix = ""
row_song_id = ""
column_lyrics_feature = ""
create_time = ""
modify_time = ""

for row in cur.fetchall() :
   lyrics_feature_matrix = row[1]
   row_song_id = row[2]
   column_lyrics_feature = row[3]
   create_time = row[6]
   modify_time = row[7]

# lyrics feature matrix
# model
A_lyrics_feature_matrix = np.matrix(json.loads(lyrics_feature_matrix))

print "matrix formed"
#print A_lyrics_feature_matrix
print( "matrix shape --> %d rows x %d columns" % A_lyrics_feature_matrix.shape )


# MF decomposition
# Run LSNMF rank 3 algorithm
# We don't specify any algorithm specific parameters. Defaults will be used.
# We don't specify initialization method. Algorithm specific or random initialization will be used.
# In LSNMF case, by default random is used.
# Returned object is fitted factorization model. Through it user can access quality and performance measures.
# The fctr_res's attribute `fit` contains all the attributes of the factorization.
fctr = nimfa.mf(A_lyrics_feature_matrix, method = "lsnmf", max_iter = 10, rank = 20)
fctr_res = nimfa.mf_run(fctr)

# Basis matrix. It is sparse, as input V was sparse as well.
W = fctr_res.basis()
print "Basis matrix"
print W

# Mixture matrix. We print this tiny matrix in dense format.
H = fctr_res.coef()
print "Coef"
print H

# Print estimate of target matrix V
print "Estimate"
A_bar_lyrics_feature_matrix = np.dot(W, H)
print A_bar_lyrics_feature_matrix
print( "matrix shape --> %d rows x %d columns" % A_bar_lyrics_feature_matrix.shape )

#A_bar_list = A_bar_lyrics_feature_matrix.tolist()
#A_bar_string = json.dumps(A_bar_list)
#
#print "matrix dump"

#file_name = 'lyrics-model-13.txt'
#f = open(file_name, 'w')
#f.write(A_bar_string)
#f.close()
#
#cur = db.cursor()
#try:
#   cur.execute("""INSERT INTO lyrics_feature_matrix (matrix, row_song_id, column_lyrics_feature, type, create_time, modify_time) VALUES (%s, %s, %s, %s, %s, %s)""",(file_name, row_song_id, column_lyrics_feature, "model", create_time, modify_time))
#   db.commit()
#   print "success"
#except mysql.Error, e:
#   db.rollback()
#   print "An error has been passed. %s" %e
#
#print "save in db"
#
#
#cur.close()
#db.close()
