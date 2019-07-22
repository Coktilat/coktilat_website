<?php
add_action( 'widgets_init', 'MY_AdsWidget_widget' );
function MY_AdsWidget_widget() {
	register_widget( 'MY_AdsWidget' );
}
// =============================== My Banners ======================================
class MY_AdsWidget extends WP_Widget {
    /** constructor */
    function MY_AdsWidget() {
        parent::WP_Widget(false, $name = 'Ads Text');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$ads_url = apply_filters('widget_ads_url', $instance['ads_url']);
		$ads_text = apply_filters('widget_ads_text', $instance['ads_text']);
		$ads_color = apply_filters('widget_ads_color', $instance['ads_color']);
		$ads_bg = apply_filters('widget_ads_bg', $instance['ads_bg']);
        ?>
        <style>
			<?php if($ads_color){?>
				.adstext-holder a{
					color:#<?php echo trim($ads_color,'#')?>;
				}
			<?php }?>
			<?php if($ads_bg){?>
				.adstext-holder{
					background:#<?php echo trim($ads_bg,'#')?>;
				}
			<?php }?>
		</style>
             
              <?php echo $before_widget;?>
                  <div class="adstext-holder clearfix">
                    <?php if($ads_text!="") { ?>
                      <a href="<?php echo $banner_url; ?>"><?php echo $ads_text?></a>
                    <?php }?>
                  </div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
					
		$ads_url = esc_attr($instance['ads_url']);
		$ads_text = esc_attr($instance['ads_text']);
		$ads_color = esc_attr($instance['ads_color']);
		$ads_bg = esc_attr($instance['ads_bg']);
        ?>
       <p><label for="<?php echo $this->get_field_id('ads_url'); ?>"><?php _e('Ads Link:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('ads_url'); ?>" name="<?php echo $this->get_field_name('ads_url'); ?>" type="text" value="<?php echo $ads_url; ?>" /></label></p>
       
       <p><label for="<?php echo $this->get_field_id('ads_text'); ?>"><?php _e('Text:', 'kidz'); ?>
       <textarea class="widefat" id="<?php echo $this->get_field_id('ads_text'); ?>" name="<?php echo $this->get_field_name('ads_text'); ?>"><?php echo $ads_text; ?></textarea></label></p>
       
       <p><label for="<?php echo $this->get_field_id('ads_color'); ?>"><?php _e('Color:', 'kidz'); ?> 
       <input class="widefat" id="<?php echo $this->get_field_id('ads_color'); ?>" name="<?php echo $this->get_field_name('ads_color'); ?>" type="text" value="<?php echo $ads_color; ?>" /></label></p>
       
       <p><label for="<?php echo $this->get_field_id('ads_bg'); ?>"><?php _e('Background:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('ads_bg'); ?>" name="<?php echo $this->get_field_name('ads_bg'); ?>" type="text" value="<?php echo $ads_bg; ?>" /></label></p>
       
			 
        <?php 
    }

} // class Widget

?>