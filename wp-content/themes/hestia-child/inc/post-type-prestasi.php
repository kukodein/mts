<?php
/**
 * Register Custom Post Type Prestasi & Kategori Prestasi Taxonomy.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Post Type: Prestasi.
 */
function hestia_child_register_cpt_prestasi() {
	$labels = array(
		'name'                  => _x( 'Prestasi', 'Post Type General Name', 'hestia-child' ),
		'singular_name'         => _x( 'Prestasi', 'Post Type Singular Name', 'hestia-child' ),
		'menu_name'             => __( 'Prestasi', 'hestia-child' ),
		'name_admin_bar'        => __( 'Prestasi', 'hestia-child' ),
		'archives'              => __( 'Arsip Prestasi', 'hestia-child' ),
		'attributes'            => __( 'Atribut Prestasi', 'hestia-child' ),
		'parent_item_colon'     => __( 'Induk Prestasi:', 'hestia-child' ),
		'all_items'             => __( 'Semua Prestasi', 'hestia-child' ),
		'add_new_item'          => __( 'Tambah Prestasi Baru', 'hestia-child' ),
		'add_new'               => __( 'Tambah Baru', 'hestia-child' ),
		'new_item'              => __( 'Prestasi Baru', 'hestia-child' ),
		'edit_item'             => __( 'Edit Prestasi', 'hestia-child' ),
		'update_item'           => __( 'Perbarui Prestasi', 'hestia-child' ),
		'view_item'             => __( 'Lihat Prestasi', 'hestia-child' ),
		'view_items'            => __( 'Lihat Semua Prestasi', 'hestia-child' ),
		'search_items'          => __( 'Cari Prestasi', 'hestia-child' ),
		'not_found'             => __( 'Prestasi tidak ditemukan', 'hestia-child' ),
		'not_found_in_trash'    => __( 'Tidak ada prestasi di kotak sampah', 'hestia-child' ),
		'featured_image'        => __( 'Foto / Gambar Prestasi', 'hestia-child' ),
		'set_featured_image'    => __( 'Pilih foto prestasi', 'hestia-child' ),
		'remove_featured_image' => __( 'Hapus foto prestasi', 'hestia-child' ),
		'use_featured_image'    => __( 'Gunakan sebagai foto prestasi', 'hestia-child' ),
		'insert_into_item'      => __( 'Sisipkan ke Prestasi', 'hestia-child' ),
		'uploaded_to_this_item' => __( 'Diunggah ke prestasi ini', 'hestia-child' ),
		'items_list'            => __( 'Daftar Prestasi', 'hestia-child' ),
		'items_list_navigation' => __( 'Navigasi daftar prestasi', 'hestia-child' ),
		'filter_items_list'     => __( 'Saring daftar prestasi', 'hestia-child' ),
	);

	$args = array(
		'label'                 => __( 'Prestasi', 'hestia-child' ),
		'description'           => __( 'Post Type untuk data dan artikel prestasi siswa dan madrasah', 'hestia-child' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields', 'comments' ),
		'taxonomies'            => array( 'kategori_prestasi', 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rewrite'               => array(
			'slug'       => 'prestasi',
			'with_front' => false,
		),
	);

	register_post_type( 'prestasi', $args );
}
add_action( 'init', 'hestia_child_register_cpt_prestasi', 0 );

/**
 * Register Custom Taxonomy: Kategori Prestasi.
 */
function hestia_child_register_taxonomy_kategori_prestasi() {
	$labels = array(
		'name'                       => _x( 'Kategori Prestasi', 'Taxonomy General Name', 'hestia-child' ),
		'singular_name'              => _x( 'Kategori Prestasi', 'Taxonomy Singular Name', 'hestia-child' ),
		'menu_name'                  => __( 'Kategori Prestasi', 'hestia-child' ),
		'all_items'                  => __( 'Semua Kategori', 'hestia-child' ),
		'parent_item'                => __( 'Induk Kategori', 'hestia-child' ),
		'parent_item_colon'          => __( 'Induk Kategori:', 'hestia-child' ),
		'new_item_name'              => __( 'Nama Kategori Baru', 'hestia-child' ),
		'add_new_item'               => __( 'Tambah Kategori Prestasi Baru', 'hestia-child' ),
		'edit_item'                  => __( 'Edit Kategori Prestasi', 'hestia-child' ),
		'update_item'                => __( 'Perbarui Kategori Prestasi', 'hestia-child' ),
		'view_item'                  => __( 'Lihat Kategori', 'hestia-child' ),
		'separate_items_with_commas' => __( 'Pisahkan kategori dengan koma', 'hestia-child' ),
		'add_or_remove_items'        => __( 'Tambah atau hapus kategori', 'hestia-child' ),
		'choose_from_most_used'      => __( 'Pilih dari yang sering digunakan', 'hestia-child' ),
		'popular_items'              => __( 'Kategori Populer', 'hestia-child' ),
		'search_items'               => __( 'Cari Kategori Prestasi', 'hestia-child' ),
		'not_found'                  => __( 'Tidak ditemukan', 'hestia-child' ),
		'no_terms'                   => __( 'Belum ada kategori', 'hestia-child' ),
		'items_list'                 => __( 'Daftar Kategori Prestasi', 'hestia-child' ),
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
			'slug'         => 'kategori-prestasi',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'kategori_prestasi', array( 'prestasi' ), $args );
}
add_action( 'init', 'hestia_child_register_taxonomy_kategori_prestasi', 0 );

/**
 * Flush rewrite rules once upon registration so the new post type URLs work immediately.
 */
function hestia_child_prestasi_rewrite_flush() {
	if ( get_option( 'hestia_child_prestasi_flushed_v1' ) !== 'yes' ) {
		flush_rewrite_rules( false );
		update_option( 'hestia_child_prestasi_flushed_v1', 'yes' );
	}
}
add_action( 'init', 'hestia_child_prestasi_rewrite_flush', 99 );
