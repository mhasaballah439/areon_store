/*--------------*/
// Main/Product image slider for product page
$('.product-info .main-img-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    fade:true,
    autoplay: true,
    autoplaySpeed: 4000,
    speed: 1000,
    loop:true,
    lazyLoad: 'ondemand',
    asNavFor: '.thumb-nav',
    prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left text-dark"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
    nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right text-dark"></i><span class="sr-only sr-only-focusable">Next</span></div>'
  });
  // Thumbnail/alternates slider for product page
  $('.thumb-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    centerPadding: '0px',
    asNavFor: '.main-img-slider',
    dots: false,
    centerMode: false,
    draggable: true,
    loop:true,
    speed:1000,
    focusOnSelect: true,
    prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left text-dark"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
    nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right text-dark"></i><span class="sr-only sr-only-focusable">Next</span></div>'
 });


  //keeps thumbnails active when changing main image, via mouse/touch drag/swipe
  $('.main-img-slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
    //remove all active class
    $('.thumb-nav .slick-slide').removeClass('slick-current');
    //set active class for current slide
    $('.thumb-nav .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');
  });




/*end */


$('.plus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('.number').find('input');
    var priceValue = $(this).parents('.wrap_price').find('#priceItem').attr("price");
    var price = $(this).parents('.wrap_price').find('#priceItem');
    var delPrice = $(this).parents('.wrap_price').find('#delprice');
    var value = parseInt($input.val());

    if (value < 100) {
        value = value + 1;
    } else {
        value = 100;
    }

    $input.val(value);
    price.text( Number(priceValue * $input.val()).toFixed(2));
    delPrice.text( Number((priceValue*1.5) * $input.val()).toFixed(2));

});

$('.minus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('.number').find('input');
    var priceValue = $(this).parents('.wrap_price').find('#priceItem').attr("price");
    var price = $(this).parents('.wrap_price').find('#priceItem');
    var delPrice = $(this).parents('.wrap_price').find('#delprice');
    var value = parseInt($input.val());

    if (value > 2) {
        value = value - 1;
    } else {
        value = 1;
    }

    $input.val(value);
    price.text( Number(priceValue * $input.val()).toFixed(2));
    delPrice.text( Number((priceValue*1.5) * $input.val()).toFixed(2));
});