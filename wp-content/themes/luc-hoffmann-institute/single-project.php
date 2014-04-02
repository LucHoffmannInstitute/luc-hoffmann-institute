<?php
/**
 * Single project page
 */
get_header();

$parents = get_ancestors($post->ID, $post->post_type);

$parent_id = empty($parents) ? $post->ID : array_pop($parents);

$banner = new Banner();

/**
 * Get tabbed content
 */
$tabs = hoffmann_get_tabs();


$work_streams = get_the_terms($post->ID, 'work_streams');
$work_stream = array_pop($work_streams);
$color = get_field('color', $work_stream->taxonomy . '_' . $work_stream->term_id);
?>

	<section class="Projects Projects--single">
	
		<div class="u-container">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="Project Project--single" <?php the_ID() ?>>
	
						<div class="Project-inner">

							<div class="Project-image" style="background-image: url(<?php echo $banner->url() ?>)"></div>

							<div class="Project-header"<?php if (isset($color)) echo ' style="border-bottom-color: ' . $color . ';"' ?>>
										
								<h1 class="Project-title"><?php echo get_the_title($parent_id) ?></h1>
								
								<?php if ( get_field('author') ) : ?>

									<p class="Project-author"><?php echo get_field('author') ?></p>

								<?php endif ?>

								<?php if ( is_array($tabs) ) : ?>

									<nav class="Project-menu Tabs-menu">

										<li class="Tabs-menu-item"><a href="#top">Home</a></li>
										
										<?php foreach ($tabs as $tab) : ?>

											<li class="Tabs-menu-item"><a href="#<?php echo $tab['anchor'] ?>"><?php echo $tab['title'] ?></a></li>

										<?php endforeach ?>

									</nav>

								<?php endif ?>

							</div><!-- .Project-header -->

							<div class="Project-content Tabs">

								<div class="Project-tab Tab Entry">

									<?php the_content() ?>

								</div>

								<?php if ( is_array($tabs) ) : ?>

									<?php foreach ($tabs as $tab) : ?>

										<div class="Project-tab Tab Entry">
											
											<?php echo $tab['content'] ?>

										</div>

									<?php endforeach ?>
	
								<?php endif ?>

								<footer class="Project-footer">

									<?php if ($banner->caption()) : ?>

										<p class="caption">Banner image: <?php echo $banner->caption() ?></p>

									<?php endif ?>
									
								</footer>

							</div><!-- .Project-content -->

						</div><!-- .Project-inner -->

					</article><!-- .Project -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .u-container -->

	</section><!-- .Projects -->

    <?php // get_template_part( 'templates/page-footer' ); ?>

<?php get_footer(); ?>