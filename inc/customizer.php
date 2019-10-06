<?php

if ( ! function_exists('modul_r_customizer_opt') ) :
	function modul_r_customizer_opt( $wp_customize ) {

		// Template custom colors

		// Header color
		$wp_customize->add_setting( 'header-color', array(
			'default'   => esc_attr($GLOBALS['modul_r_defaults']['colors']['header']),
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header-color', array(
			'section' => 'colors',
			'label'   => esc_html__( 'Header Color', 'modul-r' ),
			'priority' => 0,
		) ) );

		// Primary color
		$wp_customize->add_setting( 'primary-color', array(
			'default'   => esc_attr($GLOBALS['modul_r_defaults']['colors']['primary']),
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary-color', array(
			'section' => 'colors',
			'label'   => esc_html__( 'Primary Color', 'modul-r' ),
		) ) );

		// Secondary color
		$wp_customize->add_setting( 'secondary-color', array(
			'default'   => esc_attr($GLOBALS['modul_r_defaults']['colors']['secondary']),
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary-color', array(
			'section' => 'colors',
			'label'   => esc_html__( 'Secondary Color', 'modul-r' ),
		) ) );


		// Modul-R custom options
		$wp_customize->add_panel( 'modul_r_theme_options' , array(
			'title'      => esc_html__('Modul-R Options','modul-r'),
			'priority'   => 40,
		) );



		// Header Panel
		// Add the custom panel
		$wp_customize->add_section( 'modul_r_settings_header' , array(
			'title'      => esc_html__('Header','modul-r'),
			'priority'   => 10,
			'panel'      => 'modul_r_theme_options'
		) );

		// select dropdown for portrait or landscape header layout
		$wp_customize->add_setting( 'modul_r_header_direction', array(
			'capability' => 'edit_theme_options',
			'default'   => 'portrait',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'modul_r_header_direction',
			array(
				'label'    => esc_html__( 'Header layout', 'modul-r' ),
				'description' => esc_html__( 'The header layout can be landscape (logo and menu on the same line) or portrait (centered layout with the menu under the logo)', 'modul-r' ),
				'section'  => 'modul_r_settings_header',
				'type'     => 'radio',
				'choices'  => array(
					'portrait'  => esc_html__( 'Portrait', 'modul-r' ),
					'landscape' => esc_html__( 'Landscape', 'modul-r' ),
				),
			)
		);



		// Footer Section
		$wp_customize->add_section( 'modul_r_settings_footer' , array(
			'title'      => esc_html__('Footer','modul-r'),
			'priority'   => 20,
			'panel'      => 'modul_r_theme_options'
		) );

		// the "Show website credits" checkbox
		$wp_customize->add_setting( 'modul_r_footer_show_credits', array(
			'capability' => 'edit_theme_options',
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'modul_r_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'modul_r_footer_show_credits', array(
			'type' => 'checkbox',
			'section' => 'modul_r_settings_footer',
			'label' => esc_html__( 'Enable footer credits section', 'modul-r' ),
			'description' => esc_html__( 'Shows website logo and the text you insert in the textarea below', 'modul-r' ),
		) );

		// show logo checkbox in credits section
		$wp_customize->add_setting( 'modul_r_footer_credits_show_logo', array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'modul_r_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'modul_r_footer_credits_show_logo', array(
			'type' => 'checkbox',
			'section' => 'modul_r_settings_footer',
			'label' => esc_html__( 'Show logo', 'modul-r' ),
		) );

		// the credits title
		$wp_customize->add_setting( 'modul_r_footer_credits_title', array(
			'capability' => 'edit_theme_options',
			'default' => esc_html(get_bloginfo('name')),
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'modul_r_footer_credits_title', array(
			'type' => 'text',
			'section' => 'modul_r_settings_footer',
			'label' => esc_html__( 'Credits', 'modul-r' ),
		) );

		// the credits textarea
		$wp_customize->add_setting( 'modul_r_footer_credits_content', array(
			'capability' => 'edit_theme_options',
			'default' => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( 'modul_r_footer_credits_content', array(
			'type' => 'textarea',
			'section' => 'modul_r_settings_footer',
		) );



		// Sidebar Section
		$wp_customize->add_section( 'modul_r_settings_sidebar' , array(
			'title'      => esc_html__('Sidebar','modul-r'),
			'priority'   => 30,
			'panel'      => 'modul_r_theme_options'
		) );

		// the "Show Sidebar" checkbox
		$wp_customize->add_setting( 'modul_r_sidebar_enabled', array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'modul_r_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'modul_r_sidebar_enabled', array(
			'type' => 'checkbox',
			'section' => 'modul_r_settings_sidebar',
			'label' => esc_html__( 'Show Sidebar', 'modul-r' ),
			'description' => esc_html__( 'Show the sidebar into single articles and pages', 'modul-r' ),
		) );

		// select left or right sidebar
		$wp_customize->add_setting( 'modul_r_sidebar_position', array(
			'capability' => 'edit_theme_options',
			'default'   => 'left',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'modul_r_sidebar_position',
			array(
				'label'    => esc_html__( 'Sidebar position', 'modul-r' ),
				'description' => esc_html__( 'The sidebar can be showed at the left or at the right of the content. This customization also affect the WooCommerce sidebar.', 'modul-r' ),
				'section'  => 'modul_r_settings_sidebar',
				'type'     => 'radio',
				'choices'  => array(
					'left'  => esc_html__( 'Left', 'modul-r' ),
					'right' => esc_html__( 'Right', 'modul-r' ),
				),
			)
		);



		// Homepage Section
		$wp_customize->add_section( 'modul_r_home_options' , array(
			'title'      => esc_html__('Homepage','modul-r'),
			'priority'   => 50,
			'panel'      => 'modul_r_theme_options'
		) );

		// the "Fullpage Hero" checkbox
		$wp_customize->add_setting( 'modul_r_hero_fullpage', array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'modul_r_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'modul_r_hero_fullpage', array(
			'type' => 'checkbox',
			'section' => 'modul_r_home_options',
			'label' => esc_html__( 'Fullpage Hero', 'modul-r' ),
			'description' => esc_html__( 'The main image of the homepage will be 100% of the height of the page', 'modul-r' ),
		) );

		// Hero headline
		$wp_customize->add_setting( 'modul_r_hero_title', array(
			'capability' => 'edit_theme_options',
			'default' => esc_html(get_bloginfo('name')),
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'modul_r_hero_title', array(
			'type' => 'text',
			'section' => 'modul_r_home_options',
			'label' => esc_html__( 'Hero headline', 'modul-r' ),
			'description' => esc_html__( 'Write a catchy phrase as homepage headline', 'modul-r' ),
		) );

		// Hero subtitle
		$wp_customize->add_setting( 'modul_r_hero_subtitle', array(
			'capability' => 'edit_theme_options',
			'default' => esc_html(get_bloginfo('description')),
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'modul_r_hero_subtitle', array(
			'type' => 'text',
			'section' => 'modul_r_home_options',
			'description' => esc_html__( 'Subtitle', 'modul-r' ),
		) );

		// Call to action - pages
		$wp_customize->add_setting( 'modul_r_hero_call_to_action', array(
			'capability' => 'edit_theme_options',
			'default' => '0',
			'sanitize_callback' => 'modul_r_sanitize_pages_dropdown',
		) );

		$wp_customize->add_control( 'modul_r_hero_call_to_action', array(
			'type' => 'dropdown-pages',
			'section' => 'modul_r_home_options',
			'label' => esc_html__( 'Call to action', 'modul-r' ),
			'description' => esc_html__( 'Choose an important page', 'modul-r' ),
		) );

		$categories = get_categories();
		$cats = array();
		$cats[0] = '&#8212; Select &#8212;';
		$i = 0;
		foreach( $categories as $category ) {
			if( $i == 0 ){
				$default = $category->term_id;
				$i++;
			}
			$cats[$category->term_id] = $category->name;
		}

		// Call to action 2 - categories
		$wp_customize->add_setting( 'modul_r_hero_call_to_action_2', array(
			'capability' => 'edit_theme_options',
			'default' => '0',
			'sanitize_callback' => 'modul_r_sanitize_category_dropdown',
		) );

		$wp_customize->add_control( 'modul_r_hero_call_to_action_2', array(
			'type'    => 'select',
			'choices' => $cats,
			'section' => 'modul_r_home_options',
			'description' => esc_html__( 'Select an important category', 'modul-r' ),
		) );

		// Sanitize function for checkbox value
		function modul_r_sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		// Sanitize function for pages
		function modul_r_sanitize_pages_dropdown( $page_id, $setting ) {
			// Ensure $page_id is an absolute integer.
			$page_id = absint( $page_id );

			// If $page_id is an ID of a published page, return it; otherwise, return the default.
			return ( get_post_status( $page_id ) == 'publish'? $page_id : $setting->default );
		}

		// Sanitize function for categories
		function modul_r_sanitize_category_dropdown( $cat_id, $setting ) {
			// Ensure $cat_id is an absolute integer.
			$cat_id = absint( $cat_id );

			// If $cat_id term exist, return it; otherwise, return the default.
			return ( term_exists( $cat_id ) != 0 ? $cat_id : $setting->default );
		}

	}
endif;
add_action( 'customize_register', 'modul_r_customizer_opt' );

if ( ! function_exists('modul_r_theme_colors_setup') ) :
	function modul_r_theme_colors_setup() {

		// get the custom colors
		$primary_color = esc_attr(get_theme_mod( 'primary-color' ));
		$secondary_color = esc_attr(get_theme_mod( 'secondary-color' ));

		// check if custom color is set otherwise use the default colors
		$primary_color = $primary_color != "" ? $primary_color : esc_attr($GLOBALS['modul_r_defaults']['colors']['primary']);
		$secondary_color = $secondary_color != "" ? $secondary_color : esc_attr($GLOBALS['modul_r_defaults']['colors']['secondary']);

		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Theme primary color light', 'modul-r' ),
				'slug'  => 'primary-light',
				'color' => modul_r_adjustBrightness($primary_color, +0.5),
			),
			array(
				'name'  => __( 'Theme primary color', 'modul-r' ),
				'slug'  => 'primary',
				'color' => $primary_color ,
			),
			array(
				'name'  => __( 'Theme primary color dark', 'modul-r' ),
				'slug'  => 'primary-dark',
				'color' => modul_r_adjustBrightness($primary_color, -0.5),
			),
			array(
				'name'  => __( 'Theme secondary color light', 'modul-r' ),
				'slug'  => 'secondary-light',
				'color' => modul_r_adjustBrightness($secondary_color, +0.5),
			),
			array(
				'name'  => __( 'Theme secondary color', 'modul-r' ),
				'slug'  => 'secondary',
				'color' => $secondary_color,
			),
			array(
				'name'  => __( 'Theme secondary color dark', 'modul-r' ),
				'slug'  => 'secondary-dark',
				'color' => modul_r_adjustBrightness($secondary_color, -0.5),
			),
			array(
				'name'  => __( 'White', 'modul-r' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'White Smoke', 'modul-r' ),
				'slug'  => 'whitesmoke',
				'color' => '#f3f3f3',
			),
			array(
				'name'  => __( 'Light gray', 'modul-r' ),
				'slug'  => 'light-gray',
				'color' => '#e3e3e3',
			),
			array(
				'name'  => __( 'Gray', 'modul-r' ),
				'slug'  => 'gray',
				'color' => '#888888',
			),
			array(
				'name'  => __( 'Dark gray', 'modul-r' ),
				'slug'  => 'dark-gray',
				'color' => '#4e4e4e',
			),
			array(
				'name'  => __( 'Black', 'modul-r' ),
				'slug'  => 'black',
				'color' => '#222222',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'modul_r_theme_colors_setup' );

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 * https://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 */
function modul_r_adjustBrightness($hexCode, $adjustPercent) {

	$hexCode = ltrim($hexCode, '#');

	if (strlen($hexCode) == 3) {
		$hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
	}

	$hexCode = array_map('hexdec', str_split($hexCode, 2));

	foreach ($hexCode as & $color) {
		$adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
		$adjustAmount = ceil($adjustableLimit * $adjustPercent);

		$color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
	}

	return '#' . implode($hexCode);
}
