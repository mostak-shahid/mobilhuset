jQuery(document).ready(function ($) {
    $('.header-category-menu .wp-block-navigation__responsive-container-open').on('click', function(){
        $(this).css('opacity', 0);
    });
    $('.header-category-menu .wp-block-navigation__responsive-container-close').on('click', function(){
        $('.header-category-menu .wp-block-navigation__responsive-container-open').css('opacity', 1);
    });
    // $('.single-product .flex-control-thumbs .img-product-thumbnail').on('click', function(e){
    //     var source = $(this).data('main-source');
    //     $(this).closest('.woocommerce-product-gallery__wrapper').find('a').attr('href', source);
    //     //$(this).closest('.woocommerce-product-gallery__wrapper').find('a').html($(this));
    //     console.log($(this).data('main-source'));        
    // });
    Fancybox.bind(".woocommerce-product-gallery__image a, [data-fancybox]", {
        Thumbs: {
          autoStart: false,
        },
    });
    $('.single-product .flex-control-thumbs').owlCarousel({
        loop:false,
        items:4,
        margin:10,
        nav: true,
        dots: false,
    });
//    $(window).scroll(function () {
//        if ($(this).scrollTop() > 100) {
//            $('.main-header').addClass('tiny');
//            $('.scrollup').fadeIn();
//        } else {
//            $('.main-header').removeClass('tiny');
//            $('.scrollup').fadeOut();
//        }
//    });
//    $('.scrollup').click(function () {
//        $("html, body").animate({
//            scrollTop: 0
//        }, 600);
//        return false;
//    });
    
//    var $grid = $('.grid').isotope({
//        itemSelector: '.grid-item',
////        layoutMode: 'fitRows',
//        percentPosition: true,
//        masonry: {
//            columnWidth: '.grid-sizer'
//        }
//    });
//    var filterFns = '';
//    $('.filters-button-group').on('click', 'li', function() {
//        var filterValue = $(this).attr('data-filter');
//        // use filterFn if matches value
//        filterValue = filterFns[filterValue] || filterValue;
//        //console.log(filterValue);
//        $grid.isotope({
//            filter: filterValue
//        });
//    });
    // change is-checked class on buttons
//    $('.filters-button-group').each(function(i, buttonGroup) {
//        var $buttonGroup = $(buttonGroup);
//        $buttonGroup.on('click', 'li', function() {
//            $buttonGroup.find('.active').removeClass('active');
//            $(this).addClass('active');
//        });
//    });   
    
    $(".mos-menu-list li:has('ul')").prepend("<span class='down-arrow'></span>");
    $('body').on('click', '.down-arrow', function () {
        $(this).parent().toggleClass('open-below');
        $(this).siblings("ul").slideToggle();
    });
    $(".megamenu > .sub-menu > li").wrapInner('<div class="mega-menu-unit"></div>');
//    new WOW().init();
//    $('.slick-slider').slick();

//    Fancybox.bind('.slick-active .fancybox-active', {
//        groupAttr: false,
//    });
//
//    Fancybox.bind(".block-fancybox, .slick-active .slider-fancybox", {
//        animated: false,
//        showClass: false,
//        hideClass: false,
//
//        click: false,
//
//        dragToClose: true,
//
//        closeButton: "top",
//
//        Thumbs: false,
//        Toolbar: false,
//
//        Carousel: {
//            Dots: true,
//            Navigation: false,
//        },
//
//        Image: {
//            zoom: false,
//            fit: "contain-w",
//        },
//    });

});
document.addEventListener('scroll', (e) => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
//    if (scrollTop > 100) document.querySelector('#btt-btn').style.display = "block";
//    else document.querySelector('#btt-btn').style.display = "none"
    if (scrollTop > 100) {
        if (document.querySelector('#header')) document.querySelector('#header').classList.add("tiny");
        if (document.querySelector('#btt-btn')) document.querySelector('#btt-btn').classList.add("active");
    }
    else {
        if (document.querySelector('#header'))document.querySelector('#header').classList.remove("tiny");
        if (document.querySelector('#btt-btn')) document.querySelector('#btt-btn').classList.remove("active");
    }
})

// When the user clicks on the button, scroll to the top of the document
function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
