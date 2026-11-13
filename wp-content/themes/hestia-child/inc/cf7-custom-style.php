<?php
/**
 * Contact Form 7 Modern & Fluent Form Style Enqueue
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Contact Form 7 custom stylesheet to match Fluent Forms modern clean look.
 */
function hestia_child_enqueue_cf7_custom_styles() {
	wp_enqueue_style(
		'hestia-child-cf7-fluent-style',
		get_stylesheet_directory_uri() . '/assets/css/cf7-fluent-style.css',
		array(),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hestia_child_enqueue_cf7_custom_styles', 99 );
