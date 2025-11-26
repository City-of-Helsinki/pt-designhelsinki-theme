(($) => {
  $(document).ready(function() {

    $('#uutiset button.load-more').click(function(){
      var button = $(this);
      var uutisetItemsVisible = $('#uutiset div.columns a').length;
      var posts_per_page = $('#uutiset').data("amount");
      var currentCat = $('#uutiset').attr('data-category');

      $.ajax({
        url : DesignHelsinkiAjax.ajax_url,
        data : {action: "loadmore", "uutisetItemsVisible": uutisetItemsVisible, "catName": currentCat, "amount": posts_per_page},
        type : 'POST',
        dataType : "html",
        beforeSend : function ( xhr ) {
          button.text('Ladataan...');
        },
        success : function( data ){
          if( data && data != 0) {
            $("#uutiset div.columns").append(data);
            if($('#uutiset div.columns a').length = 0){
              button.remove();
            } else {
              button.text( 'Lataa lisää' );
            }
          } else {
            button.remove();
          }
        }
      });
    });

  });
})(jQuery);
