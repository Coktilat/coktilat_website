<?php

function limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

function custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 1170;

function stytech_theme_support() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_image_size( 'story',600,360, true );
	add_image_size( 'medium',400,285, true );
	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array( 
			'main_nav' => 'Main Menu',
			'footer_nav' => 'Footer Menu',
            'footer_nav2' => 'Footer2 Menu',
            'mobile_nav' => 'Mobile Menu',
		)
	);	
	add_post_type_support( 'page', 'excerpt' );
}

add_action('after_setup_theme','stytech_theme_support');

function theme_main_nav() {
    wp_nav_menu( 
    	array( 
    		'menu' => 'main_nav', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'fallback_cb' => 'false', /* menu fallback */
			'walker' => new Bootstrap_walker()
    	)
    );
}
function theme_mobile_nav() {
    wp_nav_menu(
        array(
            'menu' => 'mobile_nav', /* menu name */
            'menu_class' => 'nav navbar-nav',
            'theme_location' => 'mobile_nav', /* where in the theme it's assigned */
            'container' => 'false', /* container class */
            'fallback_cb' => 'false', /* menu fallback */
            'walker' => new Bootstrap_walker()
        )
    );
}

function theme_footer_nav() {
    wp_nav_menu( 
    	array( 
    		'menu' => 'footer_nav', /* menu name */
    		'menu_class' => 'footer-nav',
    		'theme_location' => 'footer_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'fallback_cb' => 'false', /* menu fallback */
    	)
    );
}

function theme_footer_nav2() {
    wp_nav_menu(
        array(
            'menu' => 'footer_nav2', /* menu name */
            'menu_class' => 'footer-nav2',
            'theme_location' => 'footer_nav2', /* where in the theme it's assigned */
            'container' => 'false', /* container class */
            'fallback_cb' => 'false', /* menu fallback */
        )
    );
}

add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function theme_widgets_init() {
	register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Page Sidebar',
    	'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="">',
    	'after_title' => '</h3>',
    ));
	register_sidebar(array(
    	'id' => 'footer1',
    	'name' => 'footer1',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="">',
    	'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'id' => 'footer2',
        'name' => 'footer2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'id' => 'footer3',
        'name' => 'footer3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="">',
        'after_title' => '</h3>',
    ));
}

add_action( 'widgets_init', 'theme_widgets_init' );

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'PostViewsCount';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        update_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'PostViewsCount';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        update_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/*
 * custom pagination with bootstrap .pagination class
 * source: http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
 */
function page_navi( $echo = true ) {
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type'  => 'array',
            'prev_next'   => true,
            'prev_text'    => __('«'),
            'next_text'    => __('»'),
        )
    );

    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

        $pagination = '<ul class="pagination clearfix">';

        foreach ( $pages as $page ) {
            $pagination .= "<li>$page</li>";
        }

        $pagination .= '</ul>';

        if ( $echo ) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }
}


function breadcrumb_lists(array $options = array() ) {
	
	// default values assigned to options
	$options = array_merge(array(
	'crumbId' => 'breadcrumb', // id for the breadcrumb Div
	'crumbClass' => 'breadcrumb', // class for the breadcrumb Div
	'beginningText' => '', // text showing before breadcrumb starts
	'showOnHome' => 0,// 1 - show breadcrumbs on the homepage, 0 - don't show
	'delimiter' => '', // delimiter between crumbs
	'homePageText' => __('Home'), // text for the 'Home' link
	'showCurrent' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
	'beforeTag' => '<li class="active">', // tag before the current breadcrumb
	'afterTag' => '</li>', // tag after the current crumb
	'showTitle'=> 1 // showing post/page title or slug if title to show then 1
   ), $options);
   
   $crumbId = $options['crumbId'];
	$crumbClass = $options['crumbClass'];
	$beginningText = $options['beginningText'] ;
	$showOnHome = $options['showOnHome'];
	$delimiter = $options['delimiter']; 
	$homePageText = $options['homePageText']; 
	$showCurrent = $options['showCurrent']; 
	$beforeTag = $options['beforeTag']; 
	$afterTag = $options['afterTag']; 
	$showTitle =  $options['showTitle']; 
	
	global $post;

	$wp_query = $GLOBALS['wp_query'];

	$homeLink = home_url();
	
	echo '<ul id="'.$crumbId.'" class="'.$crumbClass.'" >'.$beginningText;
	
	if (is_home() || is_front_page()) {
	
	  if ($showOnHome == 1)

		  echo $beforeTag . $homePageText . $afterTag;

	} else { 
	
	  echo '<li><a href="' . $homeLink . '">' . $homePageText . '</a></li> ' . $delimiter . ' ';
	
	  if ( is_category() ) {
		$thisCat = get_category(get_query_var('cat'), false);
		if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
		echo $beforeTag . '' . single_cat_title('', false) . '' . $afterTag;
	
	  } elseif ( is_tax() ) {
		  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		  $parents = array();
		  $parent = $term->parent;
		  while ( $parent ) {
			  $parents[] = $parent;
			  $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
			  $parent = $new_parent->parent;

		  }		  
		  if ( ! empty( $parents ) ) {
			  $parents = array_reverse( $parents );
			  foreach ( $parents as $parent ) {
				  $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
				  echo '<li><a href="' . get_term_link( $item->slug, get_query_var( 'taxonomy' ) ) . '">' . $item->name . '</a></li>'  . $delimiter. ' ';
			  }
		  }

		  $queried_object = $wp_query->get_queried_object();
		  echo $beforeTag . $queried_object->name . $afterTag;	  
		  } elseif ( is_search() ) {
		echo $beforeTag . __('Search results for','pnina').' "' . get_search_query() . '"' . $afterTag;
	
	  } elseif ( is_day() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
		echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
		echo $beforeTag . get_the_time('d') . $afterTag;
	
	  } elseif ( is_month() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
		echo $beforeTag . get_the_time('F') . $afterTag;
	
	  } elseif ( is_year() ) {
		echo $beforeTag . get_the_time('Y') . $afterTag;
	
	  } elseif ( is_single() && !is_attachment() ) {
		  
		     if($showTitle)
			   $title = get_the_title();
			  else
			  $title =  $post->post_name;
			  	if ( get_post_type() == 'product' ) { 
					  if ( $terms = wp_get_object_terms( $post->ID, 'product_cat' ) ) {
		
						  $term = current( $terms );
		
						  $parents = array();
		
						  $parent = $term->parent;
						  while ( $parent ) {
		
							  $parents[] = $parent;
		
							  $new_parent = get_term_by( 'id', $parent, 'product_cat' );
		
							  $parent = $new_parent->parent;
		
						  }
						  if ( ! empty( $parents ) ) {
		
							  $parents = array_reverse($parents);
		
							  foreach ( $parents as $parent ) {
		
								  $item = get_term_by( 'id', $parent, 'product_cat');
		
								  echo  '<li><a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a></li>'  . $delimiter;
		
							  }
		
						  }
						  echo  '<li><a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a></li>'  . $delimiter;
					  }
					  echo $beforeTag . $title . $afterTag;
				  }  elseif ( get_post_type() != 'post' ) {
				  $post_type = get_post_type_object(get_post_type());
				  $slug = $post_type->rewrite;
				  echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
				  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . $title . $afterTag;
				} else {
				  $cat = get_the_category(); $cat = $cat[0];
				  $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				  if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				  echo $cats;
				  if ($showCurrent == 1) echo $beforeTag . $title . $afterTag;
		
				}

	  } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		  
		$post_type = get_post_type_object(get_post_type());
		
		echo $beforeTag . $post_type->labels->singular_name . $afterTag;
			 
	 } elseif ( is_attachment() ) {
			 
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . get_the_title() . $afterTag;	
		  
		} elseif ( is_page() && !$post->post_parent ) {
			$title =($showTitle)? get_the_title():$post->post_name;
			  
		if ($showCurrent == 1) echo $beforeTag .  $title . $afterTag;

	  } elseif ( is_page() && $post->post_parent ) {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		  $page = get_page($parent_id);
		  $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
		  $parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) {
		  echo $breadcrumbs[$i];
		  if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		}
			$title =($showTitle)? get_the_title():$post->post_name;
		   
	if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . $title . $afterTag;

	  } elseif ( is_tag() ) {

		echo $beforeTag . ''.__('Posts tagged').' "' . single_tag_title('', false) . '"' . $afterTag;

	  } elseif ( is_author() ) {
		 global $author;
		$userdata = get_userdata($author);

		echo $beforeTag . ''.__('Articles posted by').'' . $userdata->display_name . $afterTag;

	  } elseif ( is_404() ) {
		  
		echo $beforeTag . ''.__('Error 404').'' . $afterTag;

	  }

	  if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo ' (';
		echo __('Page') . ' ' . get_query_var('paged');
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo ')';
	  }
	}
	echo '</ul>';
  }


/************* COMMENT LAYOUT *********************/
// Comment Layout
function theme_custom_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment ;
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<div  <?php comment_class('comment-wrap'); ?> >
			<div class="comment-avatar"><?php echo get_avatar( $comment, 65 ); ?></div>

			<div class="comment-content">
				<div class="author-comment">
					<?php printf( '%s ', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit' ), ' ' ); ?></div><!-- .comment-meta .commentmetadata -->
					<div class="clear"></div>
				</div>
			
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','alnahr' ); ?></em>
					<br />
				<?php endif; ?>
					
				<?php comment_text(); ?>
			</div>
			<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
}
// Display trackbacks/pings callback function
/*-----------------------------------------------------------------------------------*/
# Custom Pings Template
/*-----------------------------------------------------------------------------------*/
function theme_custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
	<li class="comment pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit' ), ' ' ); ?></p>
<?php	
}

/*--------------------------------------------------------------------*/
# Social
/*--------------------------------------------------------------------*/
function get_social_icon(){ ?>
    	<ul class="social">
<?php

        if ( $youtube = ps_option('of_youtube') ){
            ?><li><a class="be" title="youtube" href="<?php echo esc_url( $youtube ) ; ?>" target="_blank" ><i class="fa fa-youtube-play"></i></a></li><?php
        }
        if ( $whatsapp = ps_option('of_whatsapp') ){
            ?><li><a class="dr" title="whatsapp" href="<?php echo esc_url( $whatsapp ) ; ?>" target="_blank" ><i class="fa fa-whatsapp"></i></a></li><?php
        }
            if ( $linkedin = ps_option('of_linkedin') ){
                ?><li><a class="in" title="linkedin" href="<?php echo esc_url( $linkedin ) ; ?>" target="_blank" ><i class="fa fa-linkedin"></i></a></li><?php
            }
            if ( $instagram = ps_option('of_instagram') ){
                ?><li><a class="ins" title="instagram" href="<?php echo esc_url( $instagram ) ; ?>" target="_blank" ><i class="fa fa-instagram"></i></a></li><?php
            }
            if ( $gplus = ps_option('of_gplus') ){
                ?><li><a class="gp" title="linkedin" href="<?php echo esc_url( $gplus ) ; ?>" target="_blank" ><i class="fa fa-google-plus"></i></a></li><?php
            }
            if ( $twitter = ps_option('of_twitter') ){
                ?><li><a class="tw" title="twitter" href="<?php echo esc_url( $twitter ) ; ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li><?php
            }
            if ( $facebook = ps_option('of_facebook') ){
                ?><li><a class="fc" title="facebook" href="<?php echo esc_url( $facebook ) ; ?>" target="_blank" ><i class="fa fa-facebook"></i></a></li><?php
            }
	?>
	</ul>
    <?php
}


class Bootstrap_walker extends Walker_Nav_Menu{

    function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = $data_toggle = '';

