<?php

add_action( 'widgets_init', 'holol_acebook_widget_box' );
function holol_acebook_widget_box() {
	register_widget( 'holol_facebook_widget' );
}
class holol_facebook_widget extends WP_Widget {

	function holol_facebook_widget() {
		$widget_ops 	= array( 'classname' => 'facebook-widget' );
		$control_ops 	= array( 'width' => 340, 'height' => 350, 'id_base' => 'facebook-widget' );
		parent::__construct( 'facebook-widget',__( 'Facebook' , 'kidz' ) , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$color = 'light';
		if( !empty($instance['dark']) ) $color = 'dark';
		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];
		$protocol = is_ssl() ? 'https' : 'http';

		echo $before_widget;
			echo $before_title;
			echo $title ;
			 echo $after_title; 
		  ?>
			<div class="facebook-box inner-widget">
				<iframe src="<?php echo $protocol ?>://www.facebook.com/plugins/likebox.php?href=<?php echo $page_url ?>&amp;width=360&amp;height=300&amp;colorscheme=<?php echo $color; ?>&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:215px;" allowTransparency="true"></iframe>
			</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		$instance['dark'] = strip_tags( $new_instance['dark'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Find us on Facebook' , 'kidz') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php _e( 'Page URL :' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty($instance['page_url']) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dark' ); ?>"><?php _e( 'Dark Skin ?' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'dark' ); ?>" name="<?php echo $this->get_field_name( 'dark' ); ?>" value="true" <?php if( !empty($instance['dark']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>