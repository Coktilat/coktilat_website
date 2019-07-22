<?php get_header(); ?>
    <div class="page-title bg-image">
        <div class="container">
<?php if(!$_GET['s']|| $_GET['s'] != ' '){?>
    <h1><?php the_title()?></h1>
    <?php }?>
            <?php breadcrumb_lists()?>
        </div>
    </div>
<?php get_template_part('get_help_button')?>
    <div class="search-wrapper">
        <div class="container">
            <?php if($_GET['s'] == '' || $_GET['s'] == ' '){?>
                <p class="count-result"><?php printf(__('0 results found for the keyword "<span>%s</span>"', 'pnina'), esc_attr(get_search_query())); ?></p>
            <?php }else {
                if (have_posts()) : ?>
                    <?php global $wp_query; ?>
                    <p class="count-result"><?php printf(__('%s results found for the keyword "<span>%s</span>"', 'pnina'), $wp_query->found_posts, esc_attr(get_search_query())); ?></p>

                    <?php while (have_posts()) : the_post(); ?>
                        <div class="post-item">
                            <div class="post-item-head">
                                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                <time><?php the_time('j F, Y') ?></time>
                            </div>
                            <?php the_excerpt() ?>
                            <a class="post_more" href="<?php the_permalink() ?>"><i
                                        class="fa fa-angle-right"></i> <?php _e('Read More') ?></a>
                        </div>
                    <?php endwhile; ?>
                <?php else:
                    echo '<div class="search-result"><h3>'.__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.','pnina').'</h3></div>';
                    ?>
                    <?php page_navi();endif;
            }?>

        </div>
    </div>
<?php get_footer('home'); ?>