<?php
add_action( 'widgets_init', 'MY_BannersWidget_widget' );
function MY_BannersWidget_widget() {
	register_widget( 'MY_BannersWidget' );
}
// =============================== My Banners ======================================
class MY_BannersWidget extends WP_Widget {
    /** constructor */
    function MY_BannersWidget() {
        parent::WP_Widget(false, $name = __('Ads Photo', 'kidz'));	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$banner_url = apply_filters('widget_banner_url', $instance['banner_url']);
		$img_path = apply_filters('widget_img_path', $instance['img_path']);
		$img_width = apply_filters('widget_img_width', $instance['img_width']);
		$img_height = apply_filters('widget_img_height', $instance['img_height']);
        $sticky_banner = apply_filters('widget_sticky_banner', $instance['sticky_banner']);
        ?>
             
              <?php echo $before_widget;?>
                <?php if($sticky_banner){
                    echo '<div style="height: 1px;" id="sticky-side"></div>';
                }?>

                  <div class="banner-holder clearfix <?php echo ($sticky_banner?'sticky-img':''); ?>">
                    <?php if($img_path!="") { ?>
                      <a href="<?php echo $banner_url; ?>" class="banner center-block"><img width="<?php echo $img_width?>" height="<?php echo $img_height?>" src="<?php echo $img_path; ?>" alt="" /></a>
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
		$banner_url = esc_attr($instance['banner_url']);
		$img_path = esc_attr($instance['img_path']);
		$img_width = esc_attr($instance['img_width']);
		$img_height = esc_attr($instance['img_height']);
        $sticky_banner = esc_attr($instance['sticky_banner']);
        ?>
       <p><label for="<?php echo $this->get_field_id('img_path'); ?>"><?php _e('banner path:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('img_path'); ?>" name="<?php echo $this->get_field_name('img_path'); ?>" type="text" value="<?php echo $img_path; ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('banner_url'); ?>"><?php _e('banner Link:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('banner_url'); ?>" name="<?php echo $this->get_field_name('banner_url'); ?>" type="text" value="<?php echo $banner_url; ?>" /></label></p>
       
       <p><label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('banner Width:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo $img_width; ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('img_height'); ?>"><?php _e('banner Height:', 'kidz'); ?> <input class="widefat" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo $img_height; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('sticky_banner'); ?>"><?php _e('Enable Sticky:', 'kidz'); ?> <input type="checkbox" class="" id="<?php echo $this->get_field_id('sticky_banner'); ?>" name="<?php echo $this->get_field_name('sticky_banner'); ?>" value="1"  <?php echo ($sticky_banner?'checked':''); ?> ></label></p>
			 
        <?php 
    }

} // class Widget

?>