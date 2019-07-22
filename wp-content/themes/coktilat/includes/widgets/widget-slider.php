<?php
add_action( 'widgets_init', 'holol_slider_widget' );
function holol_slider_widget() {
	register_widget( 'holol_slider' );
}
class holol_slider extends WP_Widget {

	function holol_slider() {
		$widget_ops 	= array( 'classname' => 'holol-slider' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'holol-slider-widget' );
		parent::__construct( 'holol-slider-widget',__( 'Slide posts' , 'kidz'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$no_of_posts 	= $instance['no_of_posts'];
		$cats_id 		= $instance['cats_id'];
		$slider_color 		= $instance['slider_color'];
		
		global $post;
		$original_post = $post;
		$argss 			= array('posts_per_page'=> $no_of_posts , 'cat' => $cats_id, 'no_found_rows' => 1 );
		$featured_query = new WP_Query( $argss );
	if( $featured_query->have_posts() ) : ?>
	<div class="flexslider" id="<?php echo $args['widget_id']; ?>">
		<ul class="slides">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'slider' ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
					<p><?php echo  limit_words(get_the_excerpt(),25)?></p>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
        <ol class="flex-control-nav clearfix">
			<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
				<li><?php the_title()?></li>
			<?php endwhile;?>
		</ol>
	</div>
	<?php endif; 
	$post = $original_post;
	wp_reset_query();
	?>
	<script>
	jQuery(window).load(function() {
	  jQuery('#<?php echo $args['widget_id']; ?>').flexslider({
		animation: "fade",
		slideshowSpeed: 7000,
		animationSpeed: 600,
		randomize: false,
		pauseOnHover: true,
		manualControls: '.flex-control-nav li',
		useCSS: false,
		prevText: "",
		nextText: "",
		after: function(slider) {
			$('.slider-caption').fadeIn();
			/*$('.slider-caption').animate({bottom:40,}, 200);*/
		},
		before: function(slider) {
			$('.slider-caption').fadeOut();
		},	
			start: function(slider) {
				jQuery('.flex-control-nav li').css('height', jQuery('.flex-control-nav').height());
				jQuery('.flex-control-nav li').mouseover(function(){
					 var activeSlide = 'false';
					 if (jQuery(this).hasClass('flex-active')){  
						activeSlide = 'true';                       
					 }
					 if (activeSlide == 'false'){
					  jQuery(this).trigger("click"); 
					 }
				 });      
			}
		  });
	});
	</script>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['no_of_posts'] 		= strip_tags( $new_instance['no_of_posts'] );
		$instance['cats_id'] 			= implode(',' , $new_instance['cats_id']  );
		$instance['slider_color'] 		= strip_tags( $new_instance['slider_color'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'no_of_posts' => '5' , 'cats_id' => '1' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories 	= array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}

		?>
        <p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Number of posts to show:' , 'kidz') ?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if( !empty($instance['no_of_posts']) ) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e( 'Category:' , 'kidz') ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'slider_color' ); ?>"><?php _e( 'Slider Color:' , 'kidz') ?> </label>
			<input id="<?php echo $this->get_field_id( 'slider_color' ); ?>" name="<?php echo $this->get_field_name( 'slider_color' ); ?>" value="<?php if( !empty($instance['slider_color']) ) echo $instance['slider_color']; ?>" type="text" size="3" />
		</p>
	<?php
	}
}
?>