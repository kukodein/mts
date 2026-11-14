<?php
/**
 * Dynamic Asset Version Sync with Child Theme
 *
 * Automatically updates CSS and JS version queries to match Child Theme style.css version.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter the main Hestia stylesheet version to follow the Child Theme version.
 *
 * @return string
 */
add_filter( 'hestia_version_filter', function() {
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' );
	return ! empty( $version ) ? $version : '1.0.0';
} );

/**
 * Sync asset versions (CSS & JS) with the Child Theme version.
 *
 * @param string $src    The asset source URL.
 * @param string $handle The asset handle.
 * @return string
 */
function hestia_child_sync_asset_version( $src, $handle ) {
	$target_handles = array(
		'hestia_style',
		'hestia_child_parent',
		'hestia_child_parent_rtl',
		'hestia_scripts',
	);

	if ( in_array( $handle, $target_handles, true ) ) {
		$theme   = wp_get_theme();
		$version = $theme->get( 'Version' );

		if ( ! empty( $version ) ) {
			$src = add_query_arg( 'ver', $version, $src );
		}
	}

	return $src;
}
add_filter( 'style_loader_src', 'hestia_child_sync_asset_version', 99, 2 );
add_filter( 'script_loader_src', 'hestia_child_sync_asset_version', 99, 2 );

/**
 * Injeksi script pendukung untuk mengukur tinggi aktual navbar fixed
 * dan menyimpannya ke CSS custom property (--hestia-navbar-height).
 */
function hestia_child_hero_navbar_height_script() {
	$inline_js = "(function(){function setNavH(){var nav=document.querySelector('.navbar-fixed-top');if(nav&&nav.offsetHeight>0){document.documentElement.style.setProperty('--hestia-navbar-height',nav.offsetHeight+'px');}else{document.documentElement.style.setProperty('--hestia-navbar-height','0px');}}setNavH();window.addEventListener('resize',setNavH);window.addEventListener('DOMContentLoaded',setNavH);window.addEventListener('load',setNavH);})();";
	wp_add_inline_script( 'hestia_scripts', $inline_js );
}
add_action( 'wp_enqueue_scripts', 'hestia_child_hero_navbar_height_script', 30 );

