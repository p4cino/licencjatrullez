$(function() {
  Alert = {
    show: function($div, msg) {
      $div.find('.alert-msg').text(msg);
      if ($div.css('display') === 'none') {
        // fadein, fadeout.
        $div.fadeIn(1000).delay(2000).fadeOut(2000);
      }
    },
    info: function(msg) {
      this.show($('#alert-info'), msg);
    },
    warn: function(msg) {
      this.show($('#alert-warn'), msg);
    }
  }
  $('body').on('click', '.alert-close', function() {
  	$(this).parents('.alert').hide();
  });
  $('#info').click(function() {
    Alert.info('This is infomation alert.')
  });
  $('#warn').click(function() {
    Alert.warn('This is warning alert.')
  });
});