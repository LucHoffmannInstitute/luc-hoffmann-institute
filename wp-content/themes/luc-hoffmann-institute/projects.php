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

TEST TEST TEST

	<section class="Projects Projects--list">
		
		<div class="container">

			<header class="Projects-header">

				<nav class="Projects-menu">
					<ul>
						<li class="Projects-menu-select">
							<a href="#"><span>All Projects</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Projects-menu-select">
							<a href="#"><span>All Themes</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Projects-menu-search">
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