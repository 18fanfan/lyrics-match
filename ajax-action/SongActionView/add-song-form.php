<?php
/**
 * add-song-form.php is the add song form
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /ajax-action/SongActionView
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */

?>
<form id="add-song-post-form" class="form-horizontal">
   <fieldset>
      <div class="control-group">
         <label class="control-label" for="artist-name">
            藝人名稱
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="artist-name" name="artist_name" value="<?=$artist_name?>" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="artist-kkbox-url">
            藝人 kkbox 網址
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="artist-kkbox-url" name="artist_kkbox_url" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="disc-title">
            專輯名稱
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="disc-title" name="disc_title" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="disc-kkbox-url">
            專輯 kkbox 網址
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="disc-kkbox-url" name="disc_kkbox_url" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="genre">
            音樂類型
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="genre" name="genre" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="release-date">
            發行日期
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="release-date" name="release_date" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="disc-cover">
            專輯封面網址
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="disc-cover" name="disc_cover" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="song-title">
            歌曲名稱
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="song-title" name="song_title" value="<?=$song_title?>" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="song-kkbox-url">
            歌曲 kkbox 網址
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="song-kkbox-url" name="song_kkbox_url" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="lyricist">
            作詞
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="lyricist" name="lyricist" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="composer">
            作曲
         </label>
         <div class="controls">
            <input type="text" class="input-xlarge span7" id="composer" name="composer" />
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="lyric">
            歌詞
         </label>
         <div class="controls">
           <textarea class="input-xlarge span7" id="lyric" name="lyric" rows="30"></textarea>
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="have_english">
            是否有英文
         </label>
         <div class="controls">
            <label class="checkbox">
               <input type="checkbox" id="have_english" name="have_english">
            </label>
         </div>
      </div>
      <div class="form-actions">
         <button type="submit" class="btn btn-primary">
            儲存歌曲
         </button>
      </div>
   </fieldset>
</form>