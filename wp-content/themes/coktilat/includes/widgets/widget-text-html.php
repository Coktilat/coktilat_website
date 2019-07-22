<?php
add_action( 'widgets_init', 'holol_text_html_widget' );
function holol_text_html_widget() {
	register_widget( 'holol_text_html' );
}
class holol_text_html extends WP_Widget {

	function holol_text_html() {
		$widget_ops = array( 'classname' => 'text-html'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'eventSidebar' );
		parent::__construct( 'eventSidebar', __( 'text or html code' , 'kidz') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$text_code = $instance['text_code'];

		$center 	= $instance['center'];
		
		if ($center){
			$center = 'style="text-align:center;"';
		}else{
			$center = '';
		}

			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
			echo '<div class="panel-body" '.$center.'>
			<div class="homeContactContent">';
			echo do_shortcode( $text_code ) .'
				</div></div>';
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['text_code']	= $new_instance['text_code'] ;
		$instance['center'] 	= strip_tags( $new_instance['center'] );
		
		if (function_exists('icl_register_string')) {
			icl_register_string( THEME_NAME , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Text' , 'kidz')  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'center' ); ?>"><?php _e( 'Center content:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'center' ); ?>" name="<?php echo $this->get_field_name( 'center' ); ?>" value="true" <?php if( !empty( $instance['center'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>"><?php _e( 'Text , Shortcodes or HTML code:' , 'kidz') ?></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty( $instance['text_code'] ) ) echo $instance['text_code']; ?></textarea>
		</p>
	<?php
	}
}
?>