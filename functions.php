<?php
/**
 * Core functions for the Rebecca Mercier block theme.
 *
 * @package rebecca-mercier-theme
 */

if ( ! function_exists( 'rebeccamercier_setup' ) ) {

	/**
	 * Theme setup.
	 */
	function rebeccamercier_setup() {

		// Make theme available for translation.
		load_theme_textdomain(
			'rebecca-mercier-theme',
			get_template_directory() . '/languages'
		);

		// Editor stylesheet (keeps editor closer to front-end).
		add_editor_style( get_template_directory_uri() . '/style.css' );

		// We’ll use our own patterns, not the core ones.
		remove_theme_support( 'core-block-patterns' );
	}
}
add_action( 'after_setup_theme', 'rebeccamercier_setup' );

/**
 * Front-end assets.
 */
function rebeccamercier_enqueue_assets() {

	wp_enqueue_style(
		'rebeccamercier-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Enqueue theme JavaScript for parallax and scroll effects
	wp_enqueue_script(
		'rebeccamercier-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'rebeccamercier_enqueue_assets' );

/**
 * Register custom block styles (same as Frost, just renamed).
 */
function rebeccamercier_register_block_styles() {

	$block_styles = array(
		'core/columns'      => array(
			'columns-reverse' => __( 'Reverse', 'rebecca-mercier-theme' ),
		),
		'core/group'        => array(
			'shadow-light' => __( 'Shadow', 'rebecca-mercier-theme' ),
			'shadow-solid' => __( 'Solid', 'rebecca-mercier-theme' ),
		),
		'core/list'         => array(
			'no-disc' => __( 'No Disc', 'rebecca-mercier-theme' ),
		),
		'core/quote'        => array(
			'shadow-light' => __( 'Shadow', 'rebecca-mercier-theme' ),
			'shadow-solid' => __( 'Solid', 'rebecca-mercier-theme' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'rebecca-mercier-theme' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'rebeccamercier_register_block_styles' );

/**
 * Register block pattern categories.
 */
function rebeccamercier_register_block_pattern_categories() {

	register_block_pattern_category(
		'rebeccamercier-page',
		array(
			'label'       => __( 'Page', 'rebecca-mercier-theme' ),
			'description' => __( 'Full page layouts for the site.', 'rebecca-mercier-theme' ),
		)
	);

	register_block_pattern_category(
		'rebeccamercier-pricing',
		array(
			'label'       => __( 'Pricing', 'rebecca-mercier-theme' ),
			'description' => __( 'Pricing / comparison layouts.', 'rebecca-mercier-theme' ),
		)
	);
}
add_action( 'init', 'rebeccamercier_register_block_pattern_categories' );
