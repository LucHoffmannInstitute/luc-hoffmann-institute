<?php 
get_header();
?>

    <div class="Page">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<?php get_sidebar() ?>

				</div>

				<div class="u-col u-col-8of12">

					<div class="Page-content">
						
						<?php if ( have_posts() ) : ?>

							<?php while ( have_posts() ) : the_post() ?>
		
								<?php get_template_part( 'templates/article' ); ?>

							<?php endwhile ?>

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