<?php
add_action( 'widgets_init', 'holol_login_widget_box' );
function holol_login_widget_box() {
	register_widget( 'holol_login_widget' );
}
class holol_login_widget extends WP_Widget {

	function holol_login_widget() {
		$widget_ops 	= array( 'classname' => 'login-widget'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'login-widget' );
		parent::__construct( 'login-widget',__( 'Login Form' , 'kidz'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		holol_login_form();
		echo $after_widget;
			
	}

	function update( $new_instance, $old_instance ) {
		$instance 			= $old_instance;
		$instance['title'] 	= strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Login' , 'kidz')  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php  if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
?>