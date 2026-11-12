<?php
/**
 * Secure Custom Fields (SCF / ACF) Archive Options & Header Integration.
 *
 * Mengelola sinkronisasi JSON SCF, registrasi Options Page untuk Header Arsip
 * (Default, Prestasi, Fasilitas, Kegiatan), serta filtering judul, background image, dan deskripsi
 * pada native post type archive maupun halaman single page (termasuk template default dan custom archive).
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. SCF / ACF JSON Synchronization.
 * Mengarahkan penyimpanan dan pembacaan JSON ke direktori `wp-content/themes/hestia-child/scf-json/`.
 */
function hestia_child_scf_json_save_point( $path ) {
	$scf_dir = get_stylesheet_directory() . '/scf-json';
	if ( ! file_exists( $scf_dir ) ) {
		wp_mkdir_p( $scf_dir );
	}
	return $scf_dir;
}
add_filter( 'acf/settings/save_json', 'hestia_child_scf_json_save_point' );

function hestia_child_scf_json_load_point( $paths ) {
	$paths[] = get_stylesheet_directory() . '/scf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'hestia_child_scf_json_load_point' );

/**
 * 2. Registrasi Options Page untuk Pengaturan Header Arsip.
 * Menu akan muncul di WP-Admin dengan slug `archive-settings` (sesuai rule SCF JSON).
 */
function hestia_child_register_archive_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => 'Pengaturan Header Arsip',
				'menu_title' => 'Header Arsip',
				'menu_slug'  => 'archive-settings',
				'capability' => 'edit_theme_options',
				'icon_url'   => 'dashicons-format-image',
				'position'   => 25,
				'redirect'   => false,
			)
		);
	}
}
add_action( 'acf/init', 'hestia_child_register_archive_options_page', 5 );

/**
 * 3. Registrasi Local Field Group PHP untuk Options Page Header Arsip & Halaman Default.
 * Memastikan pengaturan langsung muncul di WP-Admin bahkan sebelum sync database.
 */
