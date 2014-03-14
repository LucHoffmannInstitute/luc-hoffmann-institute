<?php 
/**
 * 404 template
 */
get_header();
?>

    <div class="Page">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">
						
					<?php get_template_part( 'templates/submenu' ) ?>

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">

						<div class="entry">
		
							<div class="entry-content">

								<h1>Not found</h1>

								<p>The page you requested could not be found.</p>
								
								<?php get_search_form(); ?>

							</div><!-- .entry-content -->

						</div><!-- .entry -->

					</div>

				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .container -->

    </div><!-- .Page -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>