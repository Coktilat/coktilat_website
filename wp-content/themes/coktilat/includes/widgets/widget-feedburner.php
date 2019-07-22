<?php
add_action( 'widgets_init', 'holol_feedburner_widget_box' );
function holol_feedburner_widget_box() {
	register_widget( 'holol_feedburner_widget' );
}
class holol_feedburner_widget extends WP_Widget {

	function holol_feedburner_widget() {
		$widget_ops 	= array( 'classname' => 'widget-feedburner' , 'description' => 'Subscribe to feedburner via email' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-feedburner' );
		parent::__construct( 'widget-feedburner',__( 'Feedburner' , 'kidz' ) , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if( function_exists('icl_t') )  $text_code = icl_t( THEME_NAME , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
		$feedburner = $instance['feedburner'];
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		echo '<div class="widget-feedburner-counter">
		<p>'.do_shortcode( $text_code ).'</p>' ; ?>
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="feedburner-email" type="text" name="email" value="<?php e_( 'Enter your e-mail address' ) ; ?>" onfocus="if (this.value == '<?php e_( 'Enter your e-mail address' ) ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php e_( 'Enter your e-mail address' ) ; ?>';}">
			<input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
			<input type="hidden" name="loc" value="en_US">			
			<input class="feedburner-subscribe" type="submit" name="submit" value="<?php e_( 'Subscribe' ) ; ?>"> 
		</form>
		</div>
		<?php
		echo $after_widget;			
	}

	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['text_code'] 	= $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		
		if (function_exists('icl_register_string')) {
			icl_register_string( THEME_NAME , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'FeedBurner Widget' , 'kidz') , 'text_code' => __( 'Subscribe to our email newsletter.' , 'kidz') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>"><?php _e( 'Text above Email Input Field:' , 'kidz') ?><small><?php _e( '( Supports : Html & Shortcodes )' , 'kidz') ?></small> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty($instance['text_code']) )  echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>"><?php _e( 'Feedburner ID:' , 'kidz') ?></label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php if( !empty($instance['feedburner']) )  echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}
?>