(($) => {
  $(document).ready(function() {

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

  });
})(jQuery);
