<?php

class HPN_Taxonomies {

	// Register Custom Taxonomy
	public static function create_locations_tax() {

		$labels = array(
			'name'                       => _x( 'Locations', 'Taxonomy General Name', 'ccpn-config' ),
			'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'ccpn-config' ),
			'menu_name'                  => __( 'Locations', 'ccpn-config' ),
			'all_items'                  => __( 'All Locations', 'ccpn-config' ),
			'parent_item'                => __( 'Parent Location', 'ccpn-config' ),
			'parent_item_colon'          => __( 'Parent Location:', 'ccpn-config' ),
			'new_item_name'              => __( 'New Location Name', 'ccpn-config' ),
			'add_new_item'               => __( 'Add New Location', 'ccpn-config' ),
			'edit_item'                  => __( 'Edit Location', 'ccpn-config' ),
			'update_item'                => __( 'Update Location', 'ccpn-config' ),
			'view_item'                  => __( 'View Location', 'ccpn-config' ),
			'separate_items_with_commas' => __( 'Separate locations with commas', 'ccpn-config' ),
			'add_or_remove_items'        => __( 'Add or remove locations', 'ccpn-config' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'ccpn-config' ),
			'popular_items'              => __( 'Popular Locations', 'ccpn-config' ),
			'search_items'               => __( 'Search Locations', 'ccpn-config' ),
			'not_found'                  => __( 'Not Found', 'ccpn-config' ),
			'no_terms'                   => __( 'No Locations', 'ccpn-config' ),
			'items_list'                 => __( 'Locations list', 'ccpn-config' ),
			'items_list_navigation'      => __( 'Locations list navigation', 'ccpn-config' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'location', array( 'post' ), $args );

	}


	public static function add_category_term_order_column($columns)
	{
		$columns['term_order'] = __('Order', HPN_NAMESPACE);
		return $columns;
	}


	public static function add_category_term_order_column_content($content, $column_name, $term_id)
	{

		if( $column_name !== 'term_order' ) {
			return $content;
		}

		$term_id = absint($term_id);
		$term_order = get_term_meta($term_id, 'term_order', true);

		if( !empty($term_order) ) {
			$content .= esc_attr($term_order);
		}

		return $content;
	}


	public static function make_category_term_order_column_sortable($sortable)
	{
		$sortable['term_order'] = 'term_order';
		return $sortable;
	}


	public static function sort_by_term_order($pieces, $taxonomies, $args)
	{
		
		global $pagenow, $wpdb;

    // Require ordering
    $orderby = ( isset( $_GET['orderby'] ) ) ? trim( sanitize_text_field( $_GET['orderby'] ) ) : ''; 

    if (empty($orderby)) {
			return $pieces;
		}

    // set taxonomy
    $taxonomy = $taxonomies[0];
		
    // only if current taxonomy or edit page in admin           
    if ( !is_admin() || $pagenow !== 'edit-tags.php' || !in_array( $taxonomy, [ 'category' ] ) ) { return $pieces; }
	
		if ( $orderby == 'term_order' ) {
			$pieces['join']  .= ' INNER JOIN ' . $wpdb->termmeta . ' AS tm ON t.term_id = tm.term_id ';
			$pieces['where'] .= ' AND tm.meta_key = "term_order"'; 
			$pieces['orderby']  = ' ORDER BY tm.meta_value '; 
		}
	
		return $pieces;
	}

}

