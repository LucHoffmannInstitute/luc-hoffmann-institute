<?php get_header() ?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="Page">
    		
		<div class="u-container">
			
			<div class="u-cols">
				
				<div class="u-col u-col-4of12">

					<nav class="submenu">
						<ul>
							<li class="active"><a href="<?php home_url() ?>/pitches/">Pitch site</a></li>
						</ul>
					</nav>

					<?php get_sidebar() ?>

				</div><!-- .u-col -->

				<div class="u-col u-col-8of12">

					<div class="Page-content">
						
						<?php if ( have_posts() ) : ?>

							<?php while ( have_posts() ) : the_post() ?>
		
								<?php get_template_part( 'templates/pitch' ); ?>

							<?php endwhile ?>

						<?php endif ?>

						<?php if (is_single() && (comments_open() || get_comments_number() != '0')) : ?>
							
	  						<?php comments_template() ?>

						<?php endif ?>

					</div>
	
				</div><!-- .u-col -->

			</div><!-- .u-cols -->

		</div><!-- .u-container -->

    </div><!-- .Page -->

    <footer class="page-footer">

		<?php hoffmann_paginate() ?>

	</footer><!-- .page-footer -->

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>