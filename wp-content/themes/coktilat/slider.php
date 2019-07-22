
<section class="slider">
    <div class="loading"></div>
    <div class="flexslider" id="home-slider">
        <ul class="slides">
            <?php
            $args=array(
                'post_type'=>'slider',
                'posts_per_page'=>-1,
            );
            query_posts($args);
            while ( have_posts() ) : the_post();
                $small_text = get_field('small_text');
                $slide_title = get_field('slide_title');
                $button_text = get_field('button_text');
                $button_link = get_field('button_link');
                $url = get_the_post_thumbnail_url(get_the_ID(),'full')?>

                <li>
                    <div class="slide-img bg-image" style="<?php echo ($url?'background-image: url('.$url.')':'')?>">
                        <div class="slide-caption">
                            <span class="animated out" data-delay="0" data-animation="fadeInUp"><?php echo $small_text?></span>
                            <h2 class="animated out" data-delay="0" data-animation="fadeInUp"><?php echo $slide_title?></h2>
                            <a class="animated out" data-delay="0" data-animation="fadeInUp" data-toggle="modal" data-target="#welcomeModal" href="#"><?php _e('How Can I Benefit from This Site','pnina')?> <img width="35" src="<?php echo get_template_directory_uri()?>/images/quastion.png"></a>
                            <?php get_social_icon()?>
                        </div>
                    </div>
                </li>
                <?php
            endwhile;wp_reset_query();?>
        </ul>
    </div>
</section>
