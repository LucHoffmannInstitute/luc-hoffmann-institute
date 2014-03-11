<?php 
/**
 * Blog index
 */
get_header();
?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="page-content">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">
						
					<?php if ( have_posts() ) : ?>

						<section class="Feed">

                            <?php while ( have_posts() ) : the_post() ?>

								<?php get_template_part( 'templates/feed-item' ); ?>

                            <?php endwhile ?>

	                    </section>

					<?php endif ?>
	
				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .u-container -->

    </div><!-- .page-content -->

    <footer class="page-footer">

		<?php hoffmann_paginate() ?>

	</footer><!-- .page-footer -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>