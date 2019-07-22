<?php
// enqueue javascript
function theme_scripts(){

	if (!is_admin()) {
		wp_enqueue_script( 'bootstrap',get_template_directory_uri() . '/includes/js/bootstrap.min.js',array('jquery'), '',true );
		wp_enqueue_script( 'prettyPhoto',get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js',array('jquery'), '',true );
        wp_enqueue_script( 'wow',get_template_directory_uri() . '/includes/js/wow.min.js',array('jquery'), '',true );
        wp_enqueue_script( 'carousel',get_template_directory_uri() . '/includes/js/owl.carousel.min.js',array('jquery'), '',true );
        if(is_rtl()){
            wp_enqueue_script( 'main',get_template_directory_uri() . '/includes/js/main.rtl.js',array('jquery'), '',true );
        }else{
            wp_enqueue_script( 'main',get_template_directory_uri() . '/includes/js/main.js',array('jquery'), '',true );
        }
    }
	
  }
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
?>