<?php 
/**
 * Blog index
 */
get_header();
$page_ancestor_id = hoffmann_ancestor();
$page_ancestor = get_post( $page_ancestor_id );

$banner = new Banner();

if ( ! $banner->hasImages())
{
	$banner = new Banner(array('id' => $page_ancestor_id));
}
?>

    <div class="Page">

    	<header class="Page-header"  style="background-image: url(<?php echo $banner->url() ?>);">

			<div class="Page-header-inner">

				<div class="u-container">
				
					<h1 class="Page-title">News</h1>
				
				</div>

			</div>

		</header>
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">
						
						<?php if ( have_posts() ) : ?>

							<section class="Feed">

	                            <?php while ( have_posts() ) : the_post() ?>

									<?php get_template_part( 'templates/article-excerpt' ) ?>

	                            <?php endwhile ?>

		                    </section>

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