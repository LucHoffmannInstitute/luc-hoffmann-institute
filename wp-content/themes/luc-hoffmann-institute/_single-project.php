<?php
/**
 * Single project page
 */
get_header();
?>

	<section class="Projects Projects--single">
	
		<div class="u-container">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/project-single' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .u-container -->

	</section><!-- .Projects -->

    <?php get_template_part( 'templates/page-footer' ); ?>

<?php get_footer(); ?>