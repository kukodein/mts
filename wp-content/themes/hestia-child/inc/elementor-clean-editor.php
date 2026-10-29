<?php
/**
 * Elementor Clean Editor
 *
 * Hides Pro placeholders, locked widgets, and promotional banners in Elementor and Essential Addons.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hestia_Child_Elementor_Clean_Editor {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// 1. Disable Essential Addons Pro promotion widgets & notices
		add_filter( 'eael/pro_enabled', '__return_true' );

		// 2. Disable Elementor panel "Get Pro" banner
		add_filter( 'elementor/editor/panel/get_pro_details', array( $this, 'filter_pro_details' ) );

		// 3. Inject CSS to hide locked widgets, pro categories, and promotional elements
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_clean_editor_styles' ) );
	}

	/**
	 * Hide the bottom upgrade banner in the Elementor panel.
	 *
	 * @param array $details Banner details.
	 * @return array
	 */
	public function filter_pro_details( $details ) {
		$details['show_banner'] = false;
		return $details;
	}

	/**
	 * Enqueue inline styles to clean up the Elementor editor interface.
	 */
	public function enqueue_clean_editor_styles() {
		$css = '
			/* 1. Sembunyikan kategori Pro & promosi di panel widget */
			#elementor-panel-category-pro-elements,
			#elementor-panel-category-theme-elements,
			#elementor-panel-category-woocommerce-elements,
			#elementor-panel-category-atomic-form,
			#elementor-panel-category-theme-elements-single,
			#elementor-panel-category-custom-widgets,
			#elementor-panel-category-prime-slider-pro-tweeks,

			/* 2. Sembunyikan widget placeholder yang terkunci (gembok / promotion) */
			.elementor-element--promotion,
			.elementor-element-wrapper:has(.icon .eicon-lock),
			.elementor-element-wrapper:has([class*="eaicon-lock"]),
			.elementor-element-wrapper:has(.eicon-upgrade-crown-full),
			.elementor-element-wrapper:has(.eicon-pro-icon),

			/* 3. Sembunyikan banner "Get Pro" & sticky banner di bawah panel */
			#elementor-panel-get-pro-elements,
			#elementor-panel-get-pro-elements-sticky,
			.elementor-panel-editor-sticky-promotion,

			/* 4. Sembunyikan teaser / promo fitur Pro di panel setting (Motion Effects, Display Conditions, dll.) */
			.e-control-display-conditions-promotion__wrapper,
			.e-control-motion-effects-promotion__wrapper,
			.e-control-motion-effects-promotion__lock-wrapper,
			.elementor-control-media__promotions,
			.elementor-nerd-box,
			.eael-section-pro,
			.eael-pro-badge,
			.eael-go-pro,
			.e-promotion-go-pro 
			{
				display: none !important;
			}
		';

		wp_add_inline_style( 'elementor-editor', $css );
	}
}

new Hestia_Child_Elementor_Clean_Editor();

