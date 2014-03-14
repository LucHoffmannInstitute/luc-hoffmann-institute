<?php  
/**
 * The pitch arcive
 */

get_header();

$page = get_page_by_title( 'pitches' );

$pitches = new WP_Query( array(
    'post_type' => 'pitch',
    'posts_per_page' => -1,
    'orderby' => 'post_date',
    'order' => 'DESC'
) );
?>

<section class="Page Archive Archive--pitches">
	
	<div class="u-container">
		
		<div class="u-cols">
			
			<div class="u-col u-col-4of12">

				<?php get_template_part('templates/pitch-menu') ?>

				<?php get_sidebar() ?>

			</div>

			<div class="u-col u-col-8of12">

				<div class="Page-content">

					<?php if ( isset( $page ) && !empty( $page ) ) : ?>

						<?php if ( isset( $page->post_content ) && !empty( $page->post_content ) && $page->post_content !== '' ) : ?>

							<article class="Article Entry">
								
								<?php echo apply_filters( 'the_content', $page->post_content ) ?>

								<hr>

							</article>

						<?php endif ?>

					<?php endif ?>
					
					<?php if ( $pitches->have_posts() ) : ?>

						<?php while ( $pitches->have_posts() ) : $pitches->the_post() ?>
	
							<?php get_template_part( 'templates/pitch' ); ?>

						<?php endwhile ?>

					<?php endif ?>

					<?php wp_reset_postdata(); ?>

				</div><!-- .Page-content -->

				<footer class="Page-footer">

					<?php hoffmann_paginate() ?>

				</footer>

			</div><!-- .u-col -->

		</div><!-- .u-cols -->

	</div><!-- .u-container -->

</section><!-- .Page -->

<?php get_footer() ?>