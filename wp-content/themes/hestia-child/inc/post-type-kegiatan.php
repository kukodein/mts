<?php
/**
 * Register Custom Post Type Kegiatan & Kategori Kegiatan Taxonomy.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Post Type: Kegiatan.
 */
function hestia_child_register_cpt_kegiatan() {
	$labels = array(
		'name'                  => _x( 'Kegiatan', 'Post Type General Name', 'hestia-child' ),
		'singular_name'         => _x( 'Kegiatan', 'Post Type Singular Name', 'hestia-child' ),
		'menu_name'             => __( 'Kegiatan', 'hestia-child' ),
		'name_admin_bar'        => __( 'Kegiatan', 'hestia-child' ),
		'archives'              => __( 'Arsip Kegiatan', 'hestia-child' ),
		'attributes'            => __( 'Atribut Kegiatan', 'hestia-child' ),
		'parent_item_colon'     => __( 'Induk Kegiatan:', 'hestia-child' ),
		'all_items'             => __( 'Semua Kegiatan', 'hestia-child' ),
		'add_new_item'          => __( 'Tambah Kegiatan Baru', 'hestia-child' ),
		'add_new'               => __( 'Tambah Baru', 'hestia-child' ),
		'new_item'              => __( 'Kegiatan Baru', 'hestia-child' ),
		'edit_item'             => __( 'Edit Kegiatan', 'hestia-child' ),
		'update_item'           => __( 'Perbarui Kegiatan', 'hestia-child' ),
		'view_item'             => __( 'Lihat Kegiatan', 'hestia-child' ),
		'view_items'            => __( 'Lihat Semua Kegiatan', 'hestia-child' ),
		'search_items'          => __( 'Cari Kegiatan', 'hestia-child' ),
		'not_found'             => __( 'Kegiatan tidak ditemukan', 'hestia-child' ),
		'not_found_in_trash'    => __( 'Tidak ada kegiatan di kotak sampah', 'hestia-child' ),
		'featured_image'        => __( 'Foto / Gambar Kegiatan', 'hestia-child' ),
		'set_featured_image'    => __( 'Pilih foto kegiatan', 'hestia-child' ),
		'remove_featured_image' => __( 'Hapus foto kegiatan', 'hestia-child' ),
		'use_featured_image'    => __( 'Gunakan sebagai foto kegiatan', 'hestia-child' ),
		'insert_into_item'      => __( 'Sisipkan ke Kegiatan', 'hestia-child' ),
		'uploaded_to_this_item' => __( 'Diunggah ke kegiatan ini', 'hestia-child' ),
		'items_list'            => __( 'Daftar Kegiatan', 'hestia-child' ),
		'items_list_navigation' => __( 'Navigasi daftar kegiatan', 'hestia-child' ),
		'filter_items_list'     => __( 'Saring daftar kegiatan', 'hestia-child' ),
	);

	$args = array(
		'label'                 => __( 'Kegiatan', 'hestia-child' ),
		'description'           => __( 'Post Type untuk agenda, dokumentasi, dan aktivitas madrasah', 'hestia-child' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields', 'comments' ),
		'taxonomies'            => array( 'kategori_kegiatan', 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rewrite'               => array(
			'slug'       => 'kegiatan',
			'with_front' => false,
		),
	);

	register_post_type( 'kegiatan', $args );
}
add_action( 'init', 'hestia_child_register_cpt_kegiatan', 0 );

/**
 * Register Custom Taxonomy: Kategori Kegiatan.
 */
function hestia_child_register_taxonomy_kategori_kegiatan() {
	$labels = array(
		'name'                       => _x( 'Kategori Kegiatan', 'Taxonomy General Name', 'hestia-child' ),
		'singular_name'              => _x( 'Kategori Kegiatan', 'Taxonomy Singular Name', 'hestia-child' ),
		'menu_name'                  => __( 'Kategori Kegiatan', 'hestia-child' ),
		'all_items'                  => __( 'Semua Kategori', 'hestia-child' ),
		'parent_item'                => __( 'Induk Kategori', 'hestia-child' ),
		'parent_item_colon'          => __( 'Induk Kategori:', 'hestia-child' ),
		'new_item_name'              => __( 'Nama Kategori Baru', 'hestia-child' ),
		'add_new_item'               => __( 'Tambah Kategori Kegiatan Baru', 'hestia-child' ),
		'edit_item'                  => __( 'Edit Kategori Kegiatan', 'hestia-child' ),
		'update_item'                => __( 'Perbarui Kategori Kegiatan', 'hestia-child' ),
		'view_item'                  => __( 'Lihat Kategori', 'hestia-child' ),
		'separate_items_with_commas' => __( 'Pisahkan kategori dengan koma', 'hestia-child' ),
		'add_or_remove_items'        => __( 'Tambah atau hapus kategori', 'hestia-child' ),
		'choose_from_most_used'      => __( 'Pilih dari yang sering digunakan', 'hestia-child' ),
		'popular_items'              => __( 'Kategori Populer', 'hestia-child' ),
		'search_items'               => __( 'Cari Kategori Kegiatan', 'hestia-child' ),
		'not_found'                  => __( 'Tidak ditemukan', 'hestia-child' ),
		'no_terms'                   => __( 'Belum ada kategori', 'hestia-child' ),
		'items_list'                 => __( 'Daftar Kategori Kegiatan', 'hestia-child' ),
		'items_list_navigation'      => __( 'Navigasi daftar kategori', 'hestia-child' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
		'rewrite'                    => array(
			'slug'         => 'kategori-kegiatan',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'kategori_kegiatan', array( 'kegiatan' ), $args );
}
add_action( 'init', 'hestia_child_register_taxonomy_kategori_kegiatan', 0 );

/**
 * Flush rewrite rules once upon registration so the new post type URLs work immediately.
 */
function hestia_child_kegiatan_rewrite_flush() {
	if ( get_option( 'hestia_child_kegiatan_flushed_v1' ) !== 'yes' ) {
		flush_rewrite_rules( false );
		update_option( 'hestia_child_kegiatan_flushed_v1', 'yes' );
	}
}
add_action( 'init', 'hestia_child_kegiatan_rewrite_flush', 99 );
