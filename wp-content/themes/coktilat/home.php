<?php
/*Template Name: Home */
?>
<?php get_header(); ?>

<div class="section1">
    <div class="container">
    <!--     <div class="row">
            <div class="col-sm-6 pullRight">
                <div class="group1">
                    <img src="<?php echo THEME_DIR?>/images/group1.png">
                </div>
                <div class="girl-item">
                    <img class="anim-img" src="<?php echo THEME_DIR?>/images/girl1.png">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="overview">
                    <?php if(is_rtl()){echo ps_option('overview_ar');}else{echo ps_option('overview');}?>
                </div>
                <div class="overview-btn">
                    <a class="text-uppercase hire-btn" href="#"  data-toggle="modal" data-target="#HireModal">Hire Us <i class="fa fa-long-arrow-right"></i> </a>
                </div>
            </div>

        </div> -->
          <div class="row">
            <div class="col-sm-6">
                <div class="overview">
                    <?php echo ps_option('overview')?>
                </div>
                <div class="overview-btn">
                    <a class="text-uppercase hire-btn" href="#"  data-toggle="modal" data-target="#clientModal">Hire Us <i class="fa fa-long-arrow-right"></i> </a>
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
                        <img class="anim-img" style="    position: relative;" src="<?php echo THEME_DIR?>/images/girl1.png">
                    </div>
                </div>
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
                        <h2><?php _e('Know About us','pnina')?></h2>
                    </div>
                    <div class="about-text">
                        <?php if(is_rtl()){echo ps_option('about_us_ar');}else{echo ps_option('about_us');}?>
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
                    $url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $img2 = get_field('img_hover');
                    ?>
                    <div class="col-sm-4 wow fadeInDown" data-wow-delay="<?php echo $i?>s">
                        <div class="step-item">
                            <div class="step-img">
                                <?php the_post_thumbnail('full')?>

                     <img src="<?php echo $img2?>" class="imghv">
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
                        <h3><?php _e('Focus on your earnings','pnina')?></h3>
                        <div class="row">
                            <div class="col-sm-8 wow fadeInDown" data-wow-delay="0.2s">
                                <div class="action-text">
                                    <?php if(is_rtl()){echo ps_option('earnings_desc_ar');}
                                    else{echo ps_option('earnings_desc');}?>

                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInDown" data-wow-delay="0.5s">
                                <div class="action-btn text-right">
                                    <a class="c_btn" href="#" data-toggle="modal" data-target="#clientModal">HIRE US</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="section5 work-fields" id="fields">
    <div class="container">
        <div class="title">
            <span><?php _e('We Work on This','pnina')?> </span>
            <h2><?php _e('Work Fields','pnina')?></h2>
        </div>
        <?php
        $args=array(
            'post_type'=>'field',
            'posts_per_page'=>-1,
        );
        $service = new WP_Query($args);?>
        <?php if($service->have_posts()):?>
            <div class="row wow fadeInDown" data-wow-delay="0.6s">
                <div class="owl-fields">
                <?php while ($service->have_posts()) : $service->the_post();
                    $url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $img2 = get_field('img_hover');

                    $pid = get_the_ID();
                    ?>
                    <div class="col-sm-12">
                        <div class="field-item">
                            <!-- <a href="#"  data-toggle="modal" data-target="#fieldModal<?php //echo $pid?>"> -->
                           <!--  <a href="" > -->
                                <div class="field-img">
                                    <?php the_post_thumbnail('full')?>
                                    <img src="<?php echo $img2?>" class="imghv">
                                </div>
                                <h3><?php the_title()?></h3>
                            <!-- </a> -->
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
            </div>
    <?php while ($service->have_posts()) : $service->the_post();
        $pid = get_the_ID();?>
                <div class="modal fade" id="fieldModal<?php echo $pid?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3><?php the_title()?></h3>
                            </div>
                            <div class="modal-body" style="min-height: 400px">
                                <div class="row">
                                    <div class="col-sm-8 text-left">
                                        <?php the_content()?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

           <?php endwhile;?>

        <?php endif;?>
    </div>
</div>

<div class="section6 services-wrap" id="pricing">
        <div class="container">
            <div class="title">
                <span><?php _e('Pricing','pnina')?></span>
                <h2><?php _e('Our Service','pnina')?></h2>
            </div>
            <?php
            $args=array(
                'post_type'=>'service',
                'posts_per_page'=>-1,
            );
            $service = new WP_Query($args);?>
            <?php if($service->have_posts()):?>
                <div class="row">
                    <?php $i=0.3; while ($service->have_posts()) : $service->the_post();
                        $feature = get_field('featured_service');
                        $select_service = get_field('select_service');
                        $url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
                        <div class="col-sm-3 wow fadeInDown" data-wow-delay="<?php echo $i?>s">
                            <div class="service-item <?php echo ($feature?'featured_service':'')?>">
                                <h3><?php the_title()?></h3>
                                <div class="service-ul">
                                    <?php the_content()?>
                                </div>
                                <a class="c_btn" href="#" data-toggle="modal" data-target="#clientModal" data-value="<?php echo $select_service?>"><?php _e('Hire Us','pnina')?></a>
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
                    <div class="" style="margin: 0 0 15px;">
                        <h3><?php _e('Be Coktailer','pnina')?></h3>
                        <?php if(is_rtl()){echo ps_option('coktailer_desc_ar');}
                        else{echo ps_option('coktailer_desc');}?>
                    </div>
                    <a class="c_btn" href="#" data-toggle="modal" data-target="#joinModal">Join our Team</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="section8" id="works">
        <div class="container">
            <div class="title">
                <h2><?php _e('Our Talent','pnina')?></h2>
            </div>

            <?php
            $args=array(
                'post_type'=>'team',
                'posts_per_page'=>-1,
            );
            $team = new WP_Query($args);?>
            <?php if($team->have_posts()):?>
                <div class="row">
                    <div class="owl-team">
                        <?php  while ($team->have_posts()) : $team->the_post();
                            $position = get_field('position');
                            $url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
                            <div class="col-sm-12">
                                <div class="team-item">
                                    <div class="team-img bg-image" style="background-image: url(<?php echo $url?>)">
                                    </div>
                                    <div class="team-info">
                                        <h3><?php the_title()?></h3>
                                        <span><?php echo $position?></span>
                                    </div>
                                    <div class="team-social">
                                        <a href="#"><i class="fa fa-facebook-square"></i> </a>
                                        <a href="#"><i class="fa fa-twitter-square"></i> </a>
                                        <a href="#"><i class="fa fa-linkedin-square"></i> </a>
                                        <a href="#"><i class="fa fa-instagram"></i> </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;?>
                    </div>

                </div>
            <?php endif;?>
        </div>
    </div>

<div class="section9" id="testimonial">
    <div class="container">
        <div class="heading">
            <h2><?php _e('Testimonials','pnina')?></h2>
            <p><?php _e('What our client are saying','pnina')?></p>
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

<div class="section10 contact-wrap" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 ">
                <div class="contact-info">
                    <?php if(is_rtl()){echo ps_option('contact_desc_ar');}else{echo ps_option('contact_desc');}?>

                </div>

                <div class="contact-img">
                    <img src="<?php echo THEME_DIR?>/images/contact.png" />
                </div>
            </div>
            <div class="col-sm-6">
                <?php if(is_rtl()){$contact_form = ps_option('contact_form_ar');}
                else{
                echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');
            }
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>