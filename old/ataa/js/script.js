$(document).ready(function(){
    /*open menu*/
    $(".hamburger").click(function(){
        $("body,html").addClass('menu-toggle');
        $(".hamburger").addClass('active');
    });
    $(".m-overlay").click(function(){
        $("body,html").removeClass('menu-toggle');
        $(".hamburger").removeClass('active');
    });
    /*header-fixed*/
    $(window).scroll(function(){
            
        if ($(window).scrollTop() >= 200) {
            $('.bottom_header').addClass('fixed-header');
        }
        else {
            $('.bottom_header').removeClass('fixed-header');
        }
              
    });
	var owl = $('#slide_intro');

        owl.on('initialized.owl.carousel change.owl.carousel',function(elem){
            var current = elem.item.index;
            $(elem.target).find(".owl-item").eq(current).find(".to-animate").removeClass('fadeInDown animated');
            $(elem.target).find(".owl-item").eq(current).find(".to-animate2").removeClass('fadeInUp animated');
        });
       
        owl.on('initialized.owl.carousel changed.owl.carousel',function(elem){
            window.setTimeout(function(){
                var current = elem.item.index;
                $(elem.target).find(".owl-item").eq(current).find(".to-animate").addClass('fadeInDown animated');
                $(elem.target).find(".owl-item").eq(current).find(".to-animate2").addClass('fadeInUp animated');
            }, 400);
        });
	    owl.owlCarousel({
	            items: 1,
	            loop: true,
	            margin: 0,
	            responsiveClass: true,
	            nav: true,
	            dots: true,
	            rtl:true,
	            smartSpeed: 500,
	            autoplay: true,
	            autoplayTimeout: 5000,
	            autoplayHoverPause: true,
	            animateOut: 'fadeOut',
	            animateIn: 'fadeIn',
	            navText:['<i class="fas fa-arrow-right"></i>',
	            '<i class="fas fa-arrow-left"></i>'],
	    });



	    $("#contacts_slider").owlCarousel({
 
            // Most important owl features
            loop:true,
            margin:30,
            rtl:true,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                400:{
                    items:2,
                },
                575:{
                    items:3,
                },
                767:{
                    items:4,
                },
                992:{
                    items:6,
                }

            },
            dots:false,
            nav:false,
            autoplay:false
         

        })
})