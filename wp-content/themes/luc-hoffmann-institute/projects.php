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

	<section class="Projects Projects--list">
		
		<div class="container">

			<header class="Projects-header">

				<nav class="Projects-menu">
					<ul>
						<li class="Projects-menu-select"><a href="#">All Projects <i class="icon-menu"></i></a></li>
						<li class="Projects-menu-select"><a href="#">All Themes <i class="icon-menu"></i></a></li>
						<li><a href="#"><i class="icon-search"></i> <span>Search</span></a></li>
					</ul>
				</nav>

			</header>
			
			<?php if ( $projects->have_posts() ) : ?>

				<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

       				<?php get_template_part( 'templates/project' ); ?>

				<?php endwhile ?>

			<?php endif ?>

			<?php wp_reset_postdata(); ?>

		</div>

	</section>

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>