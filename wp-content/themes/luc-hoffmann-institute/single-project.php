<?php 
/**
 * Template name: Projects: single
 */
get_header();
?>

	<section class="Projects Projects--single">
	
		<div class="container">

			<div class="Projects-header">
				<a class="Projects-home-link" href="<?php bloginfo('url') ?>/projects/"><i class="icon-layout"></i><span>Projects</span></a>
			</div>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/project-single' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .container -->

	</section><!-- .Projects.Projects--single -->

    <?php get_template_part( 'templates/page-footer' ); ?>

<?php get_footer(); ?>