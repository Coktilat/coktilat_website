<?php get_header(); ?>
    <div class="page-title bg-image">
        <div class="container">
            <h1><?php the_title()?></h1>
            <?php breadcrumb_lists()?>
        </div>
    </div>
	<div class="wrapper">
    	<div class="container">
            <?php
            if (have_posts()) :?>
                <div id="main" class="post-archive row">
                    <?php
                    while (have_posts()) : the_post();
                        $type = get_field('type');
                        ?>
                        <div class="col-sm-4">
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
                    <?php endwhile; ?>
                </div>
                <?php page_navi();endif; ?>
        </div>
	</div>
<?php get_footer(); ?>