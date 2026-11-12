<?php
/**
 * Custom Archive Grid Page Template Functions & ACF Integration.
 *
 * Provides ACF field group and fallback meta box for selecting post type
 * on pages using the Custom Archive Grid template.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF Local Field Group for Custom Archive Template.
 */
function hestia_child_register_archive_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_custom_archive_settings',
			'title'                 => 'Pengaturan Template Arsip',
			'fields'                => array(
				array(
					'key'               => 'field_archive_post_type',
					'label'             => 'Pilih Post Type',
					'name'              => 'archive_post_type',
					'type'              => 'select',
					'instructions'      => 'Pilih jenis postingan (Post atau Custom Post Type) yang akan ditampilkan pada halaman arsip ini.',
					'required'          => 0,
					'choices'           => array(
						'post'      => 'Pos Blog / Berita (post)',
						'prestasi'  => 'Prestasi (prestasi)',
						'fasilitas' => 'Fasilitas (fasilitas)',
						'kegiatan'  => 'Kegiatan (kegiatan)',
					),
					'default_value'     => 'post',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 1,
					'ajax'              => 0,
					'return_format'     => 'value',
					'placeholder'       => 'Pilih post type...',
				),
				array(
					'key'          => 'field_archive_header_title',
					'label'        => 'Custom Judul Header',
					'name'         => 'archive_header_title',
					'type'         => 'text',
					'instructions' => 'Judul banner header halaman. Kosongkan untuk menggunakan judul halaman atau opsi default arsip post type terkait.',
					'wrapper'      => array( 'width' => '50' ),
					'placeholder'  => 'Contoh: Direktori Fasilitas Unggulan',
				),
				array(
					'key'           => 'field_archive_header_bg_image',
					'label'         => 'Custom Background Image Header',
					'name'          => 'archive_header_bg_image',
					'type'          => 'image',
					'instructions'  => 'Gambar latar belakang untuk banner header halaman ini. Kosongkan untuk menggunakan featured image atau background dari opsi arsip.',
					'wrapper'       => array( 'width' => '50' ),
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'mime_types'    => 'jpg, jpeg, png, webp',
				),
				array(
					'key'          => 'field_archive_header_description',
					'label'        => 'Custom Deskripsi Header',
					'name'         => 'archive_header_description',
					'type'         => 'textarea',
					'instructions' => 'Teks deskripsi / sub-judul yang tampil di bawah judul pada header banner. Kosongkan untuk menggunakan deskripsi default dari opsi arsip.',
					'wrapper'      => array( 'width' => '100' ),
					'placeholder'  => 'Tuliskan deskripsi singkat untuk halaman arsip ini...',
					'rows'         => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-templates/template-archive-custom.php',
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
add_action( 'acf/init', 'hestia_child_register_archive_acf_fields' );

/**
 * Dynamically populate choices in ACF post type dropdown with all available public post types.
 *
 * @param array $field ACF field array.
 * @return array
 */
function hestia_child_populate_archive_post_types( $field ) {
	$field['choices'] = array();

	$post_types = get_post_types(
		array(
			'public' => true,
		),
		'objects'
	);

	// Exclude non-content types like attachment and elementor
	$excluded = array( 'attachment', 'elementor_library', 'e-landing-page', 'revision', 'nav_menu_item' );

	foreach ( $post_types as $pt_name => $pt_obj ) {
		if ( in_array( $pt_name, $excluded, true ) ) {
			continue;
		}

		$label = ! empty( $pt_obj->labels->name ) ? $pt_obj->labels->name : $pt_name;
		$field['choices'][ $pt_name ] = sprintf( '%s (%s)', $label, $pt_name );
	}

	return $field;
}
add_filter( 'acf/load_field/name=archive_post_type', 'hestia_child_populate_archive_post_types' );

/**
 * Fallback native meta box if ACF is not active.
 */
function hestia_child_archive_fallback_meta_box() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	global $post;
	if ( ! $post ) {
		return;
	}

	$template = get_post_meta( $post->ID, '_wp_page_template', true );
	if ( 'page-templates/template-archive-custom.php' !== $template ) {
		return;
	}

	add_meta_box(
		'hestia_child_archive_pt_box',
		'Pengaturan Template Arsip',
		'hestia_child_render_archive_fallback_meta_box',
		'page',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'hestia_child_archive_fallback_meta_box' );

/**
 * Render fallback meta box.
 *
 * @param WP_Post $post Current post object.
 */
function hestia_child_render_archive_fallback_meta_box( $post ) {
	wp_nonce_field( 'hestia_child_archive_pt_action', 'hestia_child_archive_pt_nonce' );

	$current_pt    = get_post_meta( $post->ID, 'archive_post_type', true );
	if ( empty( $current_pt ) ) {
		$current_pt = 'post';
	}
	$current_title = get_post_meta( $post->ID, 'archive_header_title', true );
	$current_desc  = get_post_meta( $post->ID, 'archive_header_description', true );

	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	$excluded   = array( 'attachment', 'elementor_library', 'e-landing-page', 'revision', 'nav_menu_item' );

	echo '<p><label for="archive_post_type"><strong>Pilih Post Type:</strong></label></p>';
	echo '<select name="archive_post_type" id="archive_post_type" style="width:100%; padding:6px;">';
	foreach ( $post_types as $pt_name => $pt_obj ) {
		if ( in_array( $pt_name, $excluded, true ) ) {
			continue;
		}
		$label = ! empty( $pt_obj->labels->name ) ? $pt_obj->labels->name : $pt_name;
		echo '<option value="' . esc_attr( $pt_name ) . '" ' . selected( $current_pt, $pt_name, false ) . '>' . esc_html( $label . ' (' . $pt_name . ')' ) . '</option>';
	}
	echo '</select>';
	echo '<p class="description" style="margin-top:4px; font-size:12px;">Pilih post type yang akan ditampilkan di grid arsip halaman ini.</p>';

	echo '<p style="margin-top:15px;"><label for="archive_header_title"><strong>Custom Judul Header:</strong></label></p>';
	echo '<input type="text" name="archive_header_title" id="archive_header_title" value="' . esc_attr( $current_title ) . '" style="width:100%; padding:6px;" placeholder="Kosongkan untuk judul bawaan" />';

	echo '<p style="margin-top:15px;"><label for="archive_header_description"><strong>Custom Deskripsi Header:</strong></label></p>';
	echo '<textarea name="archive_header_description" id="archive_header_description" rows="3" style="width:100%; padding:6px;" placeholder="Teks deskripsi di bawah judul header">' . esc_textarea( $current_desc ) . '</textarea>';
}

/**
 * Save fallback meta box.
 *
 * @param int $post_id Post ID.
 */
function hestia_child_save_archive_fallback_meta_box( $post_id ) {
	if ( ! isset( $_POST['hestia_child_archive_pt_nonce'] ) || ! wp_verify_nonce( $_POST['hestia_child_archive_pt_nonce'], 'hestia_child_archive_pt_action' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['archive_post_type'] ) ) {
		update_post_meta( $post_id, 'archive_post_type', sanitize_text_field( $_POST['archive_post_type'] ) );
	}
	if ( isset( $_POST['archive_header_title'] ) ) {
		update_post_meta( $post_id, 'archive_header_title', sanitize_text_field( $_POST['archive_header_title'] ) );
	}
	if ( isset( $_POST['archive_header_description'] ) ) {
		update_post_meta( $post_id, 'archive_header_description', sanitize_textarea_field( $_POST['archive_header_description'] ) );
	}
}
add_action( 'save_post_page', 'hestia_child_save_archive_fallback_meta_box' );

/**
 * Helper to get the selected archive post type for a page.
 *
 * @param int|null $page_id Page ID.
 * @return string
 */
function hestia_child_get_selected_archive_post_type( $page_id = null ) {
	if ( ! $page_id ) {
		$page_id = get_the_ID();
	}

	$post_type = '';

	// Try ACF first
	if ( function_exists( 'get_field' ) ) {
		$post_type = get_field( 'archive_post_type', $page_id );
	}

	// Fallback to post_meta
	if ( empty( $post_type ) ) {
		$post_type = get_post_meta( $page_id, 'archive_post_type', true );
	}

	if ( empty( $post_type ) ) {
		$post_type = 'post';
	}

	return $post_type;
}
