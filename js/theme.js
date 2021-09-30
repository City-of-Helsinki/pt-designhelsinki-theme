(function($) {

  $(document).ready(function() {




    $('.home .current-menu-item a').css('font-family', 'HelsinkiGrotesk-Regular, Georgia, sans-serif');



    $(".search-open").click(function() {


      $('.search-box').attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });

    // $('.search-box').toggle('fast');
    $('.search-box').addClass('open');
    $('#s').focus();
    $(".search-open").blur(); 
    $('.search-open .fa-search, .search-open .fa-times').toggle();
  });


    $('.search-open').keypress(function (e) {
     var key = e.which;
     if(key == 13)  {
       $('.search-open').click();
       $(this).addClass('remove-focus');
       // return false;  
     }
   });



    $(".menu-toggle").click( function (){
      $(this).next().toggleClass("open");
      $(this).toggleClass("open");

      $(this).children().toggleClass("hds-icon--angle-up");

      $(this).attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });

    });


    // Owl Carousel DOM Elements
    var carousel1 = '#sync1';
    var carousel2 = '#sync2';

  // Initialize plugin
  var owlCarousel1 = $(carousel1).owlCarousel({
    items: 1,
    margin: 10,
    nav: true,
    navText: ['<div class="hds-icon hds-icon--size-xl hds-icon--arrow-left">', '<div class="hds-icon hds-icon--size-xl hds-icon--arrow-right">'],
  });
  var owlCarousel2 = $(carousel2).owlCarousel({
    items: 5,
    margin: 10,
  });

  // Sync carousel & add current class
  carouselSyncCurrentClass();

  // On carousel change: Sync carousel & add current class
  owlCarousel1.on('changed.owl.carousel', function() {
    carouselSyncCurrentClass();
  });
  owlCarousel2.on('changed.owl.carousel', function(event) {
    carouselSyncCurrentClass();
  });

  // Thumbs switch click event.
  owlCarousel2.find('.item').click(function () {
    var itemIndex = $(this).parent().index();
    owlCarousel1.trigger('to.owl.carousel', itemIndex);
    carouselSyncCurrentClass();
  });


  function carouselSyncCurrentClass() {
    setTimeout(function () {
      var carousel1ActiveIndex = $('#sync1 .owl-item.active').index();
      $('#sync2 .owl-item').removeClass('current');
      var currentItem = $('#sync2 .owl-item:nth-child('+(carousel1ActiveIndex+1)+')');
      currentItem.addClass('current');

      if(!currentItem.hasClass('active')){
        if(currentItem.prevAll('.active').length > 0){
          owlCarousel2.trigger('next.owl.carousel');
        }
        if(currentItem.nextAll('.active').length){
          owlCarousel2.trigger('prev.owl.carousel');
        }
      }
    }, 100);
  }


  $('#uutiset button.load-more').click(function(){
    var button = $(this);
    var uutisetItemsVisible = $('#uutiset div.columns a').length;
    var posts_per_page = $('#uutiset').data("amount");
    var currentCat = $('#uutiset').attr('data-category');
    console.log(currentCat);
    $.ajax({ 
      url :ajax_params.ajax_url, 
      data : {action: "loadmore", "uutisetItemsVisible": uutisetItemsVisible, "catName": currentCat, "amount": posts_per_page},
      type : 'POST',
      dataType : "html",
      beforeSend : function ( xhr ) {
        button.text('Ladataan...'); 
      },
      success : function( data ){
        if( data && data != 0) { 
          $("#uutiset div.columns").append(data);
          if($('#uutiset div.columns a').length % uutisetItemsVisible != 0){
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

}(jQuery));