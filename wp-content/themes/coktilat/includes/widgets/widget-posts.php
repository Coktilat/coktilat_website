<?php
add_action( 'widgets_init', 'pnina_posts_list_widget' );
function pnina_posts_list_widget() {
	register_widget( 'pnina_posts_list' );
}
class pnina_posts_list extends WP_Widget {

	public function __construct(){
		$widget_ops 	= array( 'classname' => 'posts-list'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-list-widget' );
		parent::__construct( 'posts-list-widget',__( 'Posts list' , 'pnina'), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title 			= apply_filters('widget_title', $instance['title'] );
		$no_of_posts 	= $instance['no_of_posts'];
		$posts_order 	= $instance['posts_order'];
		$thumb 			= $instance['thumb'];

		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
        	<div class="footerInfo">
				<ul class="list-unstyled postLink">
					<?php
					if( $posts_order == 'popular' )
						pnina_popular_posts($no_of_posts , $thumb);

					elseif( $posts_order == 'views' )
						pnina_most_viewed($no_of_posts , $thumb);

					elseif( $posts_order == 'random' )
						pnina_random_posts($no_of_posts , $thumb);

					elseif( $posts_order == 'best' )
						pnina_best_reviews_posts($no_of_posts , $thumb);

					else
						pnina_last_posts($no_of_posts , $thumb)?>
				</ul>
			</div>
	<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['no_of_posts'] 	= strip_tags( $new_instance['no_of_posts'] );
		$instance['posts_order'] 	= strip_tags( $new_instance['posts_order'] );
		$instance['thumb'] 			= strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	public function form( $instance ) {
		$defaults = array( 'title' =>__('Recent Posts' , 'pnina') , 'no_of_posts' => '5' , 'posts_order' => 'latest', 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'pnina') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['posts_order']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Number of posts to show:' , 'pnina') ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if( !empty($instance['no_of_posts']) ) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>"><?php _e( 'Posts order' , 'pnina') ?></label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="latest" <?php if( !empty($instance['posts_order']) && $instance['posts_order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Most recent' , 'pnina') ?></option>
				<option value="random" <?php if( !empty($instance['posts_order']) && $instance['posts_order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Random' , 'pnina') ?></option>
				<option value="popular" <?php if( !empty($instance['posts_order']) && $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Popular / Comments' , 'pnina') ?></option>
				<option value="views" <?php if( !empty($instance['posts_order']) && $instance['posts_order'] == 'views' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Popular / Views' , 'pnina') ?></option>
				<option value="best" <?php if( !empty($instance['posts_order']) && $instance['posts_order'] == 'best' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Best Reviews' , 'pnina') ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php _e( 'Display Thumbnails:' , 'pnina') ?></label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( !empty( $instance['thumb'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>