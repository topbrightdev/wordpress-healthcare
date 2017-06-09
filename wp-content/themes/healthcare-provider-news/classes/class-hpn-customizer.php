<?php

class HPN_Customizer {

	/**
	 *
	 *	This adds custom logo support to the theme customizer
	 *	
	 *	@param 		none
	 *	@return 	none
	 **/
	public static function add_custom_logo_support()
	{
		add_theme_support('custom-logo');
	}


	/**
	 *
	 *	...
	 *	
	 *	@param 		none
	 *	@return 	none
	 **/
	public static function register_theme_customizer( $wp_customize )
	{

		// Footer...

		$wp_customize->add_section(
			'header_settings',
			array(
				'title'     => 'Header',
				'priority'  => 001
			)
		);

		$wp_customize->add_setting(
			'feedback_url',
			array( 'default' => '' )
		);

		$wp_customize->add_setting(
			'analytics_script',
			array( 'default' => '' )
		);

		// Colors...

		$wp_customize->add_setting(
			'link_color',
			array( 'default' => '#00825f')
		);

		$wp_customize->add_setting(
			'link_hover_color',
			array( 'default' => '#e2f1ed')
		);

		$wp_customize->add_setting(
			'primary_button_background_color',
			array( 'default' => '#00825f')
		);

		$wp_customize->add_setting(
			'primary_button_background_hover_color',
			array( 'default' => '#e2f1ed')
		);

		$wp_customize->add_setting(
			'secondary_button_background_color',
			array( 'default' => '#e2f1ed')
		);

		$wp_customize->add_setting(
			'secondary_button_background_hover_color',
			array( 'default' => '#7cc1af')
		);

		// Footer...

		$wp_customize->add_section(
			'footer_settings',
			array(
				'title'     => 'Footer',
				'priority'  => 101
			)
		);

		$wp_customize->add_setting(
			'footer_background_image',
			array( 'default' => '' )
		);

		// - - - - - - - - - - - - - - - - - - - - - -
		// Controls
		// - - - - - - - - - - - - - - - - - - - - - -


		// header controls

		$wp_customize->add_control(
			'feedback_url', array(
				'type' 				=> 'text',
				'section' 		=> 'header_settings', // Add a default or your own section
				'label' 			=> __('Feedback Button URL'),
				'description' => __('Button will not display if the field is empty. To link to the footer simply use #footer as the URL. If using an email address this should be formatted like: mailto:name@organization.com'),
			)
		);

		$wp_customize->add_control(
			'analytics_script', array(
				'type' 				=> 'textarea',
				'section' 		=> 'header_settings', // Add a default or your own section
				'label' 			=> __('Analytics Script'),
				'description' => __('This will be placed after the opening body tag. Please edit child theme files for alternative placement.'),
			)
		);

		// color controls

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'link_color',
				array(
					'label'      => __('Links', 'hpn-theme'),
					'section'    => 'colors',
					'settings'   => 'link_color'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'link_hover_color',
				array(
					'label'      => __('Link Hover', 'hpn-theme'),
					'section'    => 'colors',
					'settings'   => 'link_hover_color'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_background_color',
				array(
					'label'       => __('Primary Button Background', 'hpn-theme'),
					'section'     => 'colors',
					'settings'    => 'primary_button_background_color',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_background_hover_color',
				array(
					'label'       => __('Primary Button Background Hover', 'hpn-theme'),
					'section'     => 'colors',
					'settings'    => 'primary_button_background_hover_color',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'secondary_button_background_color',
				array(
					'label'       => __('Secondary Button Background', 'hpn-theme'),
					'section'     => 'colors',
					'settings'    => 'secondary_button_background_color',
					'description' => 'Should be a lighter color to contrast with the link color text'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'secondary_button_background_hover_color',
				array(
					'label'       => __('Secondary Button Background Hover', 'hpn-theme'),
					'section'     => 'colors',
					'settings'    => 'secondary_button_background_hover_color',
					'description' => 'Should be a slightly darker variation of the background color to contrast with button text and icon'
				)
			)
		);

		// footer controls

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_background_image',
				array(
					'label'       => __( 'Upload an image', 'theme_name' ),
					'section'     => 'footer_settings',
					'settings'    => 'footer_background_image',
					'description' => 'This image will scale to fit the footer. Use something fairly large – around 1000px wide x 600 high' 
				)
			)
		);

		return $wp_customize;

	}


	/**
	 *
	 *	...
	 *	
	 *	@param 		none
	 *	@return 	none
	 **/
	public static function theme_customizer_header_css() { ?>
		<style type="text/css">
			
			/* Customizer Styles  */

			a, .feed-item__title-link:hover, .btn--lt {
				color: <?php echo get_theme_mod( 'link_color' ); ?>;
			}

			.catmenu__icon { fill: <?php echo get_theme_mod( 'link_color' ); ?>; }
			.catmenu__link:hover { background-color: <?php echo get_theme_mod( 'link_hover_color' ); ?>; }
			.catmenu__link:hover .catmenu__icon { fill: <?php echo get_theme_mod( 'link_color' ); ?>; }

			.catmenu-base a, .catbar__more, .btn, .gform_wrapper button, .gform_wrapper input[type=submit] {
				background-color: <?php echo get_theme_mod( 'primary_button_background_color' ); ?>;
			}
			.catbar__more:hover, .btn:hover, .gform_wrapper button:hover, .gform_wrapper input[type=submit]:hover  {
				background-color: <?php echo get_theme_mod( 'primary_button_background_hover_color' ); ?>;
			}

			.pill, .btn--lt { background-color: <?php echo get_theme_mod( 'secondary_button_background_color' ); ?>; }
			.pill:hover, .btn--lt:hover { background-color: <?php echo get_theme_mod( 'secondary_button_background_hover_color' ); ?>; }
			
			.wysiwyg p a { border-color: <?php echo get_theme_mod( 'link_color' ); ?>; }

			.wysiwyg p a:hover {
				background-color: <?php echo get_theme_mod( 'link_hover_color' ); ?>;
				border-color: <?php echo get_theme_mod( 'link_color' ); ?>;
			}

		</style><?php
	}

}