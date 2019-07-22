<?php
add_action( 'widgets_init', 'holol_soundcloud_widget' );
function holol_soundcloud_widget() {
	register_widget( 'holol_soundcloud' );
}
class holol_soundcloud extends WP_Widget {

	function holol_soundcloud() {
		$widget_ops 	= array( 'classname' => 'holol-soundcloud'  );
		$control_ops 	= array( 'width' => 340, 'height' => 350, 'id_base' => 'holol-soundcloud-widget' );
		parent::__construct( 'holol-soundcloud-widget',__( 'Soundcloud' , 'kidz') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title 			= apply_filters('widget_title', $instance['title'] );
		$url 			= $instance['url'];
		$autoplay 		= $instance['autoplay'];
		$visual_style 	= $instance['visual_style'];
		
		$play = $visual = 'false';
		if( !empty( $autoplay )) 		$play 	= 'true';
		if( !empty( $visual_style ))	$visual = 'true';

		echo $before_widget;
		echo $before_title;
		echo $title; 
		echo $after_title;
		echo holol_soundcloud( $url, $play, $visual );
		echo $after_widget;	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['url'] 			= $new_instance['url'] ;
		$instance['autoplay']		= strip_tags( $new_instance['autoplay'] );
		$instance['visual_style'] 	= strip_tags( $new_instance['visual_style'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'SoundCloud'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php if( !empty($instance['url']) ) echo $instance['url']; ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Autoplay' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( !empty( $instance['autoplay'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'visual_style' ); ?>"><?php _e( 'Visual Style' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'visual_style' ); ?>" name="<?php echo $this->get_field_name( 'visual_style' ); ?>" value="true" <?php if( !empty( $instance['visual_style'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
	<?php
	}
}
?>