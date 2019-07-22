<?php get_header(); ?>
<div class="page-title bg-image">
    <div class="container">
        <h1><?php the_title()?></h1>
        <?php //breadcrumb_lists()?>
    </div>
</div>
<?php get_template_part('get_help_button')?>
<div class="wrapper">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            setPostViews(get_the_ID());?>
            <article id="post-<?php the_ID(); ?>">
                <div class="post-img">
                    <?php the_post_thumbnail('full');?>
                </div>
                <div class="single-content">
                    <div class="post-title clearfix">
                        <div class="row">
                            <div class="col-sm-9">
                                <h1 itemprop="headline"><?php the_title(); ?></h1>
                                <time><?php the_time('j F Y')?></time>
                            </div>
                        </div>
                    </div>
                    <div class="post-text">
                        <?php the_content()?>
                    </div>
                    <div class="post-footer clearfix">
                        <div class="share-post">
                            <span>Share</span>

                            <a href="https://api.whatsapp.com/send?text=<?php the_title()?> <?php the_permalink()?>" class="wap" onclick="gtag('event', 'WhatsApp', {'event_action': 'whatsapp_chat', 'event_category': 'Chat', 'event_label': 'Chat_WhatsApp'});" target="_blank"><i class="fa fa-whatsapp"></i> </a>
                            <a href="javascript:" onclick="window.open('//www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>','Facebook','width=800,height=300');return false;" target="_blank" title="Share on Facebook" class="fc"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="javascript:" onclick="window.open('//twitter.com/share?url=<?php the_permalink()?>&amp;text=#<?php the_title()?>', '_blank', 'width=800,height=300')" target="_blank" title="Share on twitter" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </div>
                        <div class="post-author">
                            By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a>
                        </div>
                        <?php the_tags( '<p class="post-tag">Tags: '  ,' ', '</p>'); ?>
                    </div>
                </div>
            </article>
            <?php //comments_template( '', true ); ?>

        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
