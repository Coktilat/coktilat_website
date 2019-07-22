<?php
// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles(){
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome/css/font-awesome.min.css');
        wp_enqueue_style("animate",get_template_directory_uri().'/css/animate.css');
        wp_enqueue_style("carousel",get_template_directory_uri().'/css/owl-carousel.css');
        wp_enqueue_style("prettyPhoto",get_template_directory_uri().'/css/prettyPhoto.css');

       if(is_rtl()){
           wp_enqueue_style("bootstrap",get_template_directory_uri().'/css/bootstrap.rtl.min.css');
           wp_enqueue_style("main",get_template_directory_uri().'/css/rtl.css');
       }else{
           wp_enqueue_style("bootstrap",get_template_directory_uri().'/css/bootstrap.min.css');
           wp_enqueue_style("main",get_template_directory_uri().'/css/style.css');
       }

    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

?>