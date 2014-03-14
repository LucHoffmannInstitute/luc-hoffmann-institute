<?php  
/**
 * The default page template
 */

get_header();
?>

<section class="Page">
	
	<div class="u-container">
		
		<div class="u-cols">
			
			<div class="u-col u-col-4of12">

				<?php get_template_part('templates/menu-secondary') ?>

				<?php get_sidebar() ?>

			</div>

			<div class="u-col u-col-8of12">

				<div class="Page-content">
					
					<article class="Article">
						
						<div class="Article-content Entry">
							
							<h2>Not found</h2>

							<p>The page you requested could not be found.</p>

							<?php get_search_form() ?>

						</div>

					</article>

				</div><!-- .Page-content -->

				<footer class="Page-footer">

					<?php hoffmann_paginate() ?>

				</footer>

			</div><!-- .u-col -->

		</div><!-- .u-cols -->

	</div><!-- .u-container -->

</section><!-- .Page -->

<?php get_footer() ?>