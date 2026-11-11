<?php
/**
 * Single Post Classic Layout with Featured Image Integration.
 *
 * Configures single posts to use the classic layout (title & meta in content,
 * without the large header banner) and displays the Featured Image prominently
 * right above the post content.
 *
 * @package Hestia_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hestia_Child_Single_Post_Classic_Layout {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// 1. Set header layout to 'classic-blog' for single posts.
		add_filter( 'hestia_header_layout', array( $this, 'filter_single_post_header_layout' ), 30 );

		// 2. Render Rank Math breadcrumbs above the title in classic layout.
		add_action( 'hestia_before_single_post_content', array( $this, 'render_breadcrumbs' ), 5 );

		// 3. Render Featured Image directly above content.
		add_action( 'hestia_before_single_post_content', array( $this, 'render_featured_image' ), 20 );
	}

	/**
	 * Filter header layout to return 'classic-blog' on single posts.
	 *
	 * @param string $layout Current header layout.
	 * @return string
	 */
	public function filter_single_post_header_layout( $layout ) {
		if ( is_single() && ! is_singular( 'elementor_library' ) ) {
			return 'classic-blog';
		}
		return $layout;
	}

	/**
	 * Render Rank Math breadcrumbs above the post title in classic layout.
	 */
	public function render_breadcrumbs() {
		if ( ! is_single() || is_singular( 'elementor_library' ) ) {
			return;
		}

		if ( class_exists( 'Hestia_Child_Rank_Math_Breadcrumb' ) && Hestia_Child_Rank_Math_Breadcrumb::is_rank_math_active() ) {
			$breadcrumb = do_shortcode( '[rank_math_breadcrumb]' );
			if ( ! empty( $breadcrumb ) ) {
				echo '<div class="hestia-rank-math-breadcrumb-wrap classic-breadcrumb">' . $breadcrumb . '</div>';
			}
		}
	}

	/**
	 * Render the post's Featured Image above the post content.
	 */
	public function render_featured_image() {
		if ( ! is_single() || is_singular( 'elementor_library' ) ) {
			return;
		}

		if ( ! has_post_thumbnail() ) {
			return;
		}

		$thumb_id  = get_post_thumbnail_id();
		$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
		if ( empty( $thumb_alt ) ) {
			$thumb_alt = the_title_attribute( array( 'echo' => false ) );
		}
		$caption   = wp_get_attachment_caption( $thumb_id );
		?>
		<div class="single-post-featured-image-wrapper">
			<figure class="single-post-figure">
				<?php
				the_post_thumbnail(
					'full',
					array(
						'class'   => 'img-responsive single-post-featured-image',
						'loading' => 'eager',
						'alt'     => esc_attr( $thumb_alt ),
					)
				);
				?>
				<?php if ( ! empty( $caption ) ) : ?>
					<figcaption class="single-post-featured-caption text-muted">
						<?php echo esc_html( $caption ); ?>
					</figcaption>
				<?php endif; ?>
			</figure>
		</div>
		<?php
	}
}

new Hestia_Child_Single_Post_Classic_Layout();
