<?php

class HPN_Admin {

  public $remove_dlm_from_media_library = true;


  /**
   *
   * Used to require login across the entire site
   *
   */
  public static function require_login()
  {
    global $post;

    // pages that do not require authentication
    $allowed = array('/wp-login.php', '/wp-register.php') ;

    if (!in_array($_SERVER['PHP_SELF'], $allowed) && !is_user_logged_in()){

      auth_redirect();
      exit;

    }

  }


  /**
   *
   * Keep non admins out of the admin area.
   * Users will not manage their credentials here.
   *
   */
  public static function restrict_admin_access()
  {
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
      wp_redirect(home_url());
      exit;
    }
  }


  /**
   *
   * Hide admin bar on front end from subsribers
   *
   */
  public static function disable_admin_bar()
  {

    if ( current_user_can('subscriber') && !is_admin() ) {
      show_admin_bar(false);
    }
    
  }


  /**
   *
   * Get child theme ACF field groups
   *
   */
	public static function get_acf_field_groups($paths)
	{
		
    $paths = array(get_template_directory() . '/acf-json');

      if( is_child_theme() ){
        $paths = array(
          get_stylesheet_directory() . '/acf-json',
          get_template_directory() . '/acf-json'
      );

    }

    return $paths;
  
	}


  /**
   *
   * Wrap embedded videos with a div we can style
   *
   */
  public static function add_video_wraper($html)
  {
    return '<div class="video-container">' . $html . '</div>';
  }


  /**
   *
   * Disable PDF thumbnail preview images
   *
   */
  public static function disable_pdf_previews()
  { 
    $fallbacksizes = array(); 
    return $fallbacksizes; 
  }


	/**
	 *
	 *	Disable all RSS feeds
   *
	 **/
	public static function disable_rss_feed()
	{
		wp_die( __('No feed available') );
	}


  /**
   *
   * Get Download Manager (plugin) post IDs
   *
   */
  public static function get_download_manager_post_ids()
  {
    $args = array(
      'post_type'       => array('dlm_download','dlm_download_version'),
      'posts_per_page'  => 1999,
      'post_status'     => 'any'
    );
  
    $query = new WP_Query($args);
    $posts = $query->posts;
    
    if ( !$posts ) {
      return;
    }

    $ids = wp_list_pluck($posts, 'ID');

    if ( count($ids) < 1 ) {
      return;
    }

    return $ids;
  }


  /**
   *
   * Get children of Download Manager (plugin) post IDs
   *
   */
  public static function get_download_manager_children()
  {
    $parents = self::get_download_manager_post_ids();

    if ( !$parents ) {
      return;
    }

    $args = array(
      'post_type'       => 'attachment',
      'posts_per_page'  => 1999,
      'post_status'     => 'any',
      'post_parent__in' => $parents
    );

    $query = new WP_Query($args);
    $posts = $query->posts;

    if ( !$posts ) {
      return;
    }

    $ids = wp_list_pluck($posts, 'ID');

    if ( count($ids) < 1 ) {
      return;
    } 
    
    return $ids;
  }


  /**
   *
   * Exclude downloads from the media library modal
   *
   */
  public static function remove_downloads_from_media_library_modal($query)
  {
    if ( !is_admin() ) {
      return;
    }

    $exclude = self::get_download_manager_children();

    if ( is_array($exclude) ) {
      $query['post__not_in'] = $exclude;
    }
    
    return $query;
  }


  /**
   *
   * Exclude downloads from the media library page
   *
   */
  public static function remove_downloads_from_media_library_page($query)
  {

    global $pagenow;

    if ( !is_admin() || $pagenow != 'upload.php' ) {
      return $query;
    }

    if ( $query->is_main_query() ) {

      $exclude = self::get_download_manager_children();

      if ( is_array($exclude) ) {
        $query->set('post__not_in', $exclude);
      }

    }

    return $query;
  }


	/**
	 *
	 *	Add admin option pages
	 *	
	 **/
  public static function add_contact_options_page()
  {
    add_options_page( 
      'Contact Information',
      'Contact Info',
      'manage_options',
      'contact-info.php',
      array('HPN_Admin','layout_contact_options_page')
    );
  }


	/**
	 *
	 *	Add settings for admin contacts page
	 *	
	 **/
  public static function add_contact_options_page_settings()
  {
    register_setting( 'hpn-article-contact', 'default_article_contact' );
    register_setting( 'hpn-article-contact', 'default_article_contact_cc' );
  }


	/**
	 *
	 *	Setup content for contact options page
	 *	
	 **/
  public static function layout_contact_options_page()
  { ?>
    <div class="wrap">
      <h1>Contact Information</h1>
      <form method="post" action="options.php">
        <?php settings_fields('hpn-article-contact'); ?>
        <table class="form-table">
          <tr>
            <th scope="row"><label for="default_article_contact">Default Article Contact</label></th>
            <td><input name="default_article_contact" type="text" id="default_article_contact" value="<?php esc_attr_e( get_option('default_article_contact') ); ?>" class="regular-text"></td>
          </tr>
          <tr>
            <th scope="row"><label for="default_article_contact_cc">Optional Article Contact CC</label></th>
            <td><input name="default_article_contact_cc" type="text" id="default_article_contact_cc" value="<?php esc_attr_e( get_option('default_article_contact_cc') ); ?>" class="regular-text"></td>
          </tr>
        </table>
        <?php submit_button(); ?>
      </form>
    </div><?php
  }



}