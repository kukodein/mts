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

/**
 * AMz Custom
 *
 */

// Update Image WP Login

function custom_login_branding() {
    // Ambil ID dan URL site icon
    $site_icon_id = get_option( 'site_icon' );
    $icon_url = $site_icon_id ? wp_get_attachment_image_url( $site_icon_id, 'full' ) : '';

    // Tambahkan CSS jika URL tersedia
    if ( $icon_url ) {
        echo '<style>
            #login h1 a {
                background-image: url(' . esc_url( $icon_url ) . ') !important;
                background-size: contain !important;
                width: 100% !important;
                height: 100px !important;
            }
        </style>';
    }

    // Ganti URL dan title dengan filter
    add_filter( 'login_headerurl', function() {
        return home_url();
    });

    add_filter( 'login_headertext', function() {
        return get_bloginfo( 'name' );
    });
}
add_action( 'login_enqueue_scripts', 'custom_login_branding' );
