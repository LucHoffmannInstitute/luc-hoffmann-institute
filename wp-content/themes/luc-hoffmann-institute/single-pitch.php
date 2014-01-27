<?php get_header() ?>

    <?php get_template_part( 'templates/page-header' ) ?>

    <div class="page-content">
    		
		<div class="container">
			
			<div class="cols">
				
				<div class="col col-4">

					<nav class="submenu">
						<ul>
							<li class="active"><a href="<?php home_url() ?>/pitches/">Pitch site</a></li>
						</ul>
					</nav>

					<?php get_sidebar() ?>

				</div><!-- .col.col-4 -->

				<div class="col col-8">
						
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>
	
							<?php get_template_part( 'templates/pitch' ); ?>

						<?php endwhile ?>

					<?php endif ?>

					<?php if (is_single() && (comments_open() || get_comments_number() != '0')) : ?>
						
  						<?php comments_template() ?>

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