<?php get_header(); ?>
	<div class="container">
    	<?php if(get_option('of_newsflash')){?>
        	<div class="newsflash">
            	
            	<?php 
				$args = array(
					'cat'=>get_option('of_newsflash_cat'),
					'numberposts' => 1,
					'posts_per_page' => 1,
				);
				$newsflash = get_posts( $args);
					foreach ( $newsflash as $post ) : setup_postdata( $post );
					?>
                    <h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
					<div class="img-holder">
						<a href="<?php the_permalink()?>" title="<?php the_title()?>">
							<?php the_post_thumbnail('full');?>
						</a>
					</div>
					<?php endforeach; 
				wp_reset_postdata();?>
            </div>
        <?php }?>
    </div>
	
	<div class="main-box">
    	<div class="container">
        	
        	<?php
				$exclude_post = array();
				$args = array(
					'numberposts' => 4,
					'posts_per_page' => 4,
				);
				?>
                <div class="row">
            	<div class="col-md-4 col-sm-6">
                	<div class="news-list">
                    	<h3>أحدث الأخبار</h3>
					<?php 
                    $lastNews = get_posts( $args);
					$i=0;
					foreach ( $lastNews as $post ) : setup_postdata( $post );
						$exclude_post[] = get_the_id();
						if(++$i==1) $active = 'active'; else $active = '';?>
                    	<div class="<?=$active?>" id="slide<?=$i?>">
                        	<time><?php the_time('j F Y')?></time>
                            <h4><a href="<?php the_permalink()?>" title="<?php the_title()?>">
								<?php the_title()?></a>
							</h4>
                        </div>
					<?php endforeach; 
					wp_reset_postdata();?>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6">
                	<div class="news-imgs">
                    	<?php 
						$i = 0;
						foreach ( $lastNews as $post ) : setup_postdata( $post );
							$exclude_post[] = get_the_id();
							if(++$i==1) $active = 'active'; else $active = '';
						?>
                    	<div class="img-holder <?=$active?>" id="slide<?=$i?>">
                        	<a href="<?php the_permalink()?>" title="<?php the_title()?>">
                            	<?php the_post_thumbnail('full');?>
                            	<div class="news-overlay">
                                    <h4><?php the_title()?></h4>
                                </div>
                            </a>
                        </div>
					<?php endforeach; 
					wp_reset_postdata();?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
		<div class="container">	
			<div id="content" class="clearfix row">
				<div id="main" class="col-sm-8 clearfix" role="main">
                	<div class="latest_news">
                    <?php 
						$categories = array();
						$cats = get_categories(); 
						foreach ($cats as $cat) {
							$categories[]=$cat->cat_ID;
						}
					?>
                    <?php
						
						$args=array(
							'category__in'=>$categories,
						   'post__not_in'=>$exclude_post,
						   'paged'=>$paged,
						   );
						query_posts($args); 
					?>
					<?php if (have_posts()) : while (have_posts()) : the_post();
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full');
					?>
					<div class="box-news">
                    	<div class="news-img">
                        	<a href="<?php the_permalink()?>">
                            	<?php if($img_url){
									echo '<img src="'.$img_url.'" alt="'.get_the_title().'" />';
								}else{
									echo '<div style="height:93px;background:#fff;"></div>';
								}
								?>
                            </a>
                        </div>
                        <div class="news-desc">
                        	<time><?php the_time('j F Y')?></time>
                            <h2><a href="<?php the_permalink()?>"><?php the_title()?> </a></h2>
                            <div class="tags-list">
								<?php
									$posttags = get_the_tags();
									if ($posttags) {
									  foreach($posttags as $tag) {
										echo '<span>'.$tag->name . '</span>'; 
									  }
									}
									?>
                            </div>
                            
                            <div class="news-share clearfix">
                            	<div class='stats-share-box'>
                                	<a href='#' class='stats-share'>مشاركة</a>
                                </div>
                                
                                <div class="commentTotale">
                                	<a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?= wp_count_comments(get_the_id())->approved;?> </a>
                                </div>
                                
                               <div class="facebookTotale">
                                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share_facebook"><i class="fa fa-facebook-square"></i></a>
                                </div>
                                <div class="twitterTotale">
                                    <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() .' '. get_permalink()); ?>" class="share_tweet" target="_blank"><i class="fa fa-twitter-square"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { ?>
						<?php page_navi(); ?>
					<?php }?>
					<?php endif; ?>
					</div> <!-- end #main -->
    			</div>
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->
		</div>
	</div>
<?php get_footer(); ?>