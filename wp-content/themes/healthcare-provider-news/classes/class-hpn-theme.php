<?php

class HPN_Theme {


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function load_styles_and_scripts()
	{
		wp_enqueue_style( 'screen', get_template_directory_uri() . '/assets/dist/css/screen.min.css', array(), HPN_THEME_VERSION );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/js/main.min.js', array('jquery'), HPN_THEME_VERSION, true );
	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function add_login_styles()
	{
		wp_enqueue_style('login-styles', get_template_directory_uri() . '/assets/dist/css/login.min.css', array(), HPN_THEME_VERSION);
	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function add_login_body_classes($classes)
	{
		
		// we're checking for a valueless query string 'wle' that is (assumably) passed
		// by the Auth0 plugin to identify the standard wordpress login page (vs their own)
		$query_string = $_SERVER['QUERY_STRING'];

		// add the custom body class that we'll use for css customization
		if ( strpos($query_string, 'wle') !== false ) {
			$classes[] = 'pn-default-login';
		} else {
			$classes[] = 'pn-auth0-login';
		}
		
		return $classes;
	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_header_analytics_script()
	{
		$analytics_script = get_theme_mod('analytics_script','');

		if ( $analytics_script != '' ) {
			echo $analytics_script;
		}

	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_feedback_url()
	{
		$feedback_url = get_theme_mod('feedback_url','');

		if ( $feedback_url != '' ) {
			return $feedback_url;
		}

	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function initialize_widget_areas()
	{

		register_sidebar(array(
			'name'          => 'Footer Left',
			'id'            => 'widget_footer_left',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		));

		register_sidebar(array(
			'name'          => 'Footer Right',
			'id'            => 'widget_footer_right',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		));

	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function add_custom_image_sizes()
	{
		add_image_size('tiny-thumb', 100, 100, true);
	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function new_excerpt_length()
	{
		return 20;
	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function the_excerpt_more_link($excerpt)
	{
		$post = get_post();

		$moretxt = 'Continue';

		if ( has_excerpt() ) {

			$excerpt = strip_tags($excerpt);
			$excerpt = str_replace('[&hellip;]','',$excerpt);
			$moretxt = 'Continue';

		} else {

			$excerpt = strip_tags($excerpt);
			$excerpt = str_replace(' [&hellip;]','...',$excerpt);
			$excerpt = str_replace('....','...',$excerpt);

		}

		if ( is_singular('newsletter') ) {
			$excerpt .= ' <a href="'. get_permalink($post->ID) . '" style="text-decoration: none; color: #00825F; font-weight: bold;">Continue...</a>';
		} else {
			$excerpt .= ' <a href="'. get_permalink($post->ID) . '">'.$moretxt.'</a>';
			$excerpt = '<p>'.$excerpt.'</p>';
		}

		return $excerpt;
	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_archive_title()
	{
		$title = false;

		if ( is_search() ) {
			$title = 'Search';
		}

		if ( is_archive() ) {
			$title = single_cat_title();
		}

		if ( is_home() ) {
			$home = get_option('page_for_posts');
			$title = get_the_title($home);
		}

		if ( is_404() ) {
			$title = "Page Not Found (404 Error)";
		}

		if ($title) {
			return $title;
		}

	}




	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_archive_description()
	{
		$description = false;
		global $wp_query;

		if ( is_search() ) {
			$search_description = __('articles match your search for:',HPN_NAMESPACE);
			$description = $wp_query->found_posts . ' ' . $search_description . ' <strong>' . get_search_query() . '</strong>';
		}

		if ( is_archive() ) {
			$description = category_description();
		}

		if ($description) {
			return $description;
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_no_results_phrase()
	{
		$phrase = '';

		if ( is_search() ) {
			$phrase =	__('No articles match your search.', HPN_NAMESPACE);
		} else {
			$phrase =	__('No articles found in this category.', HPN_NAMESPACE);
		}

		return $phrase;
	}



	/**
	 *
	 *	
	 *	
	 *	@param 		...
	 *	@return 	string - symbol ID for SVG icon
	 **/
	public static function get_archive_icon($term_id=false)
	{
		global $post;
		
		if ( is_tax('location') ) {
			return '<svg class="icon"><use xlink:href="'.get_template_directory_uri().'/assets/dist/img/sprite.svg#icon-location-pin" /></svg>';
		}

		if ( is_search() ) {
			return '<svg class="icon"><use xlink:href="'.get_template_directory_uri().'/assets/dist/img/sprite.svg#icon-search" /></svg>';
		}

		if (!$term_id) {
			
			$queried_object = get_queried_object();
			
			if ( $queried_object ) {
				$term_id = get_queried_object()->term_id;
			}
			
		}

		if ( !$term_id ) {
			return;
		}

		$term_icon = get_term_meta($term_id,'term_icon');

		if ( $term_icon ) {
			$html = '<svg class="icon"><use xlink:href="'.get_template_directory_uri().'/assets/dist/img/sprite.svg#'.$term_icon[0].'" /></svg>';
			return $html;
		}

	}



	/**
	 *
	 *	
	 *	
	 *	@param 		...
	 *	@return 	...
	 *
	 *
	 **/
	public static function get_term_thumbnail($term_id)
	{

		if ( !$term_id ) {
			return;
		}

		$term_thumbnail = get_term_meta($term_id,'term_thumbnail');

		if ( $term_thumbnail ) {
			return $term_thumbnail;
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_back_link()
	{

		if ( is_category() ) {
			// return '<a href="#" class="">See The Latest</a>';
		} else if ( is_tax('location') ) {
			return '<a href="/locations/" class="inline-block pb-2">&#8592; Choose a Different Location</a>';
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_post_count()
	{

		// if this is the page with posts
		if ( is_home() ) {
			$count_posts = wp_count_posts();
			return $count_posts->publish;
		}

		// 
		if ( is_archive() || is_search() ) {
			global $wp_query;
			return $wp_query->found_posts;
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_archive_category_id()
	{
		global $wp_query;

		if ( is_archive() ) {
			return $wp_query->get_queried_object_id();
		}

		if ( is_home() ) {
			return 'all';
		}

		if ( is_search() ) {
			return 'search';
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_stickied_posts()
	{
		$sticky = get_option('sticky_posts');

		if ($sticky) {

			// make sure they are ordered chronologically (newest at top)
			rsort($sticky);

			// make sure we just have one sticky to work with (in case there are multiple)
			$sticky = array_slice( $sticky, 0, 2 );

			$args = array(
				'post__in' => $sticky
			);

			$posts = new WP_Query($args);

			return $posts;

		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_sidebar_menu($location)
	{

		if (!$location) {
			return;
		}

		$locations = get_nav_menu_locations();

		if ( !array_key_exists($location,$locations) ) {
			return;
		}

		$id = $locations[$location];

		$transient_name = 'ccpn_menu_'.$id;

		// delete_transient($transient_name);

		$transient = get_transient($transient_name);

		if(!empty( $transient)) {

			$return = $transient;

		} else {

			$wp_menu = wp_get_nav_menu_items($id);

			$return = array();

			foreach ($wp_menu as $item) {
				
				$pos = count($return);
				
				$return[$pos]['title'] = $item->title;
				$return[$pos]['url'] = $item->url;

				// if it's a category we'll attempt to get the icon from term meta
				if ( $item->object == 'category' ) {
					$term_icon = get_term_meta($item->object_id,'term_icon');
					
					if ( $term_icon ) {
						$return[$pos]['icon'] = $term_icon[0];
					} else {
						$return[$pos]['icon'] = '';
					}

				// else we'll check if there are any css classes set on the menu item
				} else if ( count($item->classes) ) {
					$return[$pos]['icon'] = $item->classes[0];
				
				// otherwise we'll set the icon to an empty string
				} else {
					$return[$pos]['icon'] = '';
				}

			};

			// set the transient
			set_transient($transient_name, $return, WEEK_IN_SECONDS);

		}

		return $return;
	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_sidebar_menu_title($location)
	{

		if (!$location) {
			return;
		}

		$locations = get_nav_menu_locations();
		$id = $locations[$location];

		if (!$id) {
			return;
		}

		$menu_object = wp_get_nav_menu_object($id);

		if ( $menu_object ) {
			return $menu_object->name;
		}
	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_all_categories()
	{

		$args = array(
			'meta_key' => 'term_order',
			'orderby'  => 'meta_value',
			'order'    => 'ASC',
		);

		$categories = get_categories($args);

		return $categories;

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_the_first_category($post_id=false)
	{

		if ($post_id) {
			$categories = get_the_category($post_id);
		} else {
			$categories = get_the_category();
		}

		if ( count($categories) ) {

			$category = $categories[0];

			return $category;
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_posts_in_category($term_id)
	{

		$sticky = get_option('sticky_posts');

		$args = array(
			'posts_per_page' => 2,
			'post_status' 	 => 'publish',
			'cat'						 => $term_id,
			'post__not_in' 	 => $sticky
		);

		$posts = new WP_Query($args);

		return $posts;

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_pagination_nav()
	{

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 ) {
			return;
		}
			
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $wp_query->max_num_pages );

		/**	Add current page to the array */
		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		/**	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<div class="page-nav"><ul>' . "\n";

		/**	Previous Post Link */
		if ( get_previous_posts_link() ) {
			printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		}

		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( ! in_array( 2, $links ) )
				echo '<li>&hellip;</li>';
		}

		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li>&hellip;</li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/**	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li>%s</li>' . "\n", get_next_posts_link() );

		echo '</ul></div>' . "\n";

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_also_see_articles()
	{
		$this_id = get_the_ID();
		
		/*
		$cats = get_the_category();
		$cats_array = array();

		foreach ($cats as $cat) {
			$cats_array[] = $cat->term_id;
		}
		*/

		$args = array(
			'post__not_in' => array($this_id),
			'posts_per_page' => 1,
		);
		
		$related = new WP_Query($args);

		if ($related) {
			return $related;
		}

	}



	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_gravity_form_meta($form_id,$meta)
	{

		if ( !$form_id || !$meta ) {
			return;
		}

		$forminfo = GFAPI::get_form($form_id);

		if ( !$forminfo ) {
			return;
		}

		if ( $meta == 'title' ) {
			return $forminfo['title'];
		} else if ( $meta == 'description' ) {
			return $forminfo['description'];
		}

	}




	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function delete_menu_transients()
	{
		delete_transient('ccpn_menu_17');
		delete_transient('ccpn_menu_18');
	}


	/**
	 *
	 *	Document this method
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function update_featured_image_on_save($post_id)
	{

		// if this post already has a thumbnail, then bail
		if ( has_post_thumbnail($post_id) ) {
			return;
		}

		$cat_obj = self::get_the_first_category($post_id);

		if ( $cat_obj ) {
		
			$term_id = $cat_obj->term_id;
			$thumbnail = self::get_term_thumbnail($term_id);
			$thumbnail_id = $thumbnail[0];

			if ( $thumbnail_id ) {
				set_post_thumbnail($post_id,$thumbnail_id);
			}
			
		}

	}



	/**
	 *
	 *	Get the logo specified in the customizer or return a placeholder
	 *	
	 *	@param 		...
	 *	@return 	...
	 **/
	public static function get_customizer_logo()
	{
		$logo = get_custom_logo();

		if ($logo) {
			echo $logo;
		} else {
			echo '<a href="'.site_url().'"><img src="'.get_template_directory_uri().'/assets/dist/img/logo-placeholder.png" alt="Placeholder Logo" /></a>';
		}

	}



}