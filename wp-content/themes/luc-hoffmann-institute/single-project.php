<?php 
/**
 * Template name: Projects: single
 */
get_header();
?>

	<div class="Single-project page-content">
		
		<div class="container">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
			
					<header class="Single-project-header">
						<h1 class="Single-project-title"><?php the_title(); ?></h1>
					</header>

					<div class="Single-project-content">
						<?php the_content() ?>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .container -->

	</div><!-- .Single-project.page-content -->

    <?php get_template_part( 'templates/page-footer' ); ?>

<?php get_footer(); ?>