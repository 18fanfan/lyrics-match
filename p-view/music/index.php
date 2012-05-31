<?php
/**
 * index.php is the /music/index.php content
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /music/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */
?>
<div id='song-list-block'>
   <table class="table table-bordered table-striped">
      <thead>
         <tr>
            <th style="width:20px">
               id
            </th>
            <th style="width:100px">
               歌名
            </th>
            <th style="width:100px">
               歌詞
            </th>
            <th style="width:20px">
               類型
            </th>
            <th style="width:20px">
               發行日期
            </th>
            <th style="width:100px">
               midi 網址
            </th>
            <th style="width:100px">
               kkbox 網址
            </th>
         </tr>
      </thead>
      <tbody id="song-list-tbody">
         <?php
         $offset = 0;
         $length = 30;

         require SITE_ROOT."/ajax-action/SongActionView/song-list.php";

         ?>
      </tbody>
   </table>
   <div id="song-show-more" class="show-more margin-top-1">
      <a data-length="30">
         顯示更多
      </a>
   </div>
</div>
<script>
$.get("sarasti.cs.nccu.edu.tw/?url=www.google.com", function(response) {
    alert(response)
});
</script>