<?php
add_action( 'widgets_init', 'pnina_social_widget_box' );
function pnina_social_widget_box() {
	register_widget( 'pnina_social_widget' );
}
class pnina_social_widget extends WP_Widget {

	function pnina_social_widget() {
		$widget_ops 	= array( 'classname' => 'social-icons-widget' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'social' );
		parent::__construct( 'social', __( 'Socail icons' , 'kidz') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title 		= apply_filters('widget_title', $instance['title'] );
		$tran_bg 	= $instance['tran_bg'];
		$newtap 	= '';
		$colored 	= true;

		if( !empty($instance['newtap']) ){
			$newtap = $instance['newtap'];
		}

		if( !empty($instance['gray']) ){
			$colored = false;
		}

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
				echo '<div class="inner-widget">';
					get_social_icon( $newtap, $colored, 'social-link' );
				echo '</div>';
			echo $after_widget;
		}
		else { ?>
			<div class="widget-container social-icons-widget">
			<?php get_social_icon( $newtap , $colored, 'social-link' ); ?>
			</div>
		<?php }			
	}

	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['tran_bg'] 	= strip_tags( $new_instance['tran_bg'] );
		$instance['newtap'] 	= strip_tags( $new_instance['newtap'] );
		$instance['gray'] 		= strip_tags( $new_instance['gray'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Social' , 'kidz') , 'icon_size' =>'16' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'kidz') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newtap' ); ?>"><?php _e( 'Open links in a new tab:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'newtap' ); ?>" name="<?php echo $this->get_field_name( 'newtap' ); ?>" value="yes" <?php if( !empty( $instance['newtap'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gray' ); ?>"><?php _e( 'Gray icons without background' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'gray' ); ?>" name="<?php echo $this->get_field_name( 'gray' ); ?>" value="yes" <?php if( !empty( $instance['gray'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>