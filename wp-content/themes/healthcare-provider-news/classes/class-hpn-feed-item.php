<?php

class HPN_Feed_Item {


	public static function get_item_title_class()
	{
		
		if ( is_sticky() && is_front_page() ) {
			return 'h1';
		} else {
			return 'h3';
		}

	}


	public static function get_item_class()
	{

		if ( is_sticky() && is_front_page() ) {
			return 'feed-item--featured';
		} else {
			return '';
		}

	}


	public static function get_feed_item_thumbnail()
	{
		global $post;

		// if a featured image is set, return it
		if ( has_post_thumbnail() ) {
			
			if ( is_sticky() ) {
				the_post_thumbnail('medium');
			} else {
				the_post_thumbnail('thumbnail');
			}
			

		// otherwise we'll return a square with category icon
		} else { ?>
		
			<?php // $category = HPN_Theme::get_the_first_category(); ?>
			<?php // echo HPN_Theme::get_archive_icon($category->term_id); ?>
			<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/dist/img/transparent-square.png" height="50" width="50" alt="Transparent placeholder image" /><?php 

		}
		
	}

}