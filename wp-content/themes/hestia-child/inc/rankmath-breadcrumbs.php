<?php
/**
 * Rank Math Breadcrumb Integration for Hestia Child Theme.
 *
 * Displays Rank Math breadcrumbs using the shortcode [rank_math_breadcrumb]
 * on Single Page and Single Post, positioned right above the title in the header.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hestia_Child_Rank_Math_Breadcrumb {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Declare Rank Math breadcrumb theme support.
		add_action( 'after_setup_theme', array( $this, 'declare_theme_support' ) );

		// Hook into header output for single post, single page, blog index, and archive pages.
		add_action( 'hestia_before_single_page_wrapper', array( $this, 'start_header_buffer' ), 9 );
		add_action( 'hestia_before_single_page_wrapper', array( $this, 'end_header_buffer' ), 11 );

		add_action( 'hestia_before_single_post_wrapper', array( $this, 'start_header_buffer' ), 9 );
		add_action( 'hestia_before_single_post_wrapper', array( $this, 'end_header_buffer' ), 11 );

		add_action( 'hestia_before_index_wrapper', array( $this, 'start_header_buffer' ), 9 );
		add_action( 'hestia_before_index_wrapper', array( $this, 'end_header_buffer' ), 11 );

		add_action( 'hestia_before_archive_content', array( $this, 'start_header_buffer' ), 9 );
		add_action( 'hestia_before_archive_content', array( $this, 'end_header_buffer' ), 11 );

		// Enqueue styling for the breadcrumbs in header.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 20 );
	}

	/**
	 * Declare theme support for Rank Math breadcrumbs.
	 */
	public function declare_theme_support() {
		add_theme_support( 'rank-math-breadcrumbs' );
	}

	/**
	 * Check if Rank Math plugin is installed and active.
	 *
	 * @return bool
	 */
	public static function is_rank_math_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
			return true;
		}

		if ( class_exists( 'RankMath' ) || defined( 'RANK_MATH_VERSION' ) || function_exists( 'rank_math' ) || shortcode_exists( 'rank_math_breadcrumb' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if breadcrumbs should be displayed.
	 *
	 * Enabled for Single Page, Single Post, Blog Index, and Archives (excluding the front page).
	 *
	 * @return bool
	 */
	private function should_display_breadcrumb() {
		// 1. Condition: check if Rank Math plugin is active.
		if ( ! self::is_rank_math_active() ) {
			return false;
		}

		// 2. Exclude static front page.
		if ( is_front_page() ) {
			return false;
		}

		// 3. For Single Page, Single Post, Blog Index, and Archives.
		return is_page() || is_single() || is_home() || is_archive();
	}

	/**
	 * Start output buffer before Hestia renders the page header.
	 */
	public function start_header_buffer() {
		if ( ! $this->should_display_breadcrumb() ) {
			return;
		}

		ob_start();
	}

	/**
	 * Capture header HTML and inject Rank Math breadcrumbs above the title.
	 */
	public function end_header_buffer() {
		if ( ! $this->should_display_breadcrumb() ) {
			return;
		}

		if ( ob_get_level() > 0 ) {
			$header_html = ob_get_clean();

			// Render the requested Rank Math breadcrumb shortcode.
			$breadcrumb = do_shortcode( '[rank_math_breadcrumb]' );

			if ( ! empty( $breadcrumb ) ) {
				$breadcrumb_markup = '<div class="hestia-rank-math-breadcrumb-wrap">' . $breadcrumb . '</div>';

				// Inject breadcrumb directly above <h1 class="hestia-title...
				if ( preg_match( '/(<h1[^>]*class=["\'][^"\']*hestia-title[^"\']*["\'][^>]*>)/i', $header_html ) ) {
					$header_html = preg_replace(
						'/(<h1[^>]*class=["\'][^"\']*hestia-title[^"\']*["\'][^>]*>)/i',
						$breadcrumb_markup . '$1',
						$header_html,
						1
					);
				} else {
					$header_html = $breadcrumb_markup . $header_html;
				}
			}

			echo $header_html;
		}
	}

	/**
	 * Enqueue styling for the breadcrumb in header.
	 */
	public function enqueue_styles() {
		if ( ! $this->should_display_breadcrumb() ) {
			return;
		}

		$css = '
			.hestia-rank-math-breadcrumb-wrap {
				position: relative;
				z-index: 3;
				margin-bottom: 15px;
				display: block;
			}
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb,
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb p {
				margin: 0;
				padding: 0;
				font-size: 13px;
				font-weight: 500;
				line-height: 1.6;
				color: rgba(255, 255, 255, 0.85);
			}
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb a {
				color: #ffffff !important;
				text-decoration: none !important;
				opacity: 0.9;
				transition: opacity 0.2s ease, text-decoration 0.2s ease;
			}
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb a:hover,
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb a:focus {
				opacity: 1;
				text-decoration: underline !important;
			}
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb .separator {
				color: rgba(255, 255, 255, 0.6) !important;
				margin: 0 8px;
			}
			.hestia-rank-math-breadcrumb-wrap .rank-math-breadcrumb .last {
				color: #ffffff !important;
				font-weight: 600;
				opacity: 1;
			}
		';

		wp_add_inline_style( 'hestia_style', $css );
	}
}

new Hestia_Child_Rank_Math_Breadcrumb();
