<?php 
/**
 * Blog index
 */
get_header();
?>

    <div class="Page">
    		
		<div class="u-container">

			<header class="Page-header">

				<nav class="Filter-menu">
					<ul>
						<li class="Filter-menu-select">
							<a href="#"><span>All Themes</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Filter-menu-select">
							<a href="#"><span>All Dates</span> <i class="icon-menu"></i></a>
						</li>
						<li class="Filter-menu-search">
							<a href="#"><i class="icon-search"></i> <span>Search</span></a>
						</li>
					</ul>
				</nav>

			</header>
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">
						
						<?php if ( have_posts() ) : ?>

							<section class="Feed">

	                            <?php while ( have_posts() ) : the_post() ?>

									<?php get_template_part( 'templates/entry' ); ?>

	                            <?php endwhile ?>

		                    </section>

						<?php endif ?>

					</div><!-- .Page-content -->
	
				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .u-container -->

    </div><!-- .Page -->

    <footer class="Page-footer">

		<?php hoffmann_paginate() ?>

	</footer>

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>