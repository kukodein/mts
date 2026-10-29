<?php
/**
 * Hide Hestia Child Menu & Show Hooks in WP Admin via CSS
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output CSS to hide Hestia Child menu and Show Hooks admin bar item.
 */
function hestia_child_hide_admin_menus_css() {
	echo '<style id="hestia-child-hide-menus-css">
		/* 1. Sembunyikan menu "Hestia Child" di sidebar WP Admin */
		#toplevel_page_hestia-welcome,
		#adminmenu a[href*="page=hestia-welcome"],
		#adminmenu li:has(> a[href*="page=hestia-welcome"]) {
			display: none !important;
		}

		/* 2. Sembunyikan menu "Show Hooks" di Top Admin Bar */
		#wp-admin-bar-hestia_preview_hook {
			display: none !important;
		}
	</style>' . "\n";
}
add_action( 'admin_head', 'hestia_child_hide_admin_menus_css' );
add_action( 'wp_head', 'hestia_child_hide_admin_menus_css' );

