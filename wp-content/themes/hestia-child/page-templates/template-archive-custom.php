<?php
/**
 * Template Name: Archive Grid (Custom Post Type)
 * Template Post Type: page
 *
 * Custom archive template displaying a 3-column card grid of posts or any custom post type
 * selected via ACF, with native Hestia header, Rank Math breadcrumbs, and pagination.
 *
 * @package Hestia_Child
 */

get_header();

/**
 * Render Hestia's native page header with gradient/image background,
 * title, and Rank Math breadcrumb.
 */
do_action( 'hestia_before_single_page_wrapper' );
?>

<div class="<?php echo hestia_layout(); ?>">
	<div class="hestia-blogs custom-archive-blogs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					// 1. Get selected post type from ACF (fallback to meta or 'post')
					$selected_post_type = function_exists( 'hestia_child_get_selected_archive_post_type' )
						? hestia_child_get_selected_archive_post_type( get_the_ID() )
						: 'post';

					// 2. Determine paged value for pagination
					if ( get_query_var( 'paged' ) ) {
						$paged = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) {
						$paged = get_query_var( 'page' );
					} else {
						$paged = 1;
					}

					// 3. Posts per page from WordPress Reading settings
					$posts_per_page = (int) get_option( 'posts_per_page', 10 );

					// 4. Query posts
					$archive_args = array(
						'post_type'      => $selected_post_type,
						'post_status'    => 'publish',
						'posts_per_page' => $posts_per_page,
						'paged'          => $paged,
					);

					$archive_query = new WP_Query( $archive_args );

					if ( $archive_query->have_posts() ) :
						?>
						<div class="row custom-archive-grid">
							<?php
							while ( $archive_query->have_posts() ) :
								$archive_query->the_post();
								$item_id = get_the_ID();

								// Determine badge (category or taxonomy term)
								$badge_name = '';
								$taxonomies = get_object_taxonomies( get_post_type(), 'objects' );
								if ( ! empty( $taxonomies ) ) {
									foreach ( $taxonomies as $tax_slug => $tax_obj ) {
										if ( ! $tax_obj->public ) {
											continue;
										}
										$terms = get_the_terms( $item_id, $tax_slug );
										if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
											$badge_name = $terms[0]->name;
											break;
										}
									}
								}
								if ( empty( $badge_name ) && 'post' === get_post_type() ) {
									$cats = get_the_category( $item_id );
									if ( ! empty( $cats ) ) {
										$badge_name = $cats[0]->name;
									}
								}
								?>
								<div class="col-md-4 col-sm-6 col-xs-12 custom-archive-col">
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'custom-archive-card' ); ?>>
										<div class="custom-card-thumb">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php if ( has_post_thumbnail() ) : ?>
													<?php the_post_thumbnail( 'medium_large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
												<?php else : ?>
													<?php
													$placeholder_icon = 'fa-picture-o';
													if ( 'prestasi' === $selected_post_type ) {
														$placeholder_icon = 'fa-trophy';
													} elseif ( 'fasilitas' === $selected_post_type ) {
														$placeholder_icon = 'fa-building-o';
													} elseif ( 'kegiatan' === $selected_post_type ) {
														$placeholder_icon = 'fa-calendar';
													}
													?>
													<div class="custom-card-placeholder">
														<i class="fa <?php echo esc_attr( $placeholder_icon ); ?>" aria-hidden="true"></i>
													</div>
												<?php endif; ?>
											</a>
										</div>
										<div class="custom-card-body">
											<?php if ( ! empty( $badge_name ) ) : ?>
												<div class="custom-card-badge-wrap">
													<span class="custom-card-badge"><?php echo esc_html( $badge_name ); ?></span>
												</div>
											<?php endif; ?>

											<h3 class="custom-card-title">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php the_title(); ?>
												</a>
											</h3>

											<div class="custom-card-excerpt">
												<p><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
											</div>

											<div class="custom-card-meta">
												<span class="custom-card-author">
													<i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php the_author(); ?>
												</span>
												<span class="custom-card-sep">&bull;</span>
												<span class="custom-card-date">
													<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?>
												</span>
											</div>
										</div>
									</article>
								</div>
							<?php endwhile; ?>
						</div>

						<?php
						// Pagination matching existing Hestia styles
						$total_pages = $archive_query->max_num_pages;
						if ( $total_pages > 1 ) :
							$big = 999999999;
							$pagination_links = paginate_links(
								array(
									'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format'    => '?paged=%#%',
									'current'   => max( 1, $paged ),
									'total'     => $total_pages,
									'type'      => 'plain',
									'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
									'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
								)
							);
							?>
							<div class="row">
								<div class="col-md-12 text-center custom-archive-pagination-wrap">
									<?php do_action( 'hestia_before_pagination' ); ?>
									<nav class="navigation pagination" role="navigation">
										<div class="nav-links">
											<?php echo $pagination_links; ?>
										</div>
									</nav>
									<?php do_action( 'hestia_after_pagination' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<?php
						$empty_icon  = 'fa-folder-open-o';
						$empty_title = __( 'Belum Ada Konten', 'hestia-child' );
						$empty_desc  = __( 'Belum ada postingan yang dipublikasikan untuk kategori/post type ini.', 'hestia-child' );

						if ( 'prestasi' === $selected_post_type ) {
							$empty_icon  = 'fa-trophy';
							$empty_title = __( 'Belum Ada Prestasi', 'hestia-child' );
							$empty_desc  = __( 'Belum ada data prestasi yang dipublikasikan.', 'hestia-child' );
						} elseif ( 'fasilitas' === $selected_post_type ) {
							$empty_icon  = 'fa-building-o';
							$empty_title = __( 'Belum Ada Fasilitas', 'hestia-child' );
							$empty_desc  = __( 'Belum ada data fasilitas yang dipublikasikan.', 'hestia-child' );
						} elseif ( 'kegiatan' === $selected_post_type ) {
							$empty_icon  = 'fa-calendar';
							$empty_title = __( 'Belum Ada Kegiatan', 'hestia-child' );
							$empty_desc  = __( 'Belum ada data kegiatan yang dipublikasikan.', 'hestia-child' );
						}
						?>
						<div class="custom-archive-empty text-center">
							<i class="fa <?php echo esc_attr( $empty_icon ); ?>" aria-hidden="true"></i>
							<h4><?php echo esc_html( $empty_title ); ?></h4>
							<p class="text-muted"><?php echo esc_html( $empty_desc ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
