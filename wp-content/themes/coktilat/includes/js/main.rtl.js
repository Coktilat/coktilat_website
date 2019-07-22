(function ($) {

    $(window).on('load', function() {
        $('body').addClass('loaded');
    });

    /*=========================================================================
        WOW Active
    =========================================================================*/
    new WOW().init();


    var scrollTop = 60;
    $(window).scroll(function() {

        var topMenu = "header";

        if ($(window).scrollTop() >= scrollTop) {
            setTimeout(function() {
                $(topMenu).addClass('sticky-header');
            }, 1);
        }
        if ($(window).scrollTop() < (scrollTop)) {
            $(topMenu).removeClass('sticky-header');
        }

    });
    $('.owl-testimonial').owlCarousel({
        loop:true,
        dots:false,
        nav:true,
        rtl:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        autoHeight: false,
        lazyLoad:true,
        items:1
    });

    $('.owl-fields,.owl-team').owlCarousel({
        loop:true,
        dots:false,
        nav:false,
        rtl:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        autoHeight: false,
        lazyLoad:true,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            767:{
                items:3
            },
            992:{
                items:4
            }
        }
    });

    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });

    $('.navbar-nav>li>a').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }

    });

//Scroll To top
    var $topcontrol = jQuery('#topcontrol');
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 100) {
            $topcontrol.css({bottom:"10px"});
        } else {
            $topcontrol.css({bottom:"-100px"});
        }
    });
    $topcontrol.click(function(){
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

})(jQuery);
