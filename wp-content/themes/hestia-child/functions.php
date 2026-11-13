<?php
if ( !defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'hestia_child_parent_css' ) ):
    function hestia_child_parent_css() {
        wp_enqueue_style( 'hestia_child_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap' ) );
	if( is_rtl() ) {
		wp_enqueue_style( 'hestia_child_parent_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css', array( 'bootstrap' ) );
	}

    }
endif;
add_action( 'wp_enqueue_scripts', 'hestia_child_parent_css', 10 );

/**
 * Enqueue Bootstrap 5 Utilities (d-none, py-*, my-*, d-flex, gap-*, etc.)
 */
function hestia_child_enqueue_bootstrap_utilities() {
	wp_enqueue_style(
		'bootstrap-5-utilities',
		get_stylesheet_directory_uri() . '/assets/css/bootstrap-utilities.min.css',
		array( 'bootstrap' ),
		'5.3.3'
	);
}
add_action( 'wp_enqueue_scripts', 'hestia_child_enqueue_bootstrap_utilities', 15 );
add_action( 'enqueue_block_editor_assets', 'hestia_child_enqueue_bootstrap_utilities' );

/**
 * Import options from Hestia
 *
 * @since 1.0.0
 */
function hestia_child_get_lite_options() {
	$hestia_mods = get_option( 'theme_mods_hestia' );
	if ( ! empty( $hestia_mods ) ) {
		foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
			set_theme_mod( $hestia_mod_k, $hestia_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'hestia_child_get_lite_options' );

/*
 * List of Additional Features for Hestia Child Theme
 * @since 1.0.0
 */

# Change the default WordPress login logo to favicon
require_once get_stylesheet_directory() . '/inc/kkd-change-login-logo.php';

# Load Unlocked Pro Features for Hestia Child Theme
require_once get_stylesheet_directory() . '/inc/hestia-pro-unlocked.php';

# Clean Elementor Editor: Hide Pro Placeholders & Upgrade Banners
require_once get_stylesheet_directory() . '/inc/elementor-clean-editor.php';

# Hide Hestia Child Menu & Show Hooks via CSS
require_once get_stylesheet_directory() . '/inc/admin-clean.php';

# Rank Math Breadcrumbs Integration for Single Post & Single Page
require_once get_stylesheet_directory() . '/inc/rankmath-breadcrumbs.php';

# Custom Archive Page Template & ACF Post Type Selector
require_once get_stylesheet_directory() . '/inc/archive-custom-template.php';

# Register Custom Post Type Prestasi & Taxonomy
require_once get_stylesheet_directory() . '/inc/post-type-prestasi.php';

# Register Custom Post Type Fasilitas & Taxonomy
require_once get_stylesheet_directory() . '/inc/post-type-fasilitas.php';

# Register Custom Post Type Kegiatan & Taxonomy
require_once get_stylesheet_directory() . '/inc/post-type-kegiatan.php';

# Single Post Classic Layout & Featured Image
require_once get_stylesheet_directory() . '/inc/single-post-classic-layout.php';

# Secure Custom Fields (SCF) Archive Header Options & Customization
require_once get_stylesheet_directory() . '/inc/scf-archive-options.php';

# Contact Form 7 Modern & Fluent Style
require_once get_stylesheet_directory() . '/inc/cf7-custom-style.php';


