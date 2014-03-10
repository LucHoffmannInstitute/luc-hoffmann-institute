<?php 
/**
 * Blog index
 */
get_header();
?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="page-content">
    		
		<div class="container">
			
			<div class="cols">
				
				<div class="col col-4">

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">
						
					<?php if ( have_posts() ) : ?>

						<section class="Feed">

                            <?php while ( have_posts() ) : the_post() ?>

								<?php get_template_part( 'templates/feed-item' ); ?>

                            <?php endwhile ?>

	                    </section>

					<?php endif ?>
	
				</div><!-- .col.col-8 -->

			</div><!-- .cols -->

		</div><!-- .container -->

    </div><!-- .page-content -->

    <footer class="page-footer">

		<?php hoffmann_paginate() ?>

	</footer><!-- .page-footer -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>