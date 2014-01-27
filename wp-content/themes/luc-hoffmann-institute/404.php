<?php get_header() ?>

    <div class="page-content">
    		
		<div class="container">
			
			<div class="cols">
				
				<div class="col col-4">
						
					<?php get_template_part( 'templates/submenu' ) ?>

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">

					<div class="entry">
	
						<div class="entry-content">

							<h1>Not found</h1>

							<p>The page you requested could not be found.</p>
							
							<?php get_search_form(); ?>

						</div><!-- .entry-content -->

					</div><!-- .entry -->

				</div><!-- .col.col-8 -->

			</div><!-- .cols -->

		</div><!-- .container -->

    </div><!-- .page-content -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>