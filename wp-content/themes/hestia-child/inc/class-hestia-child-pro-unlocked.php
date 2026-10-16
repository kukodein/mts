<?php
/**
 * Hestia Child - Pro Features Unlocked
 *
 * Unlocks Customizer controls and features previously restricted to Hestia Pro.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hestia_Child_Pro_Unlocked {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// 1. Disable Upsell Manager from core features list
		add_filter( 'hestia_filter_main_features', array( $this, 'filter_main_features' ) );

		// 2. Customizer setup and control unlocks
		add_action( 'customize_register', array( $this, 'unlock_customizer_controls' ), 999 );
		add_action( 'customize_controls_print_styles', array( $this, 'customizer_unlock_styles' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'customizer_unlock_scripts' ) );

		// 3. Frontend Footer replacement
		add_action( 'wp_loaded', array( $this, 'setup_footer_override' ) );

		// 4. Frontend Pricing Section
		add_action( 'hestia_sections', array( $this, 'render_pricing_section' ), 60 );

		// 5. Frontend Dynamic Section Reordering
		add_action( 'wp_head', array( $this, 'reorder_frontpage_sections' ), 1 );

		// 6. Frontend Dynamic Colors and Styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_unlocked_styles' ), 99 );

		// 7. Header Slider render support
		add_action( 'hestia_first_front_page_section_content', array( $this, 'render_slider_content' ), 5 );
	}

	/**
	 * Remove upsell-manager from Hestia's loaded features.
	 *
	 * @param array $features Theme features.
	 * @return array
	 */
	public function filter_main_features( $features ) {
		if ( is_array( $features ) ) {
			$features = array_diff( $features, array( 'upsell-manager' ) );
		}
		return $features;
	}

	/**
	 * Unlock, remove ads, and add real controls in Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer instance.
	 */
	public function unlock_customizer_controls( $wp_customize ) {

		// -------------------------------------------------------------
		// A. REMOVE PRO UPSELL SECTIONS, NOTICES & BANNERS
		// -------------------------------------------------------------
		$wp_customize->remove_section( 'hestia_upsell_main_section' );
		$wp_customize->remove_section( 'hestia_front_page_sections_upsell_section' );
		$wp_customize->remove_section( 'hestia_front_page_translation_upsell_section' );
		$wp_customize->remove_control( 'hestia_pricing_upsell_notice' );
		$wp_customize->remove_control( 'hestia_big_title_upsell_notice' );
		$wp_customize->remove_control( 'hestia_big_title_upsell' );
		$wp_customize->remove_control( 'color_upsell_notice' );
		$wp_customize->remove_control( 'hestia_buttons_text_upgrade' );
		$wp_customize->remove_control( 'hestia_navigation_upsell_notice' );
		$wp_customize->remove_control( 'hestia_typography_upsell' );
		$wp_customize->remove_control( 'hestia_link_to_top_text_upgrade' );

		// Small pro notices across various sections
		$sections_with_notices = array(
			'hestia_general',
			'colors',
			'hestia_shop',
			'hestia_blog',
			'hestia_blog_layout',
			'hestia_footer_content',
		);
		foreach ( $sections_with_notices as $s_id ) {
			$wp_customize->remove_control( 'hestia_pro_notice_' . $s_id );
		}

		// -------------------------------------------------------------
		// B. UNLOCK COLOR CONTROLS (Remove 'readonly' and unlock lock icons)
		// -------------------------------------------------------------
		$color_controls = array(
			'secondary_color',
			'body_color',
			'header_overlay_color',
			'header_text_color',
			'navbar_background_color',
			'navbar_text_color',
			'navbar_text_color_hover',
			'navbar_transparent_text_color',
		);
		foreach ( $color_controls as $color_id ) {
			$ctrl = $wp_customize->get_control( $color_id );
			if ( $ctrl ) {
				$ctrl->readonly = false;
			}
		}

		// -------------------------------------------------------------
		// C. UNLOCK FOOTER CONTROLS
		// -------------------------------------------------------------
		$wp_customize->remove_control( 'hestia_nr_footer_widgets_upsell' );
		$wp_customize->remove_control( 'hestia_general_credits_upsell' );
		$wp_customize->remove_control( 'hestia_copyright_alignment_upsell' );

		// 1. Number of Footer Widgets
		$wp_customize->add_setting(
			'hestia_nr_footer_widgets',
			array(
				'default'           => '3',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'hestia_nr_footer_widgets',
			array(
				'label'    => esc_html__( 'Number of widget areas', 'hestia-child' ),
				'section'  => 'hestia_footer_content',
				'priority' => 20,
				'type'     => 'radio',
				'choices'  => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
			)
		);

		// 2. Footer Credits / Copyright
		$default_credits = sprintf(
			/* translators: %1$s is Theme name, %2$s is WordPress link */
			esc_html__( '%1$s | Powered by %2$s', 'hestia-child' ),
			sprintf( '<a href="%1$s" rel="nofollow">%2$s</a>', esc_url( 'https://themeisle.com/themes/hestia/' ), 'Hestia' ),
			sprintf( '<a href="%1$s" rel="nofollow">%2$s</a>', esc_url( 'https://wordpress.org/' ), 'WordPress' )
		);
		$wp_customize->add_setting(
			'hestia_general_credits',
			array(
				'default'           => $default_credits,
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'hestia_general_credits',
			array(
				'label'       => esc_html__( 'Footer Credits', 'hestia-child' ),
				'description' => esc_html__( 'Edit or remove copyright text and branding.', 'hestia-child' ),
				'section'     => 'hestia_footer_content',
				'priority'    => 25,
				'type'        => 'textarea',
			)
		);

		// 3. Footer Copyright Layout / Alignment
		$wp_customize->add_setting(
			'hestia_copyright_alignment',
			array(
				'default'           => 'right',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$alignment_choices = array(
			'left'   => array(
				'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr7f6/PU5O+GuNWjyN71+fs9l8NToMi81ufq8vewz+LI3etmqMx3sNGVwNonU6TvAAAA3UlEQVR4Ae3VOU5EQRRDUd9XQ9Wf//5XS9OiBRECkTwhn8zZzSwzMzMzMzMzMzMzMzP7n9YrYLaqTMrCh3MojRIw+7HeE6IoiS1g11ODZSiH9qyqvR9DDbpS2KBpLDzMootQCjsMLXDeEUUFqn6Kr369v9c4tcEulSop6CmyTm7tUF4zSdbFpQqrpCFpJsnqTCmIfizL0AZHiqwCq2rw7lCHkSJLkygqbZmtaIWmHFn183JWiE1J7BB31TgaUJXGyktUJbK14GH2oWRKrZvMzMzMzMzMzMzMzMzM/uANmJYFb3EkojwAAAAASUVORK5CYII=',
				'label' => esc_html__( 'Left Sidebar', 'hestia' ),
			),
			'center' => array(
				'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr7f6/PU5O+GuNWjyN71+fs9l8NToMi81ufq8vewz+LI3etmqMx3sNGVwNonU6TvAAAA3UlEQVR4Ae3OO07GMBQF4TPXDztxHtn/ahG/AFFCgy7S+brpRvZDZmZmZmZmZmZmZnz3B51/y1ve8paZmZmZ2e/sd8BsVZmUjQ/XUBolYPZzfyZEURIr4NBLg20ohwaHVHs/hxp0pbCgaWwAs+gmlMIBQxtcT0RRgaoMGpcWHFKpkoKuDC4eHVC+siuDm1sVdklD0kyy1ZlSEP3ctqEFpzIosKsG7051GEphEkWlbbMV7dCUQ4UoetkhlpI4IJ6qcTagKo2dT1GVyGoBMPtQMqXWpf/EzMzMzMzMzOwNtQ4GgLlj5sIAAAAASUVORK5CYII=',
				'label' => esc_html__( 'Full Width', 'hestia' ),
			),
			'right'  => array(
				'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr7f6/PU5O+GuNWjyN71+fs9l8NToMi81ufq8vewz+LI3etmqMx3sNGVwNonU6TvAAAA3ElEQVR4Ae3Vu05DQRRDUe8zj5n7vv//tYSICDpQqiPk1bnbnWVmZmZmZmZmZmZmZmb2vvUKmK0qk7Lw5RxKowTMfqz3hChKYgvY9dRgGcqhPatq78dQg64UNmgaCw+z6CL0C356Y//NDkMLnHdEUYGaIqtxaoNdKlVS0FNkndzaobxmkqyLSxVWSUPSTJLVmVIQ/ViWoQ2OFFkFVtXg06EOI0WWJlFU2jJb0QpNOdTvy1khNiWxQ9xV42hAVRorL1GVyNaCh9mHkim1bvqnzMzMzMzMzMzMzMzM7ANTnwVvFI+orAAAAABJRU5ErkJggg==',
				'label' => esc_html__( 'Right Sidebar', 'hestia' ),
			),
		);

		if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {
			$wp_customize->add_control(
				new Hestia_Customize_Control_Radio_Image(
					$wp_customize,
					'hestia_copyright_alignment',
					array(
						'label'    => esc_html__( 'Layout Alignment', 'hestia-child' ),
						'priority' => 30,
						'section'  => 'hestia_footer_content',
						'choices'  => $alignment_choices,
					)
				)
			);
		} else {
			$wp_customize->add_control(
				'hestia_copyright_alignment',
				array(
					'label'    => esc_html__( 'Layout Alignment', 'hestia-child' ),
					'priority' => 30,
					'section'  => 'hestia_footer_content',
					'type'     => 'radio',
					'choices'  => array(
						'left'   => esc_html__( 'Left', 'hestia-child' ),
						'center' => esc_html__( 'Center', 'hestia-child' ),
						'right'  => esc_html__( 'Right', 'hestia-child' ),
					),
				)
			);
		}

		// Selective refresh for footer credits
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'hestia_general_credits',
				array(
					'selector'        => 'footer .hestia-bottom-footer-content .copyright',
					'settings'        => array( 'hestia_general_credits' ),
					'render_callback' => array( $this, 'render_footer_credits_partial' ),
				)
			);
		}

		// -------------------------------------------------------------
		// D. UNLOCK TOP BAR CONTROLS & TABS (FIX FOR USER SCREENSHOT)
		// -------------------------------------------------------------
		$wp_customize->remove_control( 'hestia_top_bar_alignment_upsell' );
		$wp_customize->remove_control( 'hestia_top_bar_background_color_upsell' );
		$wp_customize->remove_control( 'hestia_top_bar_text_color_upsell' );
		$wp_customize->remove_control( 'hestia_top_bar_link_color_upsell' );
		$wp_customize->remove_control( 'hestia_top_bar_link_color_hover_upsell' );

		// 1. Top Bar Alignment
		$wp_customize->add_setting(
			'hestia_top_bar_alignment',
			array(
				'default'           => 'right',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);

		$top_bar_align_choices = array(
			'left'  => array(
				'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABPUlEQVR4Ae3RuYojSxhE4Ti5L1nL+z/tVdISNFwYY5hWy4jPCPjLOlTKzMzMzMzMzMzMzMzMzP61WvSJAllbjvETsxLof464fvUR8ysr6ylVSZGph5L1B3z3F/dL41KFuSdD0mq0A6QjECJR9QSOfba4Socwfz5r0rXYQxOkDDRAN7QAUZ12wvzKGpzjHVkFygmUwRSkSSgaoMEpBWKGlQZdkandeJX681nqXCGMx1AEaRClBF8VkXizvT7cAcJ6Q9YicN4Eup5/q+oATVq+IWa4UrqSIkPKZXX6G7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn4w1ZOqFq7BEkrQAdpHzEIzJUI3BWlQZzAL3oDUrKz1FKVVKuNSXpPNIFSw9J2nJ5zi+62XrVh0kzjktmZmZmZmZmZmZmZmZm9s1/51AJDRsfaTQAAAAASUVORK5CYII=',
				'label' => esc_html__( 'Left Sidebar', 'hestia' ),
			),
			'right' => array(
				'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABO0lEQVR4Ae3RuWodQRhE4Tq9Lz3L+z+tb6MrMFZm0EhBfUHBP9FhWmZmZmZmZmZmZmZmZmb2Uot+o0DWlmP8jVkJ9MUR148+Yv7MynpLVVJk6qVkPaBxqcLckyFpNdoB0hEIkah6Asc+W1ylQ5j6B3/7j/urSddiD02QMtAA3dACRHXaCfMja3COJ7IKlBMogylIk1A0QINTCsQMKw26IlO78Sr1+7PUuUIYr6EI0iBKCT4qIvFm+/xwBwjrgaxF4LwJdL3/VtUBmrR8Q8xwpXQlRYaUy+r0B7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn44EsnVA19giSVoAOUj7iERmqETirSoM5gF6eyCopv0cpVUm51pSk80gXLL0kacvlPT/oZutVv0yacVwyMzMzMzMzMzMzMzMzs+/yB9eOCQ0dpl58AAAAAElFTkSuQmCC',
				'label' => esc_html__( 'Right Sidebar', 'hestia' ),
			),
		);

		if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {
			$wp_customize->add_control(
				new Hestia_Customize_Control_Radio_Image(
					$wp_customize,
					'hestia_top_bar_alignment',
					array(
						'label'    => esc_html__( 'Layout Alignment', 'hestia-child' ),
						'priority' => 10,
						'section'  => 'hestia_top_bar',
						'choices'  => $top_bar_align_choices,
					)
				)
			);
		} else {
			$wp_customize->add_control(
				'hestia_top_bar_alignment',
				array(
					'label'    => esc_html__( 'Layout Alignment', 'hestia-child' ),
					'priority' => 10,
					'section'  => 'hestia_top_bar',
					'type'     => 'radio',
					'choices'  => array(
						'left'  => esc_html__( 'Left', 'hestia-child' ),
						'right' => esc_html__( 'Right', 'hestia-child' ),
					),
				)
			);
		}

		// 2. Top Bar Background Color
		$wp_customize->add_setting(
			'hestia_top_bar_background_color',
			array(
				'default'           => '#363537',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'hestia_top_bar_background_color',
				array(
					'label'    => esc_html__( 'Background Color', 'hestia-child' ),
					'section'  => 'hestia_top_bar',
					'priority' => 20,
				)
			)
		);

		// 3. Top Bar Text Color
		$wp_customize->add_setting(
			'hestia_top_bar_text_color',
			array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'hestia_top_bar_text_color',
				array(
					'label'    => esc_html__( 'Text Color', 'hestia-child' ),
					'section'  => 'hestia_top_bar',
					'priority' => 25,
				)
			)
		);

		// 4. Top Bar Link Color
		$wp_customize->add_setting(
			'hestia_top_bar_link_color',
			array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'hestia_top_bar_link_color',
				array(
					'label'    => esc_html__( 'Link Color', 'hestia-child' ),
					'section'  => 'hestia_top_bar',
					'priority' => 30,
				)
			)
		);

		// 5. Top Bar Link Color Hover
		$wp_customize->add_setting(
			'hestia_top_bar_link_color_hover',
			array(
				'default'           => '#eeeeee',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'hestia_top_bar_link_color_hover',
				array(
					'label'    => esc_html__( 'Link Color Hover', 'hestia-child' ),
					'section'  => 'hestia_top_bar',
					'priority' => 35,
				)
			)
		);

		// CRITICAL: Update the tabs control for Top Bar so it shows the new unlocked controls!
		$top_bar_tabs = $wp_customize->get_control( 'hestia_very_top_bar_tabs' );
		if ( $top_bar_tabs ) {
			$top_bar_tabs->controls = array(
				'general'    => array(
					'hestia_top_bar_hide'      => array(),
					'hestia_top_bar_alignment' => array(),
					'hestia_link_to_top_menu'  => array(),
					'hestia_link_to_top_widgets' => array(),
				),
				'appearance' => array(
					'hestia_top_bar_background_color' => array(),
					'hestia_top_bar_text_color'       => array(),
					'hestia_top_bar_link_color'       => array(),
					'hestia_top_bar_link_color_hover' => array(),
				),
			);
		}

		// -------------------------------------------------------------
		// E. UNLOCK BUTTONS STYLE (Hover Effect)
		// -------------------------------------------------------------
		$wp_customize->remove_control( 'hestia_buttons_hover_effect_upsell' );
		$wp_customize->add_setting(
			'hestia_buttons_hover_effect',
			array(
				'default'           => 'shadow',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'hestia_buttons_hover_effect',
			array(
				'type'     => 'select',
				'label'    => esc_html__( 'Hover Effect', 'hestia-child' ),
				'section'  => 'hestia_buttons_style',
				'priority' => 25,
				'choices'  => array(
					'shadow' => esc_html__( 'Shadow', 'hestia-child' ),
					'color'  => esc_html__( 'Color', 'hestia-child' ),
				),
			)
		);

		// -------------------------------------------------------------
		// F. UNLOCK PRICING SECTION & TABS
		// -------------------------------------------------------------
		$pricing_sec = $wp_customize->get_section( 'hestia_pricing' );
		if ( $pricing_sec ) {
			$pricing_sec->locked = false;
		}

		$pricing_tabs = $wp_customize->get_control( 'hestia_pricing_tabs' );
		if ( $pricing_tabs && ! empty( $pricing_tabs->tabs ) ) {
			foreach ( $pricing_tabs->tabs as $k => $tab ) {
				$pricing_tabs->tabs[ $k ]['locked'] = false;
			}
		}

		// -------------------------------------------------------------
		// G. UNLOCK TYPOGRAPHY TABS
		// -------------------------------------------------------------
		$typo_tabs = $wp_customize->get_control( 'hestia_typography_tabs' );
		if ( $typo_tabs && isset( $typo_tabs->controls ) ) {
			unset( $typo_tabs->controls['font_family']['hestia_typography_upsell'] );
			unset( $typo_tabs->controls['font_sizes']['hestia_typography_upsell'] );
		}

		// -------------------------------------------------------------
		// H. UNLOCK BIG TITLE / SLIDER TABS
		// -------------------------------------------------------------
		$slider_type_ctrl = $wp_customize->get_control( 'hestia_slider_type' );
		if ( $slider_type_ctrl ) {
			$slider_type_ctrl->locked = false;
			if ( isset( $slider_type_ctrl->choices['video'] ) ) {
				$slider_type_ctrl->choices['video'] = esc_html__( 'Video', 'hestia' );
			}
		}

		$slider_tabs = $wp_customize->get_control( 'hestia_slider_tabs' );
		if ( $slider_tabs && isset( $slider_tabs->controls['slider']['hestia_big_title_upsell'] ) ) {
			unset( $slider_tabs->controls['slider']['hestia_big_title_upsell'] );
		}

		// -------------------------------------------------------------
		// I. UNLOCK BLOG LAYOUT (Remove redirect on 3rd layout)
		// -------------------------------------------------------------
		$blog_layout = $wp_customize->get_control( 'hestia_alternative_blog_layout' );
		if ( $blog_layout && isset( $blog_layout->choices['blog_alternative_layout2']['redirect'] ) ) {
			unset( $blog_layout->choices['blog_alternative_layout2']['redirect'] );
		}

		// -------------------------------------------------------------
		// J. SECTION REORDERING (Front Page Sections)
		// -------------------------------------------------------------
		$wp_customize->add_section(
			'hestia_child_sections_order',
			array(
				'title'    => esc_html__( 'Section Reordering', 'hestia-child' ),
				'panel'    => 'hestia_frontpage_sections',
				'priority' => 1,
			)
		);

		$sections_to_order = array(
			'features'     => array( 'label' => esc_html__( 'Features Section Order', 'hestia-child' ), 'default' => 1 ),
			'about'        => array( 'label' => esc_html__( 'About Section Order', 'hestia-child' ), 'default' => 2 ),
			'shop'         => array( 'label' => esc_html__( 'Shop Section Order', 'hestia-child' ), 'default' => 3 ),
			'portfolio'    => array( 'label' => esc_html__( 'Portfolio Section Order', 'hestia-child' ), 'default' => 4 ),
			'team'         => array( 'label' => esc_html__( 'Team Section Order', 'hestia-child' ), 'default' => 5 ),
			'pricing'      => array( 'label' => esc_html__( 'Pricing Section Order', 'hestia-child' ), 'default' => 6 ),
			'testimonials' => array( 'label' => esc_html__( 'Testimonials Section Order', 'hestia-child' ), 'default' => 7 ),
			'subscribe'    => array( 'label' => esc_html__( 'Subscribe Section Order', 'hestia-child' ), 'default' => 8 ),
			'blog'         => array( 'label' => esc_html__( 'Blog Section Order', 'hestia-child' ), 'default' => 9 ),
			'contact'      => array( 'label' => esc_html__( 'Contact Section Order', 'hestia-child' ), 'default' => 10 ),
		);

		$p_counter = 10;
		foreach ( $sections_to_order as $s_key => $s_data ) {
			$wp_customize->add_setting(
				'hestia_child_order_' . $s_key,
				array(
					'default'           => $s_data['default'],
					'sanitize_callback' => 'absint',
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				'hestia_child_order_' . $s_key,
				array(
					'label'       => $s_data['label'],
					'section'     => 'hestia_child_sections_order',
					'priority'    => $p_counter,
					'type'        => 'number',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 99,
						'step' => 1,
					),
				)
			);
			$p_counter += 5;
		}
	}

	/**
	 * Customizer Unlock CSS to override disabled pointer events, locks, and hidden items.
	 */
	public function customizer_unlock_styles() {
		?>
		<style id="hestia-child-unlock-customizer-css">
			/* Enable all previously locked controls */
			.customize-locked-control,
			ul:where([id*=hestia_footer_content], [id*=hestia_buttons_style], [id*=hestia_top_bar]) [id*=upsell],
			.alpha-color-locked,
			.hestia-section-hidden .hestia-toggle-section.hestia-section-locked {
				opacity: 1 !important;
				pointer-events: auto !important;
			}

			/* Hide all lock icons and upsell notices */
			ul:where([id*=hestia_footer_content], [id*=hestia_buttons_style], [id*=hestia_top_bar]) [id*=upsell] .customize-control-title::after,
			.hestia-locked-icon span.dashicons-lock,
			span.dashicons-lock,
			.alpha-color-locked,
			.themeisle-upsell,
			#customize-control-hestia_pricing_upsell_notice,
			#customize-control-hestia_big_title_upsell_notice,
			#customize-control-hestia_navigation_upsell_notice,
			#customize-control-hestia_typography_upsell,
			#customize-control-color_upsell_notice,
			#accordion-section-hestia_upsell_main_section,
			[id*=hestia][id*=_text_upgrade],
			[id*=hestia][id*=_upsell_notice] {
				display: none !important;
			}

			/* Reveal Pricing Controls that were hidden by the upsell notice selector */
			#customize-control-hestia_pricing_upsell_notice ~ li {
				display: list-item !important;
			}

			/* Allow text selection & editing on un-readonlied inputs */
			.customize-control-alpha-color input[readonly] {
				pointer-events: auto !important;
				background-color: #fff !important;
				cursor: text !important;
			}
		</style>
		<?php
	}

	/**
	 * Customizer Unlock JS scripts.
	 */
	public function customizer_unlock_scripts() {
		?>
		<script id="hestia-child-unlock-customizer-js">
			(function($) {
				wp.customize.bind('ready', function() {
					// 1. Remove locked classes from any remaining controls
					$('.hestia-locked-icon').removeClass('hestia-locked-icon');
					$('.customize-locked-control').removeClass('customize-locked-control');

					// 2. Remove readonly attribute from alpha color controls
					$('input.alpha-color-control').removeAttr('readonly');

					// 3. Ensure tab click switches display properly for unlocked top bar controls
					setTimeout(function() {
						$('.hestia-customizer-tab.active > label').trigger('click');
					}, 300);
				});
			})(jQuery);
		</script>
		<?php
	}

	/**
	 * Setup footer override to output custom credits and alignment.
	 */
	public function setup_footer_override() {
		global $wp_filter;
		if ( isset( $wp_filter['hestia_do_bottom_footer_content'] ) ) {
			foreach ( $wp_filter['hestia_do_bottom_footer_content']->callbacks as $priority => $callbacks ) {
				foreach ( $callbacks as $idx => $callback ) {
					if ( is_array( $callback['function'] ) && is_a( $callback['function'][0], 'Hestia_Footer' ) && 'bottom_footer_content' === $callback['function'][1] ) {
						unset( $wp_filter['hestia_do_bottom_footer_content']->callbacks[ $priority ][ $idx ] );
					}
				}
			}
		}
		add_action( 'hestia_do_bottom_footer_content', array( $this, 'render_bottom_footer' ), 10 );
	}

	/**
	 * Render bottom footer content with editable credits.
	 */
	public function render_bottom_footer() {
		$credits = get_theme_mod( 'hestia_general_credits' );
		if ( false === $credits ) {
			$credits = sprintf(
				/* translators: %1$s is Theme Name, %2$s is WordPress */
				esc_html__( '%1$s | Developed by %2$s', 'hestia' ),
				esc_html__( 'Hestia', 'hestia' ),
				sprintf( '<a href="%1$s" rel="nofollow">%2$s</a>', esc_url( 'https://themeisle.com' ), 'ThemeIsle' )
			);
		}

		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'depth'          => 1,
					'container'      => 'ul',
					'menu_class'     => 'footer-menu',
				)
			);
		}

		$alignment   = get_theme_mod( 'hestia_copyright_alignment', 'right' );
		$align_class = 'pull-right';
		if ( 'left' === $alignment ) {
			$align_class = 'pull-left';
		} elseif ( 'center' === $alignment ) {
			$align_class = 'hestia-center';
		}

		echo '<div class="copyright ' . esc_attr( $align_class ) . '">';
		echo wp_kses_post( $credits );
		echo '</div>';
	}

	/**
	 * Render callback for footer credits selective refresh.
	 */
	public function render_footer_credits_partial() {
		$credits = get_theme_mod( 'hestia_general_credits' );
		echo wp_kses_post( $credits );
	}

	/**
	 * Render Pricing Section on Frontpage.
	 */
	public function render_pricing_section() {
		$hide = get_theme_mod( 'hestia_pricing_hide', false );
		if ( (bool) $hide === true ) {
			return;
		}

		$title    = get_theme_mod( 'hestia_pricing_title', esc_html__( 'Choose a plan for your next project', 'hestia-child' ) );
		$subtitle = get_theme_mod( 'hestia_pricing_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-child' ) );

		// Table One
		$t1_title    = get_theme_mod( 'hestia_pricing_table_one_title', esc_html__( 'Basic Package', 'hestia-child' ) );
		$t1_icon     = get_theme_mod( 'hestia_pricing_table_one_icon', 'fa fa-paper-plane' );
		$t1_price    = get_theme_mod( 'hestia_pricing_table_one_price', '<small>$</small>0' );
		$t1_features = get_theme_mod( 'hestia_pricing_table_one_features', "<b>1</b> Domain\n<b>1GB</b> Storage\n<b>100GB</b> Bandwidth\n<b>2</b> Databases" );
		$t1_text     = get_theme_mod( 'hestia_pricing_table_one_text', esc_html__( 'Free Download', 'hestia-child' ) );
		$t1_link     = get_theme_mod( 'hestia_pricing_table_one_link', '#' );

		// Table Two
		$t2_title    = get_theme_mod( 'hestia_pricing_table_two_title', esc_html__( 'Premium Package', 'hestia-child' ) );
		$t2_icon     = get_theme_mod( 'hestia_pricing_table_two_icon', 'fa fa-rocket' );
		$t2_price    = get_theme_mod( 'hestia_pricing_table_two_price', '<small>$</small>49' );
		$t2_features = get_theme_mod( 'hestia_pricing_table_two_features', "<b>5</b> Domains\n<b>Unlimited</b> Storage\n<b>Unlimited</b> Bandwidth\n<b>Unlimited</b> Databases" );
		$t2_text     = get_theme_mod( 'hestia_pricing_table_two_text', esc_html__( 'Order Now', 'hestia-child' ) );
		$t2_link     = get_theme_mod( 'hestia_pricing_table_two_link', '#' );
		?>
		<section class="hestia-pricing" id="pricing" data-sorder="hestia_pricing" style="padding: 70px 0;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<?php if ( ! empty( $title ) ) : ?>
							<h2 class="hestia-title"><?php echo esc_html( $title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $subtitle ) ) : ?>
							<h5 class="description"><?php echo esc_html( $subtitle ); ?></h5>
						<?php endif; ?>
					</div>
				</div>
				<div class="hestia-pricing-content" style="margin-top: 40px;">
					<div class="row">
						<!-- Table 1 -->
						<div class="col-md-6 col-sm-6">
							<div class="card card-pricing" style="text-align: center; padding: 30px; margin-bottom: 30px; background: #fff; border-radius: 6px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
								<div class="content">
									<h6 class="category" style="color: #999; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; font-weight: 700;"><?php echo esc_html( $t1_title ); ?></h6>
									<?php if ( ! empty( $t1_icon ) ) : ?>
										<div class="icon" style="font-size: 40px; margin: 15px 0; color: var(--hestia-primary-color, #e91e63);"><i class="<?php echo esc_attr( $t1_icon ); ?>"></i></div>
									<?php endif; ?>
									<h3 class="card-title" style="margin: 15px 0 20px; font-size: 38px; font-weight: 700;"><?php echo wp_kses_post( $t1_price ); ?></h3>
									<ul style="list-style: none; padding: 0; margin-bottom: 25px; line-height: 2.2; color: #777;">
										<?php
										$features_lines = explode( "\n", str_replace( '\n', "\n", $t1_features ) );
										foreach ( $features_lines as $f ) {
											if ( trim( $f ) !== '' ) {
												echo '<li>' . wp_kses_post( trim( $f ) ) . '</li>';
											}
										}
										?>
									</ul>
									<?php if ( ! empty( $t1_text ) ) : ?>
										<a href="<?php echo esc_url( $t1_link ); ?>" class="btn btn-primary btn-round"><?php echo esc_html( $t1_text ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<!-- Table 2 -->
						<div class="col-md-6 col-sm-6">
							<div class="card card-pricing card-raised" style="text-align: center; padding: 30px; margin-bottom: 30px; background: #fff; border-radius: 6px; box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.25); border: 2px solid var(--hestia-primary-color, #e91e63);">
								<div class="content">
									<h6 class="category" style="color: var(--hestia-primary-color, #e91e63); text-transform: uppercase; font-size: 12px; letter-spacing: 1px; font-weight: 700;"><?php echo esc_html( $t2_title ); ?></h6>
									<?php if ( ! empty( $t2_icon ) ) : ?>
										<div class="icon" style="font-size: 40px; margin: 15px 0; color: var(--hestia-primary-color, #e91e63);"><i class="<?php echo esc_attr( $t2_icon ); ?>"></i></div>
									<?php endif; ?>
									<h3 class="card-title" style="margin: 15px 0 20px; font-size: 38px; font-weight: 700;"><?php echo wp_kses_post( $t2_price ); ?></h3>
									<ul style="list-style: none; padding: 0; margin-bottom: 25px; line-height: 2.2; color: #777;">
										<?php
										$features_lines2 = explode( "\n", str_replace( '\n', "\n", $t2_features ) );
										foreach ( $features_lines2 as $f ) {
											if ( trim( $f ) !== '' ) {
												echo '<li>' . wp_kses_post( trim( $f ) ) . '</li>';
											}
										}
										?>
									</ul>
									<?php if ( ! empty( $t2_text ) ) : ?>
										<a href="<?php echo esc_url( $t2_link ); ?>" class="btn btn-primary btn-round"><?php echo esc_html( $t2_text ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	/**
	 * Dynamic Section Reordering via hook priority.
	 */
	public function reorder_frontpage_sections() {
		if ( ! is_front_page() ) {
			return;
		}

		$section_hooks = array(
			'features'     => 'hestia_features_section',
			'about'        => 'hestia_about_section',
			'shop'         => 'hestia_shop_section',
			'portfolio'    => 'hestia_portfolio_section',
			'team'         => 'hestia_team_section',
			'testimonials' => 'hestia_testimonials_section',
			'subscribe'    => 'hestia_subscribe_section',
			'blog'         => 'hestia_blog_section',
			'contact'      => 'hestia_contact_section',
		);

		foreach ( $section_hooks as $s_key => $func_name ) {
			$saved_order = get_theme_mod( 'hestia_child_order_' . $s_key );
			if ( false !== $saved_order && '' !== $saved_order ) {
				$priority = absint( $saved_order ) * 10;
				remove_action( 'hestia_sections', $func_name );
				add_action( 'hestia_sections', $func_name, $priority );
			}
		}

		// Pricing section priority
		$pricing_order = get_theme_mod( 'hestia_child_order_pricing' );
		if ( false !== $pricing_order && '' !== $pricing_order ) {
			remove_action( 'hestia_sections', array( $this, 'render_pricing_section' ), 60 );
			add_action( 'hestia_sections', array( $this, 'render_pricing_section' ), absint( $pricing_order ) * 10 );
		}
	}

	/**
	 * Enqueue unlocked custom styles on frontend.
	 */
	public function enqueue_unlocked_styles() {
		$css = '';

		// 1. Header Overlay Color & Opacity
		$header_overlay = get_theme_mod( 'header_overlay_color' );
		if ( ! empty( $header_overlay ) && 'rgba(0,0,0,0.5)' !== $header_overlay ) {
			$css .= '.header-filter, .header-filter-gradient { background: ' . esc_attr( $header_overlay ) . ' !important; }';
		}

		// 2. Header / Slider Text Color
		$header_text_color = get_theme_mod( 'header_text_color' );
		if ( ! empty( $header_text_color ) && '#fff' !== $header_text_color && '#ffffff' !== $header_text_color ) {
			$css .= '.carousel .carousel-caption, .page-header, .page-header .hestia-title, .page-header .sub-title, .page-header h1, .page-header h2, .page-header h3, .page-header h4, .page-header h5 { color: ' . esc_attr( $header_text_color ) . ' !important; }';
		}

		// 3. Navbar Background Color
		$navbar_bg = get_theme_mod( 'navbar_background_color' );
		if ( ! empty( $navbar_bg ) && '#fff' !== $navbar_bg && '#ffffff' !== $navbar_bg ) {
			$css .= '.navbar:not(.navbar-transparent) { background-color: ' . esc_attr( $navbar_bg ) . ' !important; }';
		}

		// 4. Navbar Text Color
		$navbar_text = get_theme_mod( 'navbar_text_color' );
		if ( ! empty( $navbar_text ) && '#555' !== $navbar_text && '#555555' !== $navbar_text ) {
			$css .= '.navbar:not(.navbar-transparent) .navbar-nav > li:not(.btn) > a { color: ' . esc_attr( $navbar_text ) . ' !important; }';
		}

		// 5. Navbar Text Color Hover
		$navbar_hover = get_theme_mod( 'navbar_text_color_hover' );
		if ( ! empty( $navbar_hover ) && '#e91e63' !== $navbar_hover ) {
			$css .= '.navbar:not(.navbar-transparent) .navbar-nav > li:not(.btn) > a:hover, .navbar:not(.navbar-transparent) .navbar-nav > li:not(.btn) > a:focus { color: ' . esc_attr( $navbar_hover ) . ' !important; }';
		}

		// 6. Transparent Navbar Text Color
		$navbar_trans_text = get_theme_mod( 'navbar_transparent_text_color' );
		if ( ! empty( $navbar_trans_text ) && '#fff' !== $navbar_trans_text && '#ffffff' !== $navbar_trans_text ) {
			$css .= '.navbar.navbar-transparent .navbar-nav > li:not(.btn) > a { color: ' . esc_attr( $navbar_trans_text ) . ' !important; }';
		}

		// 7. Body Text Color
		$body_color = get_theme_mod( 'body_color' );
		if ( ! empty( $body_color ) && '#999999' !== $body_color ) {
			$css .= 'body, p, .card-description { color: ' . esc_attr( $body_color ) . ' !important; }';
		}

		// 8. Secondary Color
		$secondary_color = get_theme_mod( 'secondary_color' );
		if ( ! empty( $secondary_color ) && '#2d3359' !== $secondary_color ) {
			$css .= '.btn.btn-primary:hover, .btn.btn-primary:focus { background-color: ' . esc_attr( $secondary_color ) . ' !important; }';
		}

		// 9. Buttons Hover Effect (Color vs Shadow)
		$button_hover = get_theme_mod( 'hestia_buttons_hover_effect', 'shadow' );
		if ( 'color' === $button_hover ) {
			$css .= '.btn:hover, .btn:focus { box-shadow: none !important; opacity: 0.9; }';
		}

		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'hestia_style', $css );
		}
	}

	/**
	 * Render Slider Content if multiple slides are configured.
	 */
	public function render_slider_content() {
		$slider_type = get_theme_mod( 'hestia_slider_type', 'image' );
		if ( 'slider' !== $slider_type ) {
			return;
		}

		$slider_content = get_theme_mod( 'hestia_slider_content' );
		if ( empty( $slider_content ) ) {
			return;
		}

		$slides = json_decode( $slider_content, true );
		if ( ! is_array( $slides ) || empty( $slides ) ) {
			return;
		}

		$counter = 0;
		foreach ( $slides as $slide ) {
			$counter++;
			$active_class = ( 1 === $counter ) ? ' active' : '';
			$image        = isset( $slide['image_url'] ) ? $slide['image_url'] : '';
			$title        = isset( $slide['title'] ) ? $slide['title'] : '';
			$subtitle     = isset( $slide['subtitle'] ) ? $slide['subtitle'] : '';
			$text         = isset( $slide['text'] ) ? $slide['text'] : '';
			$link         = isset( $slide['link'] ) ? $slide['link'] : '';
			$text2        = isset( $slide['text2'] ) ? $slide['text2'] : '';
			$link2        = isset( $slide['link2'] ) ? $slide['link2'] : '';
			?>
			<div class="item item-<?php echo esc_attr( $counter ); ?><?php echo esc_attr( $active_class ); ?>">
				<div class="header-filter" <?php echo ! empty( $image ) ? 'style="background-image: url(' . esc_url( $image ) . ');"' : ''; ?>></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center">
							<?php if ( ! empty( $title ) ) : ?>
								<h1 class="hestia-title"><?php echo esc_html( $title ); ?></h1>
							<?php endif; ?>
							<?php if ( ! empty( $subtitle ) ) : ?>
								<span class="sub-title"><?php echo esc_html( $subtitle ); ?></span>
							<?php endif; ?>
							<div class="buttons" style="margin-top: 30px;">
								<?php if ( ! empty( $text ) && ! empty( $link ) ) : ?>
									<a href="<?php echo esc_url( $link ); ?>" class="btn btn-primary btn-lg"><?php echo esc_html( $text ); ?></a>
								<?php endif; ?>
								<?php if ( ! empty( $text2 ) && ! empty( $link2 ) ) : ?>
									<a href="<?php echo esc_url( $link2 ); ?>" class="btn btn-primary btn-lg" style="margin-left: 10px;"><?php echo esc_html( $text2 ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

new Hestia_Child_Pro_Unlocked();
