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

    <?php get_template_part( 'partials/partial', 'page-header' ) ?>

    <div class="page-content">

		<div class="container">
			
			<div class="cols">
				
				<div class="col col-4">

					<nav class="submenu">
						<ul>
							<li class="active"><a href="<?php home_url() ?>/pitches/">Pitches blog</a></li>
						</ul>
					</nav>

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">

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
	
							<?php get_template_part( 'partials/partial', 'pitch' ); ?>

						<?php endwhile ?>

					<?php endif ?>

					<?php wp_reset_postdata(); ?>

				</div><!-- .col.col-8 -->

			</div><!-- .cols -->

		</div><!-- .container -->

    </div><!-- .page-content -->

    <?php get_template_part( 'partials/partial', 'page-footer' ) ?>

<?php get_footer() ?>