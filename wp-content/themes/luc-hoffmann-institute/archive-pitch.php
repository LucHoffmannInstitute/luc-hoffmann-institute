<?php
get_header();

$page = get_page_by_title( 'pitches' );

$pitches = new WP_Query( array(
    'post_type' => 'pitch',
    'posts_per_page' => -1,
    'orderby' => 'post_date',
    'order' => 'DESC'
) );
?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="Page">

		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<nav class="submenu">
						<ul>
							<li class="active"><a href="<?php home_url() ?>/pitches/">Pitch site</a></li>
						</ul>
					</nav>

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">

						<?php if ( isset( $page ) && !empty( $page ) ) : ?>

							<?php if ( isset( $page->post_content ) && !empty( $page->post_content ) && $page->post_content !== '' ) : ?>

								<div class="entry">
									
									<div class="entry-content">
										<?php echo apply_filters( 'the_content', $page->post_content ) ?>
									</div>

									<hr>

								</div>

							<?php endif ?>

						<?php endif ?>
							
						<?php if ( $pitches->have_posts() ) : ?>

							<?php while ( $pitches->have_posts() ) : $pitches->the_post() ?>
		
								<?php get_template_part( 'templates/pitch' ); ?>

							<?php endwhile ?>

						<?php endif ?>

						<?php wp_reset_postdata(); ?>

					</div>

				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .container -->

    </div><!-- .Page -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>