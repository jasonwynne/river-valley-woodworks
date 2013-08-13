<?php
if ( function_exists( 'add_theme_support' ) ):
  add_theme_support( 'menus' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
endif;

if ( function_exists('register_sidebars') ):
  register_sidebar(array(
    'name'=>'Sidebar',
    'before_title'=>'<h4>',
    'after_title'=>'</h4>'
  ));
endif;

add_editor_style( 'editor-style.css' );
add_editor_style( 'css/fonts/fonts-rvw.css' );

// Get the id of a page by its slug
function get_page_id($page_name){
  global $wpdb;
  $page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
  return $page_name;
}

// register external jquery library with wordpress & exclude from admin panel
function my_init_method() {
  if (is_admin() == false ):
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js');
    wp_enqueue_script( 'jquery' );
  endif;
}    
add_action('init', 'my_init_method');


/*************************************************
 * adds read more to the excerpt when getting the excerpt from the content
 ************************************************/
function new_excerpt_more($more) { 
		return '&hellip; <a class="read-more-link" href="'. get_permalink($post->ID) . '">Learn More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*************************************************
 * the return of the excerpt length
 ************************************************/
function custom_excerpt_length( $length ) {
		return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*************************************************
 * custom admin login logo
 ************************************************/
function custom_login_logo() {
	echo '<style type="text/css">.login h1 a { background-image: url('.get_bloginfo('template_directory').'/images/rvw-logo-overlay.png) !important; height: 100px;  background-size: 274px 100px;}</style>';
}
add_action('login_head', 'custom_login_logo');
?>