<?php

function create_post_type_feature() {
    register_post_type( 'slider',
        array(
            'label' => __('slider', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );
    register_post_type( 'step',
        array(
            'label' => __('step', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );
    register_post_type( 'field',
        array(
            'label' => __('field', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );
    register_post_type( 'service',
        array(
            'label' => __('service', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );
    register_post_type( 'portfolio',
        array(
            'label' => __('portfolio', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );
    register_post_type( 'testimonial',
        array(
            'label' => __('testimonial', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            )
        )
    );

    register_post_type( 'team',
        array(
            'label' => __('Team', 'pnina'),
            'public' => true,
            'show_ui' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'thumbnail',
            )
        )
    );

}
add_action('init','create_post_type_feature');
?>