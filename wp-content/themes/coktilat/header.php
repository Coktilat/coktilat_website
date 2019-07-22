<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="google-site-verification" content="7aEaKT2Bt-X9Ry0j2msTu5ECfkWRNZJhZuasjUm5wEs" />
        <?php wp_head(); ?>
	</head>

    	
<body <?php body_class(); ?>>
<div id="preloader" >
    <div class="loader">
        <div class="battery"></div>
    </div>
</div>

<div class="fix-social">
    <?php get_social_icon()?>
</div>

<a class="whatsapp-btn" target="_blank" href="https://api.whatsapp.com/send?phone=966558040640&amp;text=">
    <i class="fa fa-whatsapp fa-lg"></i></a>
<a class="facebook-btn" target="_blank"  href="https://www.facebook.com/Coktilat">
    <i class="fa fa-facebook fa-lg"></i></a>
<a class="instagram-btn"  target="_blank"  href="https://www.instagram.com/coktilat/">
    <i class="fa fa-instagram fa-lg"></i></a>
<a class="twitter-btn"   target="_blank"  href="https://twitter.com/coktilat">
    <i class="fa fa-twitter fa-lg"></i></a>
<header id="home" data-toggle="sticky-onscroll">
    <div class="container">
        <div class="nav-menu text-center" >
            <div class="navbar-header clearfix">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive"><i class="fa fa-bars"></i></button>
                <?php $site_logo = ps_option( 'of_logo', false, 'url' );?>
                <a title="<?php echo get_bloginfo('name'); ?>" class="navbar-brand" href="<?php echo home_url(); ?>">
                    <?php if($site_logo){?>
                        <img src="<?php echo $site_logo ?>" alt="<?php echo get_bloginfo('description'); ?>">
                    <?php }?>
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-responsive">
                <?php theme_main_nav(); ?>
                <a class="hire_btn" href="#" data-toggle="modal" data-target="#clientModal"><?php _e('HIRE US','pnina')?></a>
            </div>
        </div>
        <div id="uniqheader" class="nav-menu text-center is-sticky" style="display:none;" >
            <div class="navbar-header clearfix">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive"><i class="fa fa-bars"></i></button>
                <?php $site_logo = ps_option( 'of_logo', false, 'url' );?>
                <a title="<?php echo get_bloginfo('name'); ?>" class="navbar-brand" href="<?php echo home_url(); ?>">
                    <?php if($site_logo){?>
                        <img src="<?php echo $site_logo ?>" alt="<?php echo get_bloginfo('description'); ?>">
                    <?php }?>
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-responsive">
                <?php theme_main_nav(); ?>
                <a class="hire_btn" href="#" data-toggle="modal" data-target="#clientModal"><?php _e('HIRE US','pnina')?></a>
            </div>
        </div>
    </div>
</header>
