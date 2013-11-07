<?php 
/**
 * Template name: Pitches: index
 */
get_header();

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

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">
						
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