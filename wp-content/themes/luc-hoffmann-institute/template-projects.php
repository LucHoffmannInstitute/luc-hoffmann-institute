<?php 
/**
 * Template name: Projects: index
 */
get_header();

$projects = new WP_Query( array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
) );
?>

	<?php get_template_part( 'templates/page-header' ) ?>

    <div class="page-content">

    	<section class="projects">
						
			<?php if ( $projects->have_posts() ) : ?>

				<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

					<?php get_template_part( 'templates/project' ); ?>

				<?php endwhile ?>

			<?php endif ?>

			<?php wp_reset_postdata(); ?>

		</section>

    </div><!-- .page-content -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>