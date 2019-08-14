(function($) {

	jQuery(document).ready(function(){
    jQuery('.field-row input[type=checkbox]').checkradios();

    jQuery('.checkradios-checkbox').click(function() {
      setTimeout(function(){
        jQuery('#filterform').submit();
        jQuery('html,body').animate({scrollTop:jQuery('#result').offset().top}, 500);
      },3000); 
    });
    ws_filter_ajx();
    jQuery('#tagsfield, #catsfield').click(function(e) {
      setTimeout(function(){
        jQuery('#filterform').submit();
        jQuery('html,body').animate({scrollTop:jQuery('#result').offset().top}, 500);
      },3000); 
    });

    jQuery('#filterform').submit(function(){
      ws_filter_ajx();
      return false;
    });

    function ws_filter_ajx() {
      var filter = jQuery('#filterform');
      if( filter ) {
        $.ajax({
          url:filter.attr('action'),
          data:filter.serialize(), // form data
          type:filter.attr('method'), // POST
          cache: false,
          beforeSend: function() {
            jQuery('.loader2').show();
          },
          complete: function(){
            setTimeout(function(){ 
              //jQuery('.latest-news-list').matchHeight({ property: 'min-height' });
              jQuery('.loader2').hide();
            },
            2000);
          },
          success:function(data){
            jQuery('#result').html(data);
            jQuery('.page-numbers').not('.next, .prev, .rem-ajax .page-numbers').click(function(e) {
              e.preventDefault();
              var val = jQuery(this).text();
              jQuery('#pagival').val(val);
              jQuery('#filterform').submit();
              jQuery('html,body').animate({scrollTop:jQuery('#result').offset().top}, 500);
            });

            jQuery('.next, .prev, .rem-ajax .next, .rem-ajax .prev').click(function(e) {
              e.preventDefault();
              var pagival = $('#pagival');
              var pagifinal = pagival.val();
              if( jQuery(this).hasClass('next') ) {
                var pagiresult = parseInt(pagifinal) + 1;
                pagival.val(pagiresult);
              }
              else if( jQuery(this).hasClass('prev') ) {
                var pagiresult = parseInt(pagifinal) - 1;
                pagival.val(pagiresult);
              }

              jQuery('#filterform').submit();
              jQuery('html,body').animate({scrollTop:jQuery('#filterform').offset().top}, 500);
            });
          },
          async: "false",

        });
      }

    }

	});

})(jQuery);