        // If the item has children, add the dropdown class for bootstrap
        if ( $args->has_children ) {
            $class_names = "dropdown ";
        }
        if ( $args->has_children ) {
            $data_toggle = ' data-toggle="dropdown" ';
        }
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .' >';

        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        // if the item has children add these two attributes to the anchor tag
        // if ( $args->has_children ) {
        // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
        // }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes . $data_toggle.'>';
        $item_output .= '<span>'.$args->link_before .apply_filters( 'the_title', $object->title, $object->ID ).'</span>';
        $item_output .= $args->link_after;

        // if the item has children add the caret just before closing the anchor tag
        if ( $args->has_children ) {
            $item_output .= '<b class="caret"></b></a>';
        }
        else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
    } // end start_el function

    function start_lvl(&$output, $depth = 0, $args = Array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
    if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
        $classes[] = "active";
    }

    return $classes;
}

/*-----------------------------------------------------------------------------------*/
# Get the post time
/*-----------------------------------------------------------------------------------*/
function theme_get_time( $return = false ){
	global $post ;

	if( get_option( 'time_format' ) == 'none' ){
		return false;

	}elseif( get_option( 'time_format' ) == 'modern' ){	

		$time_now  = current_time('timestamp');
		$post_time = get_the_time('U') ;

		if ( $post_time > $time_now - ( 60 * 60 * 24 * 30 ) ) {
			$since = sprintf( __( '%s ago' ), human_time_diff( $post_time, $time_now ) );
		} else {
			$since = get_the_time(get_option('date_format'));
		}

	}else{
		$since = get_the_time(get_option('date_format'));
	}
	
	$post_time = '<time class="postDate"><i class="icon-clock"></i>'.$since.'</time>';

	if( $return ){
		return $post_time;
	}else{
		echo $post_time;
	}
}

add_action( 'wp_ajax_nopriv_send_contact', 'send_contact_callback' );
add_action( 'wp_ajax_send_contact', 'send_contact_callback' );

function send_contact_callback() {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(empty($name) || empty($email) || empty($message)){
        echo json_encode(array('send'=>false,'message'=>'Please make sure you fill out the required fields'));
    }elseif(!is_email( $email )){
        echo json_encode(array('send'=>false,'message'=>'Please check your email'));
    }else{
        $to = array();
        $to[0] = 'info@cardial.com.sa';
        if(empty($subject)){
            $subject = 'Contact Message';
        }

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: '.$name.' <info@cardial.sa> ' . "\r\n" .
            'Cc: ' .$to[0]. "\r\n" .
            "Reply-To:".$email. "\r\n" .
            "X-Mailer: PHP/" . phpversion();
        $msg = 'Name: '.$name;
        $msg .= '<br/><br/>Email: '.$email;
        $msg .= '<br/><br/>'.$message;

        if(wp_mail( $to, $subject, $msg, $headers)){
            echo json_encode(array('send'=>true,'message'=>'Message sent successfully...'));
        }else{
            echo json_encode(array('send'=>true,'message'=>'Sorry, an error occurred ... The message was not sent.'));
        }

    }
    die();
}


/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts
/*-----------------------------------------------------------------------------------*/
function pnina_last_posts($posts_number = 5 , $thumb = true){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'posts_per_page'		 => $posts_number,
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $get_posts_query = new WP_Query( $args );

    if ( $get_posts_query->have_posts() ):
        while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post();
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a class="media-left" href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category
/*-----------------------------------------------------------------------------------*/
function pnina_last_posts_cat($posts_number = 5 , $thumb = true , $cats = 1){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'posts_per_page'		 => $posts_number,
        'cat'					 => $cats,
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $get_posts_query = new WP_Query( $args );

    if ( $get_posts_query->have_posts() ):
        while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post();
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a class="media-left" href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Random posts
/*-----------------------------------------------------------------------------------*/
function pnina_random_posts($posts_number = 5 , $thumb = true){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'posts_per_page'		 => $posts_number,
        'orderby'				 => 'rand',
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $get_posts_query = new WP_Query( $args );

    if ( $get_posts_query->have_posts() ):
        while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post();
            $count = ($i%6)+1;
            $i++;
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a class="media-left" href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Popular posts
/*-----------------------------------------------------------------------------------*/
function pnina_popular_posts( $posts_number = 5 , $thumb = true){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'orderby'				 => 'comment_count',
        'order'					 => 'DESC',
        'posts_per_page'		 => $posts_number,
        'post_status'			 => 'publish',
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $popularposts = new WP_Query( $args );
    if ( $popularposts->have_posts() ):
        while ( $popularposts->have_posts() ) : $popularposts->the_post();
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a class="media-left" href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Popular posts / Views
/*-----------------------------------------------------------------------------------*/
function pnina_most_viewed( $posts_number = 5 , $thumb = true){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'orderby'				 => 'meta_value_num',
        'meta_key'				 => 'tie_views',
        'posts_per_page'		 => $posts_number,
        'post_status'			 => 'publish',
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $popularposts = new WP_Query( $args );
    if ( $popularposts->have_posts() ):
        $i=0;
        while ( $popularposts->have_posts() ) : $popularposts->the_post();
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a class="media-left" href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Best Reviews posts
/*-----------------------------------------------------------------------------------*/
function pnina_best_reviews_posts( $posts_number = 5 , $thumb = true){
    global $post;
    $original_post = $post;

    $args = array(
        'post_type'				 => 'news',
        'orderby'				 => 'meta_value_num',
        'meta_key'				 => 'taq_review_score',
        'posts_per_page'		 => $posts_number,
        'post_status'			 => 'publish',
        'no_found_rows'          => true,
        'ignore_sticky_posts'	 => true
    );

    $best_views = new WP_Query( $args );

    if ( $best_views->have_posts() ):
        $i=0;
        while ( $best_views->have_posts() ) : $best_views->the_post();
            ?>
            <li>
                <div class="media">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'media-object img-rounded border-color-'.$count)); ?>
                        </a>
                    <?php endif; ?>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h5>
                        <p><?php the_time('F j - Y')?></p>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    endif;

    $post = $original_post;
    wp_reset_query();
}

function wp_bootstrap_gallery( $content, $attr ) {
    global $instance, $post;
    $instance++;
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( ! $attr['orderby'] )
            unset( $attr['orderby'] );
    }
    extract( shortcode_atts( array(
        'order'			=>	'ASC',
        'orderby'		=>	'menu_order ID',
        'id'			=>	$post->ID,
        'itemtag'		=>	'figure',
        'icontag'		=>	'div',
        'captiontag'	=>	'figcaption',
        'columns'		=>	3,
        'size'			=>	'thumbnail',
        'include'		=>	'',
        'exclude'		=>	''
    ), $attr ) );
    $id = intval( $id );
    if ( 'RAND' == $order ) {
        $orderby = 'none';
    }
    if ( $include ) {

        $include = preg_replace( '/[^0-9,]+/', '', $include );

        $_attachments = get_posts( array(
            'include'			=>	$include,
            'post_status'		=>	'inherit',
            'post_type'			=>	'attachment',
            'post_mime_type'	=>	'image',
            'order'				=>	$order,
            'orderby'			=>	$orderby
        ) );
        $attachments = array();

        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( $exclude ) {

        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );

        $attachments = get_children( array(
            'post_parent'		=>	$id,
            'exclude'			=>	$exclude,
            'post_status'		=>	'inherit',
            'post_type'			=>	'attachment',
            'post_mime_type'	=>	'image',
            'order'				=>	$order,
            'orderby'			=>	$orderby
        ) );
    } else {

        $attachments = get_children( array(
            'post_parent'		=>	$id,
            'post_status'		=>	'inherit',
            'post_type'			=>	'attachment',
            'post_mime_type'	=>	'image',
            'order'				=>	$order,
            'orderby'			=>	$orderby
        ) );
    }
    if ( empty( $attachments ) ) {
        return;
    }
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        return $output;
    }
    $itemtag	=	tag_escape( $itemtag );
    $captiontag	=	tag_escape( $captiontag );
    $columns	=	intval( min( array( 8, $columns ) ) );
    $float		=	(is_rtl()) ? 'right' : 'left';

    $selector	=	"gallery-{$instance}";
    $size_class	=	sanitize_html_class( $size );
    $output		=	"<div class='row' id='$selector'>";
    /**
     * Count number of items in $attachments array, and assign a colum layout to $span_array
     * variable based on the mumber of images in the $attachments array
     */
    $span_array = null;
    switch (count($attachments)) {
        case 1:
            /* One full width image */
            $span_array = array(12);
            break;
        case 2:
            /* Two half width images */
            $span_array = array(6,6);
            break;
        case 3:
            /* One 3/4 width image with two 1/4 width images to the right */
            $span_array = array(8,4,4);
            break;
        case 4:
            /* One full width image with three 1/3 width images underneath */
            $span_array = array(12,4,4,4);
            break;
        case 5:
            /* Two half width images with fout 1/4 width images underneath */
            $span_array = array(6,6,4,4,4);
            break;
        case 6:
            /* One 2/3 width image with two 1/3 width images to the right,
             * and three 1/3 width images underneath */
            $span_array = array(8,4,4,4,4,4);
            break;
        default:
            /* One full width image with two 1/2 width images underneath
             * All remaining images 1/3 width underneath */
            $span_array = array(12,6,6,4);
            break;
    }
    $attachment_count = 0;
    foreach ( $attachments as $id => $attachment ) {

        $attachment_image = wp_get_attachment_image( $id, 'full');
        $attachment_link = wp_get_attachment_url( $id, 'full', ! ( isset( $attr['link'] ) AND 'file' == $attr['link'] ) );

        $output .= "<div class='mb20 col-sm-" . $span_array[$attachment_count] . "'>";
        $output .= '<div class="bg-image" style="padding-top:65%;background-image: url('.$attachment_link.')"></div>';
        $output .= "</div>\n";
        if(count($attachments) >= 7 && $attachment_count == 3){
            $attachment_count = 3;
        } else {
            $attachment_count++;
        }
    }

    $output .= "</div>\n";

    return $output;
}
add_filter( 'post_gallery', 'wp_bootstrap_gallery', 10, 2 );


function get_service_posts_callback() {
    global $sitepress;

    $id = $_POST['id'];
    if ( isset($id) ){
        $service = get_post($id);
        $bgcolor = get_field('bgcolor',$id);
        $icon_font = get_field('icon_font',$id);
        ?>
        <div class="service-heading">
            <div class="row">
                <div class="col-sm-6">
                    <div class="service-head">
                        <span class="service-icon" style="background-color: <?php echo $bgcolor?>"><i class="fa fa-<?php echo $icon_font?>"></i> </span>
                        <h3><?php echo $service->post_title?></h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="headingRight">
                        <a class="btn btn-download" href="#"><?php _e('Download','pnina')?></a>
                        <div class="service-share">
                            <span><img src="<?php echo get_template_directory_uri()?>/images/share.png" width="23"></span>

                            <a href="javascript:" onclick="window.open('//www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>','Facebook','width=800,height=300');return false;" target="_blank" title="Share on Facebook" class="fc"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="javascript:" onclick="window.open('//twitter.com/share?url=<?php the_permalink()?>&amp;text=#<?php the_title()?>', '_blank', 'width=800,height=300')" target="_blank" title="Share on twitter" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="javascript:" onclick="javascript:window.open('//www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink()?>','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" title="Share on LinkedIn" class="in"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            <a href="#" class="whatsapp"><i class="fa fa-whatsapp"></i></a>
                        </div>
                        <button type="button" class="close-service"><i class="fa fa-close"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-content">
            <?php echo $service->post_content?>
        </div>
        <div class="service-footer">
            <button type="button" class="btn btn-lg btn-primary close-service"><?php _e('Close','pnina')?></button>
        </div>

        <?php
        die();
    } // end if
}
add_action('wp_ajax_service_posts', 'get_service_posts_callback');
add_action('wp_ajax_nopriv_service_posts', 'get_service_posts_callback');//for users that are not logged in.

?>