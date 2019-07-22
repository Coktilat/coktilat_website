<?php get_header(); ?>
    <div class="page-title bg-image">
        <div class="container">
            <h1><?php the_title()?></h1>
            <?php //breadcrumb_lists()?>
        </div>
    </div>
<div class="wrapper">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post();?>
            <?php the_content();?>
        <?php endwhile;  endif; ?>
    </div>
</div>
<?php get_footer(); ?>