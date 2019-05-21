
jQuery(document).ready(function($){

  // a slick slider
  const sliders = document.getElementsByClassName("slider");

  if (sliders.length) {
    for (let i = 0; i < sliders.length; i++) {
      console.log(sliders[i]);
      if (sliders[i].classList.contains('slider-single')) {
        $(sliders[i]).slick({
          infinite: true,
          slidesToShow: 1,
          autoplay: true
        });
      } else if (sliders[i].classList.contains('slider-multi')) {
        $(sliders[i]).slick({
          lazyLoad: 'ondemand',
          dots: true,
          infinite: true,
          slidesToShow: 3,
          autoplay: true,
          centerMode: true,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            }
          ]
        });
      }
    }
  }



  $('.lightbox a').fancybox({
    caption : function() {
      let caption = $(this).next('figcaption').text() !== '' ? $(this).next('figcaption').text() : $(this).children('img').attr('alt')  ;
      caption = ( caption.length ? caption : 'No caption' );

      return caption;
    }
  });


  if ($('.lightbox-gallery')) {

    $('.blocks-gallery-item').click(function() {

      let galleryImages = $(this).parent().find('a');
      let gallery = [];

      galleryImages.each(function( index, galleryItem ) {

        var caption = $(this).parent().find('figcaption') ?  $(this).find('img').attr('alt') : $(this).parent().find('figcaption')  ;

        gallery.push({
          src : galleryItem.href,
          opts : {
            caption: caption + '<br/><span class="fancybox-counter"><span data-fancybox-index></span> of <span data-fancybox-count></span></span>'
          }
        })
      });

      $.fancybox.open( gallery, { loop: false }, $(this).index() );

      return false;
    });
  }


});