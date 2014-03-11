<?php get_header() ?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="page-content">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">
						
					<?php get_template_part( 'templates/submenu' ) ?>

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">
						
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>
	
							<?php get_template_part( 'templates/entry-page' ); ?>

						<?php endwhile ?>

					<?php endif ?>

				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .u-container -->

    </div><!-- .page-content -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>