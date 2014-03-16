<?php  
/**
 * The default template
 */

get_header();
?>

<section class="Page">

	<?php get_template_part( 'templates/page-header' ) ?>
	
	<div class="u-container">
		
		<div class="u-cols">
			
			<div class="u-col u-col-4of12">

				<?php get_sidebar() ?>

			</div>

			<div class="u-col u-col-8of12">

				<div class="Page-content">
					
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>
	
							<?php get_template_part( 'templates/article-excerpt' ); ?>

						<?php endwhile ?>

					<?php endif ?>

				</div><!-- .Page-content -->

				<footer class="Page-footer">

					<?php hoffmann_paginate() ?>

				</footer>

			</div><!-- .u-col -->

		</div><!-- .u-cols -->

	</div><!-- .u-container -->

</section><!-- .Page -->

<?php get_footer() ?>