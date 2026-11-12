<?php
/**
 * The template for displaying all single Fasilitas posts.
 *
 * Menggunakan struktur dan komponen template single post tema Hestia
 * dengan dukungan breadcrumb Rank Math dan related posts.
 *
 * @package Hestia_Child
 */

get_header();

/**
 * Render Hestia's native single post header with gradient/image background,
 * title, and Rank Math breadcrumb.
 */
do_action( 'hestia_before_single_post_wrapper' );
?>

<div class="<?php echo hestia_layout(); ?>">
	<div class="blog-post blog-post-wrapper">
		<div class="container">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'single' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
</div>

<?php
if ( ! is_singular( 'elementor_library' ) ) {
	do_action( 'hestia_blog_related_posts' );
}
?>
<?php get_footer(); ?>
