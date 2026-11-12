<?php
/**
 * The template for displaying Kegiatan post type archive.
 *
 * Menampilkan grid kartu 3-kolom modern untuk arsip Kegiatan,
 * konsisten dengan Page Template Custom Archive Grid.
 *
 * @package Hestia_Child
 */

get_header();

/**
 * Render Hestia's native archive header with gradient/image background,
 * title, and Rank Math breadcrumb.
 */
do_action( 'hestia_before_archive_content' );
?>

<div class="<?php echo hestia_layout(); ?>">
	<div class="hestia-blogs custom-archive-blogs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					if ( have_posts() ) :
						?>
						<div class="row custom-archive-grid">
							<?php
							while ( have_posts() ) :
								the_post();
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
													<div class="custom-card-placeholder">
														<i class="fa fa-calendar" aria-hidden="true"></i>
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
						// Pagination matching existing Hestia / custom archive styles
						global $wp_query;
						$total_pages = $wp_query->max_num_pages;
						if ( $total_pages > 1 ) :
							$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
							$big   = 999999999;
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

					<?php else : ?>
						<div class="custom-archive-empty text-center">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<h4><?php esc_html_e( 'Belum Ada Kegiatan', 'hestia-child' ); ?></h4>
							<p class="text-muted"><?php esc_html_e( 'Belum ada data kegiatan yang dipublikasikan.', 'hestia-child' ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
