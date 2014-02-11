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

    <div class="page-content">

		<section class="Projects-list">

			<div class="container">
								
				<?php if ( $projects->have_posts() ) : ?>

					<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

						<?php get_template_part( 'templates/projects-list-item' ); ?>

					<?php endwhile ?>

				<?php endif ?>

				<?php wp_reset_postdata(); ?>

			</div><!-- .container -->

		</section>

    </div><!-- .page-content -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>