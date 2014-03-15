<?php 
/**
 * The project archive
 */
get_header();

$projects = new WP_Query( array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'post_parent' => 0,
    'orderby' => 'menu_order',
    'order' => 'DESC'
) );

?>

	<section class="Projects Projects--list">
		
		<div class="u-container">

			<header class="Projects-header">

				<nav class="Filter-menu Filter-menu--dark">
					<ul>
						<li class="Filter-menu-select">
							<a href="#"><span>All Projects</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Filter-menu-select">
							<a href="#"><span>All Themes</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Filter-menu-search">
							<a href="#"><i class="icon-search"></i> <span>Search</span></a>
						</li>
					</ul>
				</nav>

			</header>

			<div>
			
				<?php if ( $projects->have_posts() ) : ?>

					<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

	       				<?php get_template_part( 'templates/project' ); ?>

					<?php endwhile ?>

				<?php endif ?>

			</div>

			<?php wp_reset_postdata(); ?>

		</div>

	</section>

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>