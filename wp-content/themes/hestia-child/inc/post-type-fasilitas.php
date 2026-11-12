<?php
/**
 * Register Custom Post Type Fasilitas & Kategori Fasilitas Taxonomy.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Post Type: Fasilitas.
 */
function hestia_child_register_cpt_fasilitas() {
	$labels = array(
		'name'                  => _x( 'Fasilitas', 'Post Type General Name', 'hestia-child' ),
		'singular_name'         => _x( 'Fasilitas', 'Post Type Singular Name', 'hestia-child' ),
		'menu_name'             => __( 'Fasilitas', 'hestia-child' ),
		'name_admin_bar'        => __( 'Fasilitas', 'hestia-child' ),
		'archives'              => __( 'Arsip Fasilitas', 'hestia-child' ),
		'attributes'            => __( 'Atribut Fasilitas', 'hestia-child' ),
		'parent_item_colon'     => __( 'Induk Fasilitas:', 'hestia-child' ),
		'all_items'             => __( 'Semua Fasilitas', 'hestia-child' ),
		'add_new_item'          => __( 'Tambah Fasilitas Baru', 'hestia-child' ),
		'add_new'               => __( 'Tambah Baru', 'hestia-child' ),
		'new_item'              => __( 'Fasilitas Baru', 'hestia-child' ),
		'edit_item'             => __( 'Edit Fasilitas', 'hestia-child' ),
		'update_item'           => __( 'Perbarui Fasilitas', 'hestia-child' ),
		'view_item'             => __( 'Lihat Fasilitas', 'hestia-child' ),
		'view_items'            => __( 'Lihat Semua Fasilitas', 'hestia-child' ),
		'search_items'          => __( 'Cari Fasilitas', 'hestia-child' ),
		'not_found'             => __( 'Fasilitas tidak ditemukan', 'hestia-child' ),
		'not_found_in_trash'    => __( 'Tidak ada fasilitas di kotak sampah', 'hestia-child' ),
		'featured_image'        => __( 'Foto / Gambar Fasilitas', 'hestia-child' ),
		'set_featured_image'    => __( 'Pilih foto fasilitas', 'hestia-child' ),
		'remove_featured_image' => __( 'Hapus foto fasilitas', 'hestia-child' ),
		'use_featured_image'    => __( 'Gunakan sebagai foto fasilitas', 'hestia-child' ),
		'insert_into_item'      => __( 'Sisipkan ke Fasilitas', 'hestia-child' ),
		'uploaded_to_this_item' => __( 'Diunggah ke fasilitas ini', 'hestia-child' ),
		'items_list'            => __( 'Daftar Fasilitas', 'hestia-child' ),
		'items_list_navigation' => __( 'Navigasi daftar fasilitas', 'hestia-child' ),
		'filter_items_list'     => __( 'Saring daftar fasilitas', 'hestia-child' ),
	);

	$args = array(
		'label'                 => __( 'Fasilitas', 'hestia-child' ),
		'description'           => __( 'Post Type untuk informasi sarana dan prasarana madrasah', 'hestia-child' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields', 'comments' ),
		'taxonomies'            => array( 'kategori_fasilitas', 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-building',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rewrite'               => array(
			'slug'       => 'fasilitas',
			'with_front' => false,
		),
	);

	register_post_type( 'fasilitas', $args );
}
add_action( 'init', 'hestia_child_register_cpt_fasilitas', 0 );

/**
 * Register Custom Taxonomy: Kategori Fasilitas.
 */
function hestia_child_register_taxonomy_kategori_fasilitas() {
	$labels = array(
		'name'                       => _x( 'Kategori Fasilitas', 'Taxonomy General Name', 'hestia-child' ),
		'singular_name'              => _x( 'Kategori Fasilitas', 'Taxonomy Singular Name', 'hestia-child' ),
		'menu_name'                  => __( 'Kategori Fasilitas', 'hestia-child' ),
		'all_items'                  => __( 'Semua Kategori', 'hestia-child' ),
		'parent_item'                => __( 'Induk Kategori', 'hestia-child' ),
		'parent_item_colon'          => __( 'Induk Kategori:', 'hestia-child' ),
		'new_item_name'              => __( 'Nama Kategori Baru', 'hestia-child' ),
		'add_new_item'               => __( 'Tambah Kategori Fasilitas Baru', 'hestia-child' ),
		'edit_item'                  => __( 'Edit Kategori Fasilitas', 'hestia-child' ),
		'update_item'                => __( 'Perbarui Kategori Fasilitas', 'hestia-child' ),
		'view_item'                  => __( 'Lihat Kategori', 'hestia-child' ),
		'separate_items_with_commas' => __( 'Pisahkan kategori dengan koma', 'hestia-child' ),
		'add_or_remove_items'        => __( 'Tambah atau hapus kategori', 'hestia-child' ),
		'choose_from_most_used'      => __( 'Pilih dari yang sering digunakan', 'hestia-child' ),
		'popular_items'              => __( 'Kategori Populer', 'hestia-child' ),
		'search_items'               => __( 'Cari Kategori Fasilitas', 'hestia-child' ),
		'not_found'                  => __( 'Tidak ditemukan', 'hestia-child' ),
		'no_terms'                   => __( 'Belum ada kategori', 'hestia-child' ),
		'items_list'                 => __( 'Daftar Kategori Fasilitas', 'hestia-child' ),
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
			'slug'         => 'kategori-fasilitas',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'kategori_fasilitas', array( 'fasilitas' ), $args );
}
add_action( 'init', 'hestia_child_register_taxonomy_kategori_fasilitas', 0 );

/**
 * Flush rewrite rules once upon registration so the new post type URLs work immediately.
 */
function hestia_child_fasilitas_rewrite_flush() {
	if ( get_option( 'hestia_child_fasilitas_flushed_v1' ) !== 'yes' ) {
		flush_rewrite_rules( false );
		update_option( 'hestia_child_fasilitas_flushed_v1', 'yes' );
	}
}
add_action( 'init', 'hestia_child_fasilitas_rewrite_flush', 99 );