function hestia_child_register_archive_options_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Group 1: Options Page Header Arsip (Default, Prestasi, Fasilitas, Kegiatan)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_archive_cpt_settings',
			'title'                 => 'Pengaturan Header Arsip Post Type',
			'fields'                => array(
				// Tab Default
				array(
					'key'          => 'field_tab_default',
					'label'        => 'Default / Halaman Default',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
					'endpoint'     => 0,
				),
				array(
					'key'          => 'field_archive_default_title',
					'label'        => 'Custom Judul Archive Default',
					'name'         => 'archive_default_title',
					'type'         => 'text',
					'instructions' => 'Judul utama yang tampil pada header halaman arsip default / pos berita / fallback halaman. Kosongkan untuk menggunakan judul bawaan.',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Berita & Informasi Madrasah',
				),
				array(
					'key'           => 'field_archive_default_bg_image',
					'label'         => 'Custom Background Image Default',
					'name'          => 'archive_default_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk header banner arsip default / fallback halaman.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_archive_default_description',
					'label'        => 'Custom Deskripsi Archive Default',
					'name'         => 'archive_default_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner default.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Informasi terkini, pengumuman, dan berita seputar MTsN Semarang.',
					'rows'         => 3,
				),

				// Tab Prestasi
				array(
					'key'          => 'field_tab_prestasi',
					'label'        => 'Prestasi',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
					'endpoint'     => 0,
				),
				array(
					'key'          => 'field_archive_prestasi_title',
					'label'        => 'Custom Judul Archive Prestasi',
					'name'         => 'archive_prestasi_title',
					'type'         => 'text',
					'instructions' => 'Judul utama yang tampil pada header banner arsip Prestasi (/prestasi/). Kosongkan untuk menggunakan judul bawaan (Prestasi).',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Prestasi Santri & Madrasah',
				),
				array(
					'key'           => 'field_archive_prestasi_bg_image',
					'label'         => 'Custom Background Image Prestasi',
					'name'          => 'archive_prestasi_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk header banner arsip Prestasi.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_archive_prestasi_description',
					'label'        => 'Custom Deskripsi Archive Prestasi',
					'name'         => 'archive_prestasi_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner arsip Prestasi.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Catatan torehan juara dan prestasi membanggakan santri serta civitas akademika MTsN Semarang.',
					'rows'         => 3,
				),

				// Tab Fasilitas
				array(
					'key'          => 'field_tab_fasilitas',
					'label'        => 'Fasilitas',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
					'endpoint'     => 0,
				),
				array(
					'key'          => 'field_archive_fasilitas_title',
					'label'        => 'Custom Judul Archive Fasilitas',
					'name'         => 'archive_fasilitas_title',
					'type'         => 'text',
					'instructions' => 'Judul utama yang tampil pada header banner arsip Fasilitas (/fasilitas/). Kosongkan untuk menggunakan judul bawaan (Fasilitas).',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Fasilitas & Sarana Prasarana',
				),
				array(
					'key'           => 'field_archive_fasilitas_bg_image',
					'label'         => 'Custom Background Image Fasilitas',
					'name'          => 'archive_fasilitas_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk header banner arsip Fasilitas.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_archive_fasilitas_description',
					'label'        => 'Custom Deskripsi Archive Fasilitas',
					'name'         => 'archive_fasilitas_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner arsip Fasilitas.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Informasi sarana, prasarana, laboratorium modern, dan fasilitas penunjang pembelajaran madrasah.',
					'rows'         => 3,
				),

				// Tab Kegiatan
				array(
					'key'          => 'field_tab_kegiatan',
					'label'        => 'Kegiatan',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
					'endpoint'     => 0,
				),
				array(
					'key'          => 'field_archive_kegiatan_title',
					'label'        => 'Custom Judul Archive Kegiatan',
					'name'         => 'archive_kegiatan_title',
					'type'         => 'text',
					'instructions' => 'Judul utama yang tampil pada header banner arsip Kegiatan (/kegiatan/). Kosongkan untuk menggunakan judul bawaan (Kegiatan).',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Kegiatan & Agenda Madrasah',
				),
				array(
					'key'           => 'field_archive_kegiatan_bg_image',
					'label'         => 'Custom Background Image Kegiatan',
					'name'          => 'archive_kegiatan_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk header banner arsip Kegiatan.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_archive_kegiatan_description',
					'label'        => 'Custom Deskripsi Archive Kegiatan',
					'name'         => 'archive_kegiatan_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner arsip Kegiatan.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Dokumentasi agenda, aktivitas kesiswaan, keagamaan, dan pembiasaan karakter santri MTsN Semarang.',
					'rows'         => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'archive-settings',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	// Group 2: Pengaturan Header untuk Halaman Default
	acf_add_local_field_group(
		array(
			'key'                   => 'group_default_page_settings',
			'title'                 => 'Pengaturan Header Halaman Default',
			'fields'                => array(
				array(
					'key'          => 'field_default_page_header_title',
					'label'        => 'Custom Judul Header',
					'name'         => 'archive_header_title',
					'type'         => 'text',
					'instructions' => 'Judul banner header halaman default. Kosongkan untuk menggunakan judul halaman bawaan.',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Selamat Datang di MTsN Semarang',
				),
				array(
					'key'           => 'field_default_page_header_bg_image',
					'label'         => 'Custom Background Image Header',
					'name'          => 'archive_header_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk banner header halaman default. Kosongkan untuk background default.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_default_page_header_description',
					'label'        => 'Custom Deskripsi Header',
					'name'         => 'archive_header_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner halaman default.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Tuliskan deskripsi singkat untuk halaman ini...',
					'rows'         => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'default',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'hestia_child_register_archive_options_fields', 10 );

/**
 * 4. Helper: Ekstraksi URL gambar dari berbagai format data ACF/SCF (Array, ID, atau URL string).
 *
 * @param mixed $image_data Data gambar dari ACF/SCF.
 * @return string URL gambar atau string kosong.
 */
function hestia_child_get_image_url( $image_data ) {
	if ( empty( $image_data ) ) {
		return '';
	}

	if ( is_array( $image_data ) ) {
		if ( ! empty( $image_data['url'] ) ) {
			return esc_url( $image_data['url'] );
		}
		if ( ! empty( $image_data['ID'] ) ) {
			$url = wp_get_attachment_image_url( $image_data['ID'], 'full' );
			if ( $url ) {
				return esc_url( $url );
			}
		}
	}

	if ( is_numeric( $image_data ) ) {
		$url = wp_get_attachment_image_url( (int) $image_data, 'full' );
		if ( $url ) {
			return esc_url( $url );
		}
	}

	if ( is_string( $image_data ) && filter_var( $image_data, FILTER_VALIDATE_URL ) ) {
		return esc_url( $image_data );
	}

	return '';
}

/**
 * 5. Filter Background Image Header Hestia (`hestia_header_image_filter`).
 * Berlaku untuk:
 * - Native Post Type Archive: Prestasi, Fasilitas, Kegiatan (diambil dari Options SCF, fallback ke Default)
 * - Single Page: Template Custom Archive & Template Default (diambil dari field page, fallback ke Option CPT / Default)
 * - Blog & Archive Default: diambil dari Option Default.
 *
 * @param string $image_url Default header image URL dari Hestia.
 * @return string Header image URL yang telah disesuaikan.
 */
function hestia_child_filter_archive_header_image( $image_url ) {
	$target_cpts = array( 'prestasi', 'fasilitas', 'kegiatan' );

	// Kasus A: Halaman Native Post Type Archive (Prestasi, Fasilitas, Kegiatan)
	if ( is_post_type_archive( $target_cpts ) ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		if ( empty( $post_type ) ) {
			$post_type = get_post_type();
		}

		if ( ! empty( $post_type ) ) {
			$bg = function_exists( 'get_field' ) ? get_field( "archive_{$post_type}_bg_image", 'option' ) : null;
			if ( empty( $bg ) ) {
				$bg = get_option( "options_archive_{$post_type}_bg_image" );
			}
			// Fallback ke Background Default jika kosong
			if ( empty( $bg ) ) {
				$bg = function_exists( 'get_field' ) ? get_field( 'archive_default_bg_image', 'option' ) : null;
				if ( empty( $bg ) ) {
					$bg = get_option( 'options_archive_default_bg_image' );
				}
			}
			$custom_bg = hestia_child_get_image_url( $bg );
			if ( ! empty( $custom_bg ) ) {
				return $custom_bg;
			}
		}
	}

	// Kasus B: Halaman Single Page (Template Custom Archive maupun Template Default)
	if ( is_page() ) {
		$page_id = get_queried_object_id();
		if ( ! $page_id ) {
			$page_id = get_the_ID();
		}

		// Prioritas 1: Background image spesifik halaman tersebut
		$bg = function_exists( 'get_field' ) ? get_field( 'archive_header_bg_image', $page_id ) : null;
		if ( empty( $bg ) ) {
			$bg = get_post_meta( $page_id, 'archive_header_bg_image', true );
		}

		// Prioritas 2: Jika halaman menggunakan Template Custom Archive, fallback ke Option CPT yang dipilih
		$template = get_post_meta( $page_id, '_wp_page_template', true );
		if ( empty( $bg ) && 'page-templates/template-archive-custom.php' === $template ) {
			$selected_pt = function_exists( 'hestia_child_get_selected_archive_post_type' )
				? hestia_child_get_selected_archive_post_type( $page_id )
				: get_post_meta( $page_id, 'archive_post_type', true );

			if ( ! empty( $selected_pt ) && in_array( $selected_pt, $target_cpts, true ) ) {
				$bg = function_exists( 'get_field' ) ? get_field( "archive_{$selected_pt}_bg_image", 'option' ) : null;
				if ( empty( $bg ) ) {
					$bg = get_option( "options_archive_{$selected_pt}_bg_image" );
				}
			}
		}

		// Prioritas 3: Fallback ke Background Default di Options SCF jika ada
		if ( empty( $bg ) ) {
			$bg = function_exists( 'get_field' ) ? get_field( 'archive_default_bg_image', 'option' ) : null;
			if ( empty( $bg ) ) {
				$bg = get_option( 'options_archive_default_bg_image' );
			}
		}

		$custom_bg = hestia_child_get_image_url( $bg );
		if ( ! empty( $custom_bg ) ) {
			return $custom_bg;
		}
	}

	// Kasus C: Halaman Blog Pos / Arsip Bawaan Lainnya
	if ( is_home() || is_archive() ) {
		$bg = function_exists( 'get_field' ) ? get_field( 'archive_default_bg_image', 'option' ) : null;
		if ( empty( $bg ) ) {
			$bg = get_option( 'options_archive_default_bg_image' );
		}
		$custom_bg = hestia_child_get_image_url( $bg );
		if ( ! empty( $custom_bg ) ) {
			return $custom_bg;
		}
	}

	return $image_url;
}
add_filter( 'hestia_header_image_filter', 'hestia_child_filter_archive_header_image', 20 );

/**
 * 6. Filter Custom Judul untuk Native CPT Archive & Default Archive (`get_the_archive_title`).
 *
 * @param string $title Judul archive bawaan.
 * @return string Judul yang telah disesuaikan.
 */
function hestia_child_filter_cpt_archive_title( $title ) {
	$target_cpts = array( 'prestasi', 'fasilitas', 'kegiatan' );

	if ( is_post_type_archive( $target_cpts ) ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		if ( empty( $post_type ) ) {
			$post_type = get_post_type();
		}

		if ( ! empty( $post_type ) ) {
			$custom_title = function_exists( 'get_field' ) ? get_field( "archive_{$post_type}_title", 'option' ) : null;
			if ( empty( $custom_title ) ) {
				$custom_title = get_option( "options_archive_{$post_type}_title" );
			}
			if ( ! empty( $custom_title ) ) {
				return esc_html( $custom_title );
			}
		}
	} elseif ( is_archive() || is_home() ) {
		$custom_title = function_exists( 'get_field' ) ? get_field( 'archive_default_title', 'option' ) : null;
		if ( empty( $custom_title ) ) {
			$custom_title = get_option( 'options_archive_default_title' );
		}
		if ( ! empty( $custom_title ) ) {
			return esc_html( $custom_title );
		}
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'hestia_child_filter_cpt_archive_title', 20 );

/**
 * 7. Filter Custom Deskripsi untuk Native CPT Archive & Default Archive (`get_the_archive_description`).
 *
 * @param string $description Deskripsi archive bawaan.
 * @return string Deskripsi yang telah disesuaikan.
 */
function hestia_child_filter_cpt_archive_description( $description ) {
	$target_cpts = array( 'prestasi', 'fasilitas', 'kegiatan' );

	if ( is_post_type_archive( $target_cpts ) ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		if ( empty( $post_type ) ) {
			$post_type = get_post_type();
		}

		if ( ! empty( $post_type ) ) {
			$custom_desc = function_exists( 'get_field' ) ? get_field( "archive_{$post_type}_description", 'option' ) : null;
			if ( empty( $custom_desc ) ) {
				$custom_desc = get_option( "options_archive_{$post_type}_description" );
			}
			if ( ! empty( $custom_desc ) ) {
				return wp_kses_post( $custom_desc );
			}
		}
	} elseif ( is_archive() || is_home() ) {
		$custom_desc = function_exists( 'get_field' ) ? get_field( 'archive_default_description', 'option' ) : null;
		if ( empty( $custom_desc ) ) {
			$custom_desc = get_option( 'options_archive_default_description' );
		}
		if ( ! empty( $custom_desc ) ) {
			return wp_kses_post( $custom_desc );
		}
	}

	return $description;
}
add_filter( 'get_the_archive_description', 'hestia_child_filter_cpt_archive_description', 20 );

/**
 * 8. Buffering Header untuk Single Page (Halaman Default maupun Custom Archive Template).
 * Mengganti judul banner jika custom judul diisi, serta menyisipkan `<h5 class="description">`
 * di bawah judul banner jika deskripsi diisi, persis seperti tampilan Hestia di arsip CPT.
 * Prioritas 8 (start) dan 12 (end) agar membungkus Hestia header (priority 10) dan Rank Math breadcrumbs (priority 9 & 11).
 */
function hestia_child_custom_archive_header_buffer_start() {
	if ( ! is_page() ) {
		return;
	}

	ob_start();
}
add_action( 'hestia_before_single_page_wrapper', 'hestia_child_custom_archive_header_buffer_start', 8 );

function hestia_child_custom_archive_header_buffer_end() {
	if ( ! is_page() ) {
		return;
	}

	if ( ob_get_level() > 0 ) {
		$header_html = ob_get_clean();

		$page_id = get_queried_object_id();
		if ( ! $page_id ) {
			$page_id = get_the_ID();
		}

		$target_cpts = array( 'prestasi', 'fasilitas', 'kegiatan' );
		$template    = get_post_meta( $page_id, '_wp_page_template', true );
		$selected_pt = function_exists( 'hestia_child_get_selected_archive_post_type' )
			? hestia_child_get_selected_archive_post_type( $page_id )
			: get_post_meta( $page_id, 'archive_post_type', true );

		// 1. Ambil Custom Judul
		$custom_title = function_exists( 'get_field' ) ? get_field( 'archive_header_title', $page_id ) : null;
		if ( empty( $custom_title ) ) {
			$custom_title = get_post_meta( $page_id, 'archive_header_title', true );
		}
		// Fallback untuk custom archive template ke option CPT
		if ( empty( $custom_title ) && 'page-templates/template-archive-custom.php' === $template && ! empty( $selected_pt ) && in_array( $selected_pt, $target_cpts, true ) ) {
			$custom_title = function_exists( 'get_field' ) ? get_field( "archive_{$selected_pt}_title", 'option' ) : null;
			if ( empty( $custom_title ) ) {
				$custom_title = get_option( "options_archive_{$selected_pt}_title" );
			}
		}

		// 2. Ambil Custom Deskripsi
		$custom_desc = function_exists( 'get_field' ) ? get_field( 'archive_header_description', $page_id ) : null;
		if ( empty( $custom_desc ) ) {
			$custom_desc = get_post_meta( $page_id, 'archive_header_description', true );
		}
		// Fallback untuk custom archive template ke option CPT
		if ( empty( $custom_desc ) && 'page-templates/template-archive-custom.php' === $template && ! empty( $selected_pt ) && in_array( $selected_pt, $target_cpts, true ) ) {
			$custom_desc = function_exists( 'get_field' ) ? get_field( "archive_{$selected_pt}_description", 'option' ) : null;
			if ( empty( $custom_desc ) ) {
				$custom_desc = get_option( "options_archive_{$selected_pt}_description" );
			}
		}

		// Terapkan Custom Judul ke dalam tag <h1 class="...hestia-title...">
		if ( ! empty( $custom_title ) ) {
			$header_html = preg_replace(
				'/(<h1[^>]*class=["\'][^"\']*hestia-title[^"\']*["\'][^>]*>)(.*?)(<\/h1>)/is',
				'${1}' . esc_html( $custom_title ) . '${3}',
				$header_html,
				1
			);
		}

		// Sisipkan Custom Deskripsi tepat setelah tag penutup </h1>
		if ( ! empty( $custom_desc ) ) {
			$desc_markup = '<h5 class="description">' . wp_kses_post( $custom_desc ) . '</h5>';
			$header_html = preg_replace(
				'/(<\/h1>)/i',
				'$1' . $desc_markup,
				$header_html,
				1
			);
		}

		echo $header_html;
	}
}
add_action( 'hestia_before_single_page_wrapper', 'hestia_child_custom_archive_header_buffer_end', 12 );

/**
 * 9. Ubah Class Grid Kolom Header dari "col-md-10 col-md-offset-1 text-center" menjadi "col-md-12"
 * untuk halaman Archive dan Single Page.
 */
function hestia_child_header_col12_buffer_start() {
	if ( is_archive() || is_page() ) {
		ob_start();
	}
}
add_action( 'hestia_before_archive_content', 'hestia_child_header_col12_buffer_start', 7 );
add_action( 'hestia_before_single_page_wrapper', 'hestia_child_header_col12_buffer_start', 7 );

function hestia_child_header_col12_buffer_end() {
	if ( is_archive() || is_page() ) {
		if ( ob_get_level() > 0 ) {
			$header_html = ob_get_clean();

			// Ubah class dari "col-md-10 col-md-offset-1 text-center" menjadi "col-md-12"
			$header_html = preg_replace(
				'/\bcol-md-10\s+col-md-offset-1\s+text-center\b/',
				'col-md-12',
				$header_html
			);

			// Fallback string replace
			$header_html = str_replace(
				'col-md-10 col-md-offset-1 text-center',
				'col-md-12',
				$header_html
			);

			echo $header_html;
		}
	}
}
add_action( 'hestia_before_archive_content', 'hestia_child_header_col12_buffer_end', 15 );
add_action( 'hestia_before_single_page_wrapper', 'hestia_child_header_col12_buffer_end', 15 );
