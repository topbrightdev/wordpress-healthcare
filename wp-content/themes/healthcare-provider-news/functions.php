<?php

/**
 *	
 *	
 *	
 *	
 *	
 **/

$ccnp_theme = wp_get_theme();
define("HPN_THEME_VERSION", $ccnp_theme->get('Version'));
define("HPN_NAMESPACE", 'hpn-theme');

// include classes
include( TEMPLATEPATH . '/classes/class-hpn-admin.php' );
include( TEMPLATEPATH . '/classes/class-hpn-taxonomies.php' );
include( TEMPLATEPATH . '/classes/class-hpn-feed-item.php' );
include( TEMPLATEPATH . '/classes/class-hpn-theme.php' );
include( TEMPLATEPATH . '/classes/class-hpn-customizer.php' );

// add styles and scripts
add_action('wp_enqueue_scripts', array('HPN_Theme','load_styles_and_scripts'));
add_action('login_enqueue_scripts', array('HPN_Theme','add_login_styles'));

// setup custom taxonomies
add_action('init', array('HPN_Taxonomies','create_locations_tax'), 0);

// add theme support
add_theme_support('menus');
register_nav_menus(array(
	'filter_menu' => 'Filters',
	'category_menu' => 'Categories',
));

// ouput customizations
add_filter('login_body_class', array('HPN_Theme','add_login_body_classes'));
add_filter('excerpt_length', array('HPN_Theme','new_excerpt_length'));
add_filter('the_excerpt', array('HPN_Theme','the_excerpt_more_link'), 21);
add_filter('wp_calculate_image_srcset', '__return_false'); // disable srcset attribute on images
add_filter('embed_oembed_html', array('HPN_Admin','add_video_wraper'), 10, 3); //  wrap video embeds for responsive styling
remove_filter('term_description','wpautop');	// remove HTML formatting from category descriptions

// custom action hooks
add_action('save_post', array('HPN_Theme','delete_menu_transients'));
add_action('save_post', array('HPN_Theme','update_featured_image_on_save'));
add_action('edited_category', array('HPN_Theme','delete_menu_transients'), 10, 2 );
add_action('after_setup_theme', array('HPN_Theme','add_custom_image_sizes'));
add_action('init', array('HPN_Admin','restrict_admin_access'));
add_action('after_setup_theme', array('HPN_Admin','disable_admin_bar'));

// widgets
add_action('widgets_init', array('HPN_Theme','initialize_widget_areas'));

// theme customizer
add_action('after_setup_theme', array('HPN_Customizer','add_custom_logo_support'));
add_action('customize_register', array('HPN_Customizer','register_theme_customizer'));
add_action('wp_head', array('HPN_Customizer','theme_customizer_header_css'));

// disable RSS feeds
add_action('do_feed', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_rdf', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_rss', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_rss2', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_atom', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_rss2_comments', array('HPN_Admin','disable_rss_feed'), 1);
add_action('do_feed_atom_comments', array('HPN_Admin','disable_rss_feed'), 1);

// remove Actions 
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// if ACF is enabled we'll get child theme field groups
if( class_exists('acf') ) {
	add_filter('acf/settings/load_json', array('HPN_Admin','get_acf_field_groups'));
}

// admin-only stuff
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if ( is_admin() ){

	// add admin option page
	add_action('admin_menu', array('HPN_Admin','add_contact_options_page'));
  add_action('admin_init', array('HPN_Admin','add_contact_options_page_settings'));
	
	// setup taxonomy columns
	add_filter('manage_edit-category_columns', array('HPN_Taxonomies','add_category_term_order_column') );
	add_filter('manage_category_custom_column', array('HPN_Taxonomies','add_category_term_order_column_content'), 10, 3 );
	add_filter('manage_edit-category_sortable_columns', array('HPN_Taxonomies','make_category_term_order_column_sortable'));
	add_filter('terms_clauses', array('HPN_Taxonomies','sort_by_term_order'), 10, 3);

	// if using Download Monitor plugin, we'll hide downloads from the media library
	if ( class_exists('WP_DLM') ) {
		add_filter('ajax_query_attachments_args', array('HPN_Admin','remove_downloads_from_media_library_modal'));
		add_action('pre_get_posts', array('HPN_Admin','remove_downloads_from_media_library_page'));

		// disable pdf previews
		// add_filter('fallback_intermediate_image_sizes', array('HPN_Admin','disable_pdf_previews'));
	}
	
}