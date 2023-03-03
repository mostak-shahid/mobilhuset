jQuery(document).ready(function ($) {
    resizeFunctionality ();
    $(window).resize(function(){
        resizeFunctionality ();
    });
    $('.header-category-menu .wp-block-navigation__responsive-container-open').append("<b>Alla Produkter</b>");
    $('.header-category-menu .wp-block-navigation__responsive-container-open').on('click', function(){
        $(this).find('svg').css('opacity', 0);
    });
    $('.header-category-menu .wp-block-navigation__responsive-container-close').on('click', function(){
        $('.header-category-menu .wp-block-navigation__responsive-container-open').find('svg').css('opacity', 1);
    });
    var Nav = new hcOffcanvasNav("#main-nav", {
        disableAt: false,
        customToggle: ".toggle",
        levelSpacing: 0,
        navTitle: "Alla Produkter",
        levelTitles: true,
        levelTitleAsBack: true,
        pushContent: "#container",
        labelClose: false,
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
    // $('.single-product .flex-control-thumbs').owlCarousel({
    //     loop:false,
    //     items:4,
    //     margin:10,
    //     nav: true,
    //     dots: false,
    // });
    

    $('.view-changer').on('click', function(e){
        e.preventDefault();
        var type = $(this).data('type');
        $(this).removeClass('active').addClass('active');
        $(this).siblings().removeClass('active');
        if (type == 'list') {
            $('.products').removeClass('products-grid-view').addClass('products-list-view');
        } else {
            $('.products').removeClass('products-list-view').addClass('products-grid-view');
        }
        //console.log(type);
        setCookie('product_view_type',type,1);
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 210) {
            $('.scroll-header').addClass('active');
            //$('.scrollup').fadeIn();
        } else {
            $('.scroll-header').removeClass('active');
            //$('.scrollup').fadeOut();
        }
    });
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
    $(".megamenu > .sub-menu").wrapInner('<div class="mega-menu-wrapper"></div>');
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
    $('.flex-control-thumbs').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1
    });
    $('.single-product .quantity').find('.qty').before('<span class="qty-btn minus">-</span>');
    $('.single-product .quantity').find('.qty').after('<span class="qty-btn plus">+</span>');
    $('body').on('click', '.minus', function (){
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('body').on('click', '.plus', function (){
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    function resizeFunctionality (){
        if($(window).width() <=768) {
            $('.woocommerce.single-product').find('.woocommerce-tabs').addClass('mos-wc-accordion-tabs');
        } else {
            $('.woocommerce.single-product').find('.woocommerce-tabs').removeClass('mos-wc-accordion-tabs');
        }
    }
    $('body').on('click', '.mos-wc-accordion-tabs .tab-title', function (){
        $(this).next().slideToggle('slow');
    });
    $('body').on('click', '.sidebar-activator', function (){
        $('body').addClass('active-filter');
    });
    $('body').on('click', '.sidebar-close', function (){
        $('body').removeClass('active-filter');
    });

    /*$('.searchform').submit(function(e){
        //alert(0);
        e.preventDefault();
        var mos_product_search = $(this).find('.mos-product-search').val();
        //console.log(mos_product_search);
        if (mos_product_search.length>3) {
            $(this).unbind( 'submit' ).submit();
        } else {
            $(this).find('.mos-product-search').attr('placeholder', 'Please type your keywords here.');
        }
    });*/

});
// var swiper = new Swiper(".flex-control-thumbs", {
//     slidesPerView: 3,
//     spaceBetween: 30,
//     pagination: {
//         //el: ".swiper-pagination",
//         clickable: true,
//     },
// });
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

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
