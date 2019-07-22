<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

	$opt_name = "ps_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'ps_option/opt_name', $opt_name );


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
	'opt_name'             => $opt_name,
	'display_name'         => $theme->get( 'Name' ),
	'display_version'      => $theme->get( 'Version' ),
	'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
	'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
	'update_notice'         => false,
	'admin_bar'             => true,
	'dev_mode'              => false,
	'menu_icon'             => 'dashicons-hammer',
	'menu_type'             => 'menu',
	'allow_sub_menu'        => true,
	'page_parent_post_type' => '',
	'default_mark'          => '',
	'hints'                 => array(
		'icon_position' => 'right',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color' => 'light',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'duration' => '500',
				'event'    => 'mouseleave unfocus',
			),
		),
	),
	'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => true,
	'network_sites'         => true
);

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */
Redux::setSection( $opt_name, array(
	'title'   => __( 'General', 'pnina' ),
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
        array(
            'id'       => 'of_logo',
            'url'      => false,
            'type'     => 'media',
            'title'    => __( 'Site Logo', 'pnina' ),
            'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
            'subtitle' => __( 'Upload your logo file here.', 'pnina' ),
        ),

        array(
            'id'      => 'overview',
            'type'    => 'editor',
            'title'   => __( 'Overview Home page', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'about_us',
            'type'    => 'editor',
            'title'   => __( 'About Us', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'earnings_desc',
            'type'    => 'editor',
            'title'   => __( 'Focus on your earnings', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'coktailer_desc',
            'type'    => 'editor',
            'title'   => __( 'Be Coktailer', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'contact_desc',
            'type'    => 'editor',
            'title'   => __( 'Contact Desc', 'pnina' ),
            'default' => ''
        ),
		array(
			'id'      => 'email',
			'type'    => 'text',
			'title'   => __( 'Email', 'pnina' ),
			'default' => ''
		),
        array(
            'id'      => 'phone',
            'type'    => 'text',
            'title'   => __( 'Phone', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'copyright',
            'type'    => 'textarea',
            'title'   => __( 'Copyright', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'contact_form',
            'type'    => 'text',
            'title'   => __( 'Contact form', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'hire_form',
            'type'    => 'text',
            'title'   => __( 'Hire Us form', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'join_form',
            'type'    => 'text',
            'title'   => __( 'Join our Team form', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'Client_Form_new',
            'type'    => 'text',
            'title'   => __( 'Client_Form_new', 'pnina' ),
            'default' => ''
        ),



        array(
            'id'      => 'hire_form_title',
            'type'    => 'editor',
            'title'   => __( 'Hire Us form title', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'join_form_title',
            'type'    => 'editor',
            'title'   => __( 'Join our Team form title', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'client_form_title',
            'type'    => 'editor',
            'title'   => __( 'client form title', 'pnina' ),
            'default' => ''
        ),

    )
) );


Redux::setSection( $opt_name, array(
	'title'   => __( 'Social Media', 'pnina' ),
	'desc'    => '',
	'icon'    => 'el el-website',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'of_facebook',
			'type'    => 'text',
			'title'   => __( 'facebook', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_twitter',
			'type'    => 'text',
			'title'   => __( 'twitter', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_gplus',
			'type'    => 'text',
			'title'   => __( 'Google plus', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_instagram',
			'type'    => 'text',
			'title'   => __( 'Instagram', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_linkedin',
			'type'    => 'text',
			'title'   => __( 'Linkedin', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_youtube',
			'type'    => 'text',
			'title'   => __( 'youtube', 'pnina' ),
			'default' => ''
		),
		array(
			'id'      => 'of_whatsapp',
			'type'    => 'text',
			'title'   => __( 'whatsapp', 'pnina' ),
			'default' => ''
		),
	)
));

Redux::setSection( $opt_name, array(
    'title'   => __( 'Arabic General', 'pnina' ),
    'desc'    => '',
    'submenu' => true,
    'fields'  => array(
        array(
            'id'      => 'overview_ar',
            'type'    => 'editor',
            'title'   => __( 'Overview Home page', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'about_us_ar',
            'type'    => 'editor',
            'title'   => __( 'About Us', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'earnings_desc_ar',
            'type'    => 'editor',
            'title'   => __( 'Focus on your earnings', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'coktailer_desc_ar',
            'type'    => 'editor',
            'title'   => __( 'Be Coktailer', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'contact_desc_ar',
            'type'    => 'editor',
            'title'   => __( 'Contact Desc', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'copyright_ar',
            'type'    => 'textarea',
            'title'   => __( 'Copyright', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'contact_form_ar',
            'type'    => 'text',
            'title'   => __( 'Contact form', 'pnina' ),
            'default' => ''
        ),
        array(
            'id'      => 'hire_form_ar',
            'type'    => 'text',
            'title'   => __( 'Hire Us form', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'join_form_ar',
            'type'    => 'text',
            'title'   => __( 'Join our Team form', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'client_form_ar',
            'type'    => 'text',
            'title'   => __( 'Client_Form_new', 'pnina' ),
            'default' => ''
        ),



        array(
            'id'      => 'hire_form_title',
            'type'    => 'editor',
            'title'   => __( 'Hire Us form title', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'join_form_title',
            'type'    => 'editor',
            'title'   => __( 'Join our Team form title', 'pnina' ),
            'default' => ''
        ),array(
            'id'      => 'client_form_title',
            'type'    => 'editor',
            'title'   => __( 'client form title', 'pnina' ),
            'default' => ''
        ),

    )
) );

if ( ! function_exists( 'ps_option' ) ) {
	function ps_option( $id, $fallback = false, $key = false ) {
		global $ps_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $ps_option[ $id ] ) && $ps_option[ $id ] !== '' ) ? $ps_option[ $id ] : $fallback;
		if ( ! empty( $ps_option[ $id ] ) && $key ) {
			$output = $ps_option[ $id ][ $key ];
		}
		return $output;
	}
}