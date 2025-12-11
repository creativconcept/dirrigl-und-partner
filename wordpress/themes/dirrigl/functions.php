<?php




/************************************************************ */
/* Add stylesheets and scripts */

function dirrigl_scripts() {

    wp_enqueue_style( 'tailwindcss', get_stylesheet_uri() );
    wp_enqueue_style( 'slickstyle', get_template_directory_uri().'/libs/slick.css', array(), null, false );
    wp_enqueue_script( 'slickscript', get_template_directory_uri().'/libs/slick.min.js', array('jquery'), null, false );
    wp_enqueue_script( 'gsap', get_template_directory_uri().'/libs/gsap.min.js', array('jquery'), null, false );
    wp_enqueue_script( 'scrolltrigger', get_template_directory_uri().'/libs/ScrollTrigger.min.js', array('jquery'), null, false );
    wp_enqueue_script( 'customscript', get_template_directory_uri() . '/dirrigl.js', array('jquery'), null, true );

}    
add_action( 'wp_enqueue_scripts', 'dirrigl_scripts' );

function dirrigl_admin_scripts() {
    wp_enqueue_style( 'slickstyle', get_template_directory_uri().'/libs/slick.css', array(), null, false );
    wp_enqueue_script( 'slickscript', get_template_directory_uri().'/libs/slick.min.js', array('jquery'), null, false );
}
add_action( 'admin_enqueue_scripts', 'dirrigl_admin_scripts' );


/************************************************************ */
/* Disable admin bar in frontend */

add_filter('show_admin_bar', '__return_false');



/************************************************************ */
/* Add title tag to wordpress head to show in browser tab */

add_theme_support( 'title-tag' );



/************************************************************ */
/* Add excerpt/featured image to pages */

add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'post-thumbnails' );



/************************************************************ */
/* Add featured images og:image for social media */

add_action('wp_head', 'add_featured_socialmedia');
function add_featured_socialmedia(){
    if( is_single() || is_page() ) {
		echo '<meta property="og:image" content="'. get_the_post_thumbnail_url(get_the_ID(),'full')   .'" />';
    }
}



/************************************************************
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

/* Remove DNS-fetch "//s.w.org" in head */
add_filter( 'emoji_svg_url', '__return_false' );



/************************************************************ */
/* Enable "Show in REST option" in ACF editor */

// Enable the option show in rest
add_filter( 'acf/rest_api/field_settings/show_in_rest', '__return_true' );



/************************************************************ */
/** TRANSLATIONS  **/

add_action('init', function() {
    pll_register_string('dirrigl', 'Suchen');
    pll_register_string('dirrigl', 'Suchergebnisse');
    pll_register_string('dirrigl', 'Leider wurde nichts gefunden');
    pll_register_string('dirrigl', 'Bitte versuchen Sie es mit einem anderen Suchbegriff oder nehmen Sie Kontakt auf.');
    pll_register_string('dirrigl', 'Hier klicken um mehr zu erfahren.');
});

// Redirect 404 to homepage

if( !function_exists('redirect_404_to_homepage') ){

    add_action( 'template_redirect', 'redirect_404_to_homepage' );

    function redirect_404_to_homepage(){
       if(is_404()):
            wp_safe_redirect( home_url('/') );
            exit;
        endif;
    }
}

/***************************************************************** */
/** Disable default Rest-API endpoints **/

add_filter( 'rest_endpoints', 'disable_default_endpoints' );

function disable_default_endpoints( $endpoints ) {

	$routes = array( '/wp/v2/users', '/wp/v2/users/(?P<id>[\d]+)' );

	foreach( $routes as $route ):
		if( empty( $endpoints[ $route ] ) ):
			continue;
		endif;

		foreach( $endpoints[ $route ] as $i => $handlers ):
			if ( is_array( $handlers ) && isset( $handlers['methods'] ) && 'GET' === $handlers['methods'] ):
				unset( $endpoints[ $route ][ $i ] );
			endif;
		endforeach;
	endforeach;

	return $endpoints;

}
