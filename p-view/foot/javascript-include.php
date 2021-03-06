<script>

   function nl2br( str ) {
      return str.replace(/([^>])\n/g, '$1<br/>\n');
   }


   // start song load more
   var song_offset = 0;
   function moreSong() {

      var action_url = '<?=SITE_HOST?>/ajax-action/song-action/song-list';
      song_offset = song_offset+30;

      if ($('#song-show-more').length != 0) {
         $.ajax({
            url: action_url,
            type: "GET",
            data: {offset : song_offset, length : $("#song-show-more > a").attr("data-length"), song_list_type : $("#song-show-more > a").attr("data-list-type")},
            dataType: "html",
            beforeSend: function( xhr ) {
               $('#system-message').html('Processing...');
               $('#system-message').show();
               $(window).off('scroll.song_show_more');
            },
            success: function( html_block ) {
               $('#song-list-tbody').append(html_block);
               $('#system-message').html('Complete');
               $('#system-message').fadeOut();
               $(window).on('scroll.song_show_more', function(){
                  if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                     moreSong();
                  }
               });
            }
         });
      }
   }

   $('#song-show-more').live('click.song_show_more', function() {
      moreSong();
   });

   $(window).on('scroll.song_show_more', function(){
      if ($(window).scrollTop() == $(document).height() - $(window).height()) {
         moreSong();
      }
   });
   // end song load more

   // start upload audio box
   $('a.upload-audio-link').live('click.upload_audio_box', function() {

      var song_id = $(this).attr("data-songid");
      $.ajax({
         url: '<?=SITE_HOST?>/ajax-action/box-action/upload-audio-form',
         type: "GET",
         data: {song_id : song_id},
         dataType: "html",
         beforeSend: function( xhr ) {
         },
         success: function( html_block ) {
            $('#p-modal-block').html(html_block);
         }
      });

   });
   // end upload audio box

   // start upload midi box
   $('a.upload-midi-link').live('click.upload_midi_box', function() {

      var song_id = $(this).attr("data-songid");
      $.ajax({
         url: '<?=SITE_HOST?>/ajax-action/box-action/upload-midi-form',
         type: "GET",
         data: {song_id : song_id},
         dataType: "html",
         beforeSend: function( xhr ) {
         },
         success: function( html_block ) {
            $('#p-modal-block').html(html_block);
         }
      });

   });
   // end upload midi box

   // start edit lyric box
   $('a.edit-lyric-link').live('click.edit_lyric_box', function() {

      var song_id = $(this).attr("data-songid");
      $.ajax({
         url: '<?=SITE_HOST?>/ajax-action/box-action/edit-lyric-form',
         type: "GET",
         data: {song_id : song_id},
         dataType: "html",
         beforeSend: function( xhr ) {
         },
         success: function( html_block ) {
            $('#p-modal-block').html(html_block);
         }
      });

   });
   // end upload audio box

   // start header login logout
   $('#header-login').live('click.login_box', function() {

      $.ajax({
         url: '<?=SITE_HOST?>/ajax-action/box-action/login-form',
         type: "GET",
         data: {},
         dataType: "html",
         beforeSend: function( xhr ) {
         },
         success: function( html_block ) {
            $('#p-modal-block').html(html_block);
         }
      });

   });

   $('#header-logout').live('click.logout', function() {

      $.ajax({
         url: '<?=SITE_HOST?>/ajax-action/auth-action/logout',
         type: "POST",
         data: {},
         dataType: "json",
         beforeSend: function( xhr ) {
         },
         success: function( responseText ) {
            if(responseText.response.status.code==0){
               window.location.reload();
            }
         }
      });

   });
   // end header login logout
</script>