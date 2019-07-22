<?php
// =============================== My Social Networks Widget ====================================== //
class My_ContactUsWidget extends WP_Widget {

	function My_ContactUsWidget() {
		$widget_ops = array('classname' => 'contact_us_widget', 'description' => __('Link to your Information.', 'kidz'));
		$this->WP_Widget('contact_us', __('Contact Us', 'kidz'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['address']['label'] = $instance['address_label'];		
		$networks['email']['label'] = $instance['email_label'];
		$networks['phone']['label'] = $instance['phone_label'];

		$display = $instance['display'];
		

		echo $before_widget;
		if ( $title )
    		echo $before_title . $title . $after_title;
		?>
		
			<ul class="contact-us">
					<?php foreach(array("address","email", "phone" ) as $network) : ?>
			    		<?php if (!empty($networks[$network]['label'])) : ?>
						<li class="<?php echo  strtolower( $network)?>">
								<span><?php _e($network.': ','kidz');?></span><?php if (($networks[$network]['label'])!="") { echo $networks[$network]['label']; } else { echo $network; } ?>
						</li>
					<?php endif; ?>
					<?php endforeach; ?>
			      
      		</ul>
      
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['address_label'] = $new_instance['address_label'];
		$instance['email_label'] = $new_instance['email_label'];
		$instance['phone_label'] = $new_instance['phone_label'];
		
		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		
		$address_label = $instance['address_label'];			
		$email_label = $instance['email_label'];
		$phone_label = $instance['phone_label'];

		$display = $instance['display'];		


		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Address'); ?>:</legend>
			<input class="widefat" id="<?php echo $this->get_field_id('address_label'); ?>" name="<?php echo $this->get_field_name('address_label'); ?>" type="text" value="<?php echo esc_attr($address_label); ?>" /></p>
        </fieldset>	
    
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Email'); ?>:</legend>
			<input class="widefat" id="<?php echo $this->get_field_id('email_label'); ?>" name="<?php echo $this->get_field_name('email_label'); ?>" type="text" value="<?php echo esc_attr($email_label); ?>" /></p>
		</fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Phone'); ?>:</legend>	
			<input class="widefat" id="<?php echo $this->get_field_id('phone_label'); ?>" name="<?php echo $this->get_field_name('phone_label'); ?>" type="text" value="<?php echo esc_attr($phone_label); ?>" /></p>
        </fieldset>

    
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_ContactUsWidget");'));


?>