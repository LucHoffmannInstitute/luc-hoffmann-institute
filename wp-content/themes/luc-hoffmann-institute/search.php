<?php
/**
 * The default page template
 */

get_header();
?>

<section class="Page">

	<div class="u-container">

		<div class="u-cols">

			<div class="u-col u-col-4of12">

				<?php get_template_part('templates/menu-secondary') ?>

				<?php get_sidebar() ?>

			</div>

			<div class="u-col u-col-8of12">

				<div class="Page-content">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>

							<?php get_template_part('templates/article-excerpt-search') ?>

						<?php endwhile ?>

					<?php else : ?>

							<article class="Article Article--excerpt">
										
								<header class="Article-header">
									
									<h2 class="Article-title">No results found</h2>

								</header>

								<div class="Article-content Entry">
									No results were found for those search terms.

									<br /><br />

									<?php get_search_form(); ?>
							    </div>

							</article>

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
