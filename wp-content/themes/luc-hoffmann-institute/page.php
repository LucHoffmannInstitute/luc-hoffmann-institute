<?php get_header() ?>

    <?php get_template_part( 'partials/partial', 'page-header' ) ?>

    <div class="page-content">
    		
		<div class="container">
			
			<div class="cols">
				
				<div class="col col-4">
						
					<?php get_template_part( 'partials/partial', 'submenu' ) ?>

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">
						
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>
	
							<?php get_template_part( 'partials/partial', 'entry-page' ); ?>

						<?php endwhile ?>

					<?php endif ?>

				</div><!-- .col.col-8 -->

			</div><!-- .cols -->

		</div><!-- .container -->

    </div><!-- .page-content -->

    <?php get_template_part( 'partials/partial', 'page-footer' ) ?>

<?php get_footer() ?>