<?php
/**
 * music_audio_word_matrix_generate.php
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

$select_sql = "SELECT ".
              "id ".
              "FROM song ".
              "WHERE is_deleted = '0' ".
              "AND audio_path!='' ".
              "AND echonest_track_id!='' ".
              "AND retrieval_status='success' ".
              "ORDER BY id";

$query_result = $db_obj->selectCommand($select_sql);

$music_feature_god = new LMMusicFeatureGod();

// get unprocess data
foreach ($query_result as $query_result_data) {

   echo "song_id: ".$query_result_data['id']." \n";

   $song_obj = new LMSong($query_result_data['id']);
   $echonest_analysis_file = AUDIO_ROOT.'/'.$song_obj->getId().'.json';
   $echonest_analysis = file_get_contents($echonest_analysis_file);
   $echonest_data = json_decode($echonest_analysis);

   $song_section_array = array();
   foreach ($echonest_data->bars as $section_data) {
      array_push($song_section_array, $section_data->start);
   }
   array_push($song_section_array, 100000);

   $song_audio_word_array = array();
   $song_audio_word_count_array = array();

   $song_audio_word_timbre_array = array();
   $song_audio_word_count_timbre_array = array();

   foreach ($echonest_data->segments as $segments_data) {

      $pitch_start = $segments_data->start;

      foreach ($song_section_array as $key => $section_start) {

         if ($section_start!=100000) {

            if ($pitch_start>=$section_start && $pitch_start<$song_section_array[$key+1]) {

               $song_audio_word_array[$key][0] = $song_audio_word_array[$key][0]+$segments_data->pitches[0];
               $song_audio_word_array[$key][1] = $song_audio_word_array[$key][1]+$segments_data->pitches[1];
               $song_audio_word_array[$key][2] = $song_audio_word_array[$key][2]+$segments_data->pitches[2];
               $song_audio_word_array[$key][3] = $song_audio_word_array[$key][3]+$segments_data->pitches[3];
               $song_audio_word_array[$key][4] = $song_audio_word_array[$key][4]+$segments_data->pitches[4];
               $song_audio_word_array[$key][5] = $song_audio_word_array[$key][5]+$segments_data->pitches[5];
               $song_audio_word_array[$key][6] = $song_audio_word_array[$key][6]+$segments_data->pitches[6];
               $song_audio_word_array[$key][7] = $song_audio_word_array[$key][7]+$segments_data->pitches[7];
               $song_audio_word_array[$key][8] = $song_audio_word_array[$key][8]+$segments_data->pitches[8];
               $song_audio_word_array[$key][9] = $song_audio_word_array[$key][9]+$segments_data->pitches[9];
               $song_audio_word_array[$key][10] = $song_audio_word_array[$key][10]+$segments_data->pitches[10];
               $song_audio_word_array[$key][11] = $song_audio_word_array[$key][11]+$segments_data->pitches[11];

               $song_audio_word_count_array[$key] = $song_audio_word_count_array[$key]+1;
            }

         }

      }

   }// end foreach ($echonest_data->segments as $segments_data)

   //print_r($song_audio_word_array);
   //print_r($song_audio_word_count_array);

   foreach ($song_audio_word_array as $key => $value) {
      $song_audio_word_array[$key][0] = $song_audio_word_array[$key][0]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][1] = $song_audio_word_array[$key][1]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][2] = $song_audio_word_array[$key][2]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][3] = $song_audio_word_array[$key][3]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][4] = $song_audio_word_array[$key][4]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][5] = $song_audio_word_array[$key][5]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][6] = $song_audio_word_array[$key][6]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][7] = $song_audio_word_array[$key][7]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][8] = $song_audio_word_array[$key][8]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][9] = $song_audio_word_array[$key][9]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][10] = $song_audio_word_array[$key][10]/$song_audio_word_count_array[$key];
      $song_audio_word_array[$key][11] = $song_audio_word_array[$key][11]/$song_audio_word_count_array[$key];
   }

   //print_r($song_audio_word_array);
   //print_r($song_audio_word_count_array);

   foreach ($echonest_data->segments as $segments_data) {

      $timbre_start = $segments_data->start;

      foreach ($song_section_array as $key => $section_start) {

         if ($section_start!=100000) {

            if ($timbre_start>=$section_start && $timbre_start<$song_section_array[$key+1]) {

               $song_audio_word_timbre_array[$key][0] = $song_audio_word_timbre_array[$key][0]+$segments_data->timbre[0];
               $song_audio_word_timbre_array[$key][1] = $song_audio_word_timbre_array[$key][1]+$segments_data->timbre[1];
               $song_audio_word_timbre_array[$key][2] = $song_audio_word_timbre_array[$key][2]+$segments_data->timbre[2];
               $song_audio_word_timbre_array[$key][3] = $song_audio_word_timbre_array[$key][3]+$segments_data->timbre[3];
               $song_audio_word_timbre_array[$key][4] = $song_audio_word_timbre_array[$key][4]+$segments_data->timbre[4];
               $song_audio_word_timbre_array[$key][5] = $song_audio_word_timbre_array[$key][5]+$segments_data->timbre[5];
               $song_audio_word_timbre_array[$key][6] = $song_audio_word_timbre_array[$key][6]+$segments_data->timbre[6];
               $song_audio_word_timbre_array[$key][7] = $song_audio_word_timbre_array[$key][7]+$segments_data->timbre[7];
               $song_audio_word_timbre_array[$key][8] = $song_audio_word_timbre_array[$key][8]+$segments_data->timbre[8];
               $song_audio_word_timbre_array[$key][9] = $song_audio_word_timbre_array[$key][9]+$segments_data->timbre[9];
               $song_audio_word_timbre_array[$key][10] = $song_audio_word_timbre_array[$key][10]+$segments_data->timbre[10];
               $song_audio_word_timbre_array[$key][11] = $song_audio_word_timbre_array[$key][11]+$segments_data->timbre[11];

               $song_audio_word_count_timbre_array[$key] = $song_audio_word_count_timbre_array[$key]+1;
            }

         }

      }

   }// end foreach ($echonest_data->segments as $segments_data)

   foreach ($song_audio_word_array as $key => $value) {
      $song_audio_word_timbre_array[$key][0] = $song_audio_word_timbre_array[$key][0]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][1] = $song_audio_word_timbre_array[$key][1]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][2] = $song_audio_word_timbre_array[$key][2]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][3] = $song_audio_word_timbre_array[$key][3]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][4] = $song_audio_word_timbre_array[$key][4]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][5] = $song_audio_word_timbre_array[$key][5]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][6] = $song_audio_word_timbre_array[$key][6]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][7] = $song_audio_word_timbre_array[$key][7]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][8] = $song_audio_word_timbre_array[$key][8]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][9] = $song_audio_word_timbre_array[$key][9]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][10] = $song_audio_word_timbre_array[$key][10]/$song_audio_word_count_timbre_array[$key];
      $song_audio_word_timbre_array[$key][11] = $song_audio_word_timbre_array[$key][11]/$song_audio_word_count_timbre_array[$key];
   }

   //print_r($song_audio_word_timbre_array);
   //print_r($song_audio_word_count_timbre_array);

   $pitch_audio_word = json_encode($song_audio_word_array);
   $timbre_audio_word = json_encode($song_audio_word_timbre_array);

   $music_feature_id = $music_feature_god->findBySongId($song_obj->getId());
   if ($music_feature_id) {
      $music_feature_obj = new LMMusicFeature($music_feature_id);

      $music_feature_obj->pitch_audio_word = $pitch_audio_word;
      $music_feature_obj->timbre_audio_word = $timbre_audio_word;
      if ($music_feature_obj->save()) {
         echo "update music feature success \n";
      } else {
         echo "update music feature fail \n";
      }

   }

   unset($song_obj);
}

unset($music_feature_god);

require_once SITE_ROOT."/p-config/application-unsetter.php";

?>
