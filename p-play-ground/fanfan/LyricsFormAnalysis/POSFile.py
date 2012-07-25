#-*- coding: utf-8 -*-

class Chinese2POS:

	def __init__(self, posSavePath, lenSavePath):
		self.__posSavePath = posSavePath
		self.__lenSavePath = lenSavePath

	
	def process(self, filePath):
		from Tokenizer import Tokenizer
		import codecs


		fileName = filePath[filePath.rindex('/') + 1:]
		tk = Tokenizer()

		ofp = codecs.open(filePath, 'r', 'utf-8')
		lines = ofp.readlines()
		ofp.close()

		if lines[0][0] == unicode(codecs.BOM_UTF8):
			lines[0] = lines[0][1:]
	

		pfp = codecs.open(self.__posSavePath + fileName, 'w', 'utf-8')
		lfp = codecs.open(self.__lenSavePath + fileName, 'w', 'utf-8')


		for line in lines:
			tempLine = line.strip('\r\n')
			tempLine = tempLine.strip(' ')
			sentences = tempLine.split(' ')

			if sentences[0] == '':
				pfp.write('\r\n')
				lfp.write('\r\n')
				continue


			for i in range(len(sentences)):
				

				tokenList = tk.ckip((sentences[i].strip(' ')))

				posList = []
				lenList = []

				for token in tokenList:
					posList.append(token["pos"])
					lenList.append(str(len(token["term"])))


				posStr = ''
				lenStr = ''


				if i == 0 and len(sentences) == 1:
					posStr = ','.join(posList)
					lenStr = ','.join(lenList)
				elif i == 0:
					posStr = ','.join(posList) + ','
					lenStr = ','.join(lenList) + ','
				elif i == len(sentences) - 1:
					posStr = ',' + ','.join(posList)
					lenStr = ',' + ','.join(lenList)
				else:
					posStr = ',' + ','.join(posList) + ','
					lenStr = ',' + ','.join(lenList) + ','

				pfp.write(posStr)
				lfp.write(lenStr)


			pfp.write('\r\n')
			lfp.write('\r\n')


		pfp.close()
		lfp.close()
		print "Chinese2POS: %s Write Done!!" % fileName


