<?php
/*Template Name: Home */
?>
<?php get_header(); ?>

<div class="section1">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="overview">
                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="overview-btn">
                    <a class="text-uppercase hire-btn" href="#">Hire Us <i class="fa fa-long-arrow-right"></i> </a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="main-right">
                    <div class="bg-main" style="">
                    </div>
                    <div class="group1">
                        <img src="<?php echo THEME_DIR?>/images/group1.png">
                    </div>
                     <div class="girl-item">
                         <img class="anim-img" src="<?php echo THEME_DIR?>/images/girl1.png">
                    </div>
                </div>
<!--
                <div class="group1">
                    <img src="<?php echo THEME_DIR?>/images/group1.png">
                </div>
                <div class="girl-item">
                    <img class="anim-img" src="<?php echo THEME_DIR?>/images/girl1.png">
                </div>
-->
            </div>
        </div>
    </div>
</div>

<div class="section2">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <img src="<?php echo THEME_DIR?>/images/4.png">
            </div>
            <div class="col-sm-6">
                <div class="about-box wow fadeInDown">
                    <div class="heading">
                        <h2>Know About us</h2>
                    </div>
                    <div class="about-text">
                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="section3">
        <?php
        $args=array(
            'post_type'=>'step',
            'posts_per_page'=>3,
        );
        $service = new WP_Query($args);?>
        <?php if($service->have_posts()):?>
            <div class="row">
                <?php $i=0.2;  while ($service->have_posts()) : $service->the_post();
                    $url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
                    <div class="col-sm-4 wow fadeInDown" data-wow-delay="<?php echo $i?>s">
                        <div class="step-item">
                            <div class="step-img">
                                <?php the_post_thumbnail('full')?>
                            </div>
                            <h3><?php the_title()?></h3>
                            <?php the_content()?>
                        </div>
                    </div>
                <?php $i = $i + 0.2; endwhile;?>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="section4 ">
    <div class="cok1">
        <img src="<?php echo get_template_directory_uri()?>/images/dots.png">
    </div>
    <img class="img-cok1" src="<?php echo get_template_directory_uri()?>/images/cok1.png">
    <div class="container">
        <div class="callAction">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="call-action">
                        <h3>Focus on your earnings</h3>
                        <div class="row">
                            <div class="col-sm-8 wow fadeInDown" data-wow-delay="0.2s">
                                <div class="action-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInDown" data-wow-delay="0.5s">
                                <div class="action-btn text-right">
                                    <a class="c_btn" href="#">HIRE US</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="section5 work-fields">
    <div class="container">
        <div class="title">
            <span>We Work on This </span>
            <h2>Work Fields</h2>
        </div>
        <?php
        $args=array(
            'post_type'=>'field',
            'posts_per_page'=>4,
        );
        $service = new WP_Query($args);?>
        <?php if($service->have_posts()):?>
            <div class="row">
                <?php $i=0.3;  while ($service->have_posts()) : $service->the_post();
                    $url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
                    <div class="col-sm-3 wow fadeInDown" data-wow-delay="<?php echo $i?>s">
                        <div class="field-item">
                            <div class="field-img">
                                <?php the_post_thumbnail('full')?>
                            </div>
                            <h3><?php the_title()?></h3>
                        </div>
                    </div>
                <?php $i = $i + 0.3; endwhile;?>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="section6 services-wrap">
        <div class="container">
            <div class="title">
                <span>Pricing</span>
                <h2>Our Service</h2>
            </div>
            <?php
            $args=array(
                'post_type'=>'service',
                'posts_per_page'=>4,
            );
            $service = new WP_Query($args);?>
            <?php if($service->have_posts()):?>
                <div class="row">
                    <?php $i=0.3; while ($service->have_posts()) : $service->the_post();
                        $feature = get_field('featured_service');
                        $url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
                        <div class="col-sm-3 wow fadeInDown" data-wow-delay="<?php echo $i?>s">
                            <div class="service-item <?php echo ($feature?'featured_service':'')?>">
                                <h3><?php the_title()?></h3>
                                <div class="service-ul">
                                    <?php the_content()?>
                                </div>
                                <a class="c_btn" href="#"><?php _e('Hire Us','pnina')?></a>
                            </div>
                        </div>
                    <?php $i = $i + 0.3; endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>

<div class="section7">
    <div class="container">
        <div class="callAction2">
            <div class="row">
                <div class="col-sm-9">
                    <h3>Be Coktilaer</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a class="c_btn" href="#">Join our Team</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="section8">
        <div class="container">
            <div class="title">
                <span>Check some of our</span>
                <h2>Recent Work</h2>
            </div>

            <?php
            $args=array(
                'post_type'=>'portfolio',
                'posts_per_page'=>6,
            );
            $portfolio = new WP_Query($args);?>
            <?php if($portfolio->have_posts()):?>
                <div class="row">
                    <?php  while ($portfolio->have_posts()) : $portfolio->the_post();
                        $url = get_the_post_thumbnail_url(get_the_ID(),'medium');?>
                        <div class="col-sm-4">
                            <div class="work-item bg-image" style="background-image: url(<?php echo $url?>)">
                                <a href="#">
                                    <div class="work-hv">
                                        <i class="fa fa-search-plus"></i>
                                        <h3><?php the_title()?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>

<div class="section9">
    <div class="container">
        <div class="heading">
            <h2>Testimonials</h2>
            <p>What our client are saying</p>
        </div>


        <?php
        $args=array(
            'post_type'=>'testimonial',
            'posts_per_page'=>6,
        );
        $testimonial = new WP_Query($args);?>
        <?php if($testimonial->have_posts()):?>
            <div class="row">
                <div class="owl-testimonial">
                <?php  while ($testimonial->have_posts()) : $testimonial->the_post();
                    $url = get_the_post_thumbnail_url(get_the_ID(),'medium');
                    $position = get_field('position');
                    ?>
                    <div class="col-sm-12">
                        <div class="testimonial-item">
                            <div class="testimonial-info">
                                <div class="row">
                                    <div class="col-sm-8 testimonial-text">
                                        <?php the_content()?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php the_post_thumbnail('full')?>
                                    </div>
                                </div>
                            </div>
                            <div class="author-item">
                                <div class="author-icon">
                                    <i class="fa fa-user-circle-o"></i>
                                </div>
                                <div class="author-info">
                                    <h3><?php the_title()?></h3>
                                    <span><?php echo $position?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="section10 contact-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 ">
                <div class="contact-info">
                    <h3>We can help your business with our knoledge</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>

                <div class="contact-img">
                    <img src="<?php echo THEME_DIR?>/images/contact.png" />
                </div>
            </div>
            <div class="col-sm-6">
                <?php $contact_form = ps_option('contact_form');
                echo do_shortcode($contact_form);
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>