<?php

show_admin_bar( false );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'excerpt_more', function( $more ) {
  return '...';
});

if ( ! function_exists( 'questsight_setup' ) ) :
	function questsight_setup() {
		load_theme_textdomain( 'questsight', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'header' => esc_html__( 'Header Menu', 'questsight' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'questsight_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'questsight_setup' );

function questsight_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'questsight_content_width', 640 );
}
add_action( 'after_setup_theme', 'questsight_content_width', 0 );


function questsight_scripts() {
	wp_enqueue_style( 'questsight-style', get_stylesheet_uri() );
  wp_enqueue_style('questsight-common-css', get_template_directory_uri() . '/assets/css/common.min.css', array(), null, false);
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script('questsight-common-js', get_template_directory_uri() . '/assets/js/common.min.js', array( 'jquery' ), null, true);
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'questsight_scripts' );

//Изображения в формате webp
function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );