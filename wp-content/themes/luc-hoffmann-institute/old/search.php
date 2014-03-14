<?php get_header() ?>

    <div class="Page">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">
						
					<?php get_template_part( 'templates/submenu' ) ?>

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">
						
						<?php if ( have_posts() ) : ?>

							<?php while ( have_posts() ) : the_post() ?>
		
								<?php get_template_part( 'templates/entry-search' ); ?>

							<?php endwhile ?>

						<?php endif ?>

					</div>

				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .u-container -->

    </div><!-- .Page -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>