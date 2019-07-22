<?php
add_action( 'widgets_init', 'tie_search_widget' );
function tie_search_widget() {
	register_widget( 'tie_search' );
}
class tie_search extends WP_Widget {

	public function __construct(){
		$widget_ops 	= array( 'classname' => 'search'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		parent::__construct( 'search-widget', __( 'Custom Search' , 'kidz') , $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {?>
			<form method="get" action="<?php echo home_url(); ?>/">
			<div class="input-group">
            	<input type="text" id="s" name="s" class="form-control" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Enter Your Search' , 'kidz' ) ?>" aria-describedby="basic-addon2" />
				<span class="input-group-addon" id="basic-addon2">
                <input class="btn btn-primary bg-color-1" type="submit" value="<?php _e( 'Search' , 'kidz' ) ?>"></span>
			</div>
			</form>
<?php
	}
}
?>