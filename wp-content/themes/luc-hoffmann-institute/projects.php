<?php 
/**
 * Template name: Projects: index
 */
get_header();

$projects = new WP_Query( array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'DESC'
) );

?>

    <div class="page-content">

    	<section class="Projects">
    		
			<div class="container">
				
				<?php if ( $projects->have_posts() ) : ?>

					<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

	       				<?php get_template_part( 'templates/projects-item' ); ?>

					<?php endwhile ?>

				<?php endif ?>

				<?php wp_reset_postdata(); ?>

			</div>

    	</section>

    </div><!-- .page-content -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>