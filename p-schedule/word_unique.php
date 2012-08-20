<?php
/**
 * word_unique.php
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /p-schedule/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */

require_once dirname(dirname(__FILE__))."/p-config/application-setter.php";

$db_obj = LMDBAccess::getInstance();

$select_sql = "SELECT lt.* FROM lyrics_term_combine lt LEFT JOIN lyrics_stop_word_mapping ls ON (lt.term=ls.stop_word) WHERE ls.stop_word IS NULL AND lt.pos!='DET' ORDER BY lt.id";

$query_result = $db_obj->selectCommand($select_sql);

foreach ($query_result as $query_result_data) {

   $id = $query_result_data['id'];
   $song_id = $query_result_data['song_id'];
   $term = $query_result_data['term'];
   $pos = $query_result_data['pos'];
   $offset = $query_result_data['offset'];
   $length = $query_result_data['length'];

   $insert_sql = "INSERT INTO lyrics_term_remove_stop_word (song_id,term,pos,offset,length,create_time,modify_time) VALUES ('".addslashes($song_id)."', '".addslashes($term)."', '".addslashes($pos)."', '$offset', '$length', NOW(), NOW())";
   $query_result3 = $db_obj->insertCommand($insert_sql);

}// end foreach ($query_result as $query_result_data) {


require_once SITE_ROOT."/p-config/application-unsetter.php";

?>