<?php

define('PARENT_DIR', get_template_directory());
define('THEME_DIR', get_template_directory_uri());
require_once (PARENT_DIR . '/includes/redux/admin-init.php');

require_once PARENT_DIR . '/includes/theme-function.php';
require_once PARENT_DIR . '/includes/theme-scripts.php';
require_once PARENT_DIR . '/includes/theme-styles.php';
require_once PARENT_DIR . '/includes/custom-post-types.php';
require_once PARENT_DIR . '/includes/register-widgets.php';

// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );
add_filter('show_admin_bar', '__return_false');
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/acf/';
    return $path;
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/acf/';
    return $dir;
}
//add_filter('acf/settings/show_admin', '__return_false');
include_once( get_stylesheet_directory() . '/acf/acf.php' );

function my_acf_google_map_api( $api ){

    $api['key'] = 'AIzaSyBFtv0_exypwVZieyflEeEdI0Bs3h-sB10';

    return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function send_email($from, $to, $subject, $msg){
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from.'' . "\r\n" .
	"Reply-To:".$to. "\r\n" .
	"X-Mailer: PHP/" . phpversion();

	if(!wp_mail( $to, $subject, $msg, $headers)){
		return 0;
	}
}

function theme_mail_from_name($from_name){
return get_bloginfo('name');
}
add_filter("wp_mail_from_name", "theme_mail_from_name");

function theme_mail_from($email){
return get_option('admin_email');
}
add_filter("wp_mail_from", "theme_mail_from");

add_filter( 'wpcf7_autop_or_not', '__return_false' );

function loadpost_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_type'] = 'post';
    $args['posts_per_page'] = 9;
    // it is always better to use WP_Query but not here
    $news = new WP_Query( $args );
    if( $news->have_posts() ) :
        while ( $news->have_posts() ) : $news->the_post();
        $type = get_field('type');
            ?>
            <div class="col-sm-4 mix all <?php echo  $type;?>">
                <?php $img = get_the_post_thumbnail_url(get_the_ID(),'medium');?>
                <div class="news-item bg-image <?php echo $type.'_style'?>" style="<?php echo ($img?'background-image: url('.$img.')':'')?>" data-type="<?php echo $type?>">
                    <div class="news-desc">
                        <?php echo ($type=='report'? '<i class="fa fa-newspaper-o"></i>':'')?>
                        <?php echo ($type=='video'? '<i class="fa fa-play-circle-o"></i>':'')?>
                        <?php echo ($type!='video'? '<time>'.get_the_time('j F Y').'</time>':'')?>
                        <h3><a href="<?php the_permalink()?>"><?php the_title()?></a> </h3>
                        <?php echo ($type!='video'? '<a class="morenews" href="'.get_permalink().'">'.__('READ MORE','pnina').'</a>':'')?>
                    </div>
                </div>
            </div>
        <?php endwhile;
    endif;wp_reset_query();

    die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadpost', 'loadpost_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadpost', 'loadpost_ajax_handler'); // wp_ajax_nopriv_{action}

function loadstory_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_type'] = 'story';
    $args['posts_per_page'] = 9;
    // it is always better to use WP_Query but not here
    $story = new WP_Query( $args );
    if( $story->have_posts() ) :
        while ( $story->have_posts() ) : $story->the_post();
            $img = get_the_post_thumbnail_url(get_the_ID(),'story');
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="story-box">
                    <figure class="bg-image" style="background-image: url(<?php echo $img?>)">
                        <a href="<?php the_permalink()?>"></a>
                    </figure>
                    <time><?php echo the_time('j F Y')?></time>
                    <h3><a href="<?php the_permalink()?>"><?php the_title() ?></a> </h3>
                    <?php the_excerpt()?>
                    <a class="morenews" href="<?php the_permalink()?>"><?php _e('READ MORE','pnina')?></a>
                </div>
            </div>
        <?php endwhile;
    endif;wp_reset_query();

    die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadstory', 'loadstory_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadstory', 'loadstory_ajax_handler'); // wp_ajax_nopriv_{action}


function loadteam_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_type'] = 'team';
    $args['posts_per_page'] = 12;
    // it is always better to use WP_Query but not here
    $story = new WP_Query( $args );
    if( $story->have_posts() ) :
        while ( $story->have_posts() ) : $story->the_post();
            $img = get_the_post_thumbnail_url(get_the_ID(),'full');
            $position = get_post_meta(get_the_ID(),'position',true);
            ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="team-box">
                    <figure class="bg-image" style="background-image: url(<?php echo $img?>)"></figure>
                    <div class="text-info">
                        <h3><a href="<?php the_permalink()?>"><?php the_title() ?></a> </h3>
                        <span><?php echo $position?></span>
                    </div>
                </div>
            </div>
        <?php endwhile;
    endif;wp_reset_query();

    die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadteam', 'loadteam_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadteam', 'loadteam_ajax_handler'); // wp_ajax_nopriv_{action}
