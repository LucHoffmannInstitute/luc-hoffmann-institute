<?php

$page_ancestor_id = hoffmann_ancestor();
$page_ancestor = get_post( $page_ancestor_id );

// is 'hierarchical' true?
$parent_projects = get_ancestors( $post->ID, $post->post_type );

$parent_project_id = array_pop( $parent_projects );

$banner = new Banner();

if ( ! $banner->hasImages())
{
	$banner = new Banner(array('id' => $parent_project_id));
}

$previous_post = get_adjacent_post(null,null,true);
$next_post = get_adjacent_post(null,null,false);

$subpages = new WP_Query( array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'post_parent' => $post->ID,
    'orderby' => 'menu_order',
    'order' => 'DESC'
) );
?>

<article class="Project Project--single" <?php the_ID() ?>>
	
	<div class="Project-inner">

		<div class="Project-image" style="background-image: url(<?php echo $banner->url() ?>)"></div>

		<div class="Project-header">

			<h1 class="Project-title"><?php the_title() ?></h1>

			<div class="u-cols">
			
				<div class="u-col u-col-4of12">

					<p class="Project-author"><?php echo get_field('author') ?></p>

				</div>

				<div class="u-col u-col-8of12">

					<?php if ( $subpages->have_posts() ) : ?>

						<nav class="Project-menu">
							<ul>

								<?php while ( $subpages->have_posts() ) : $subpages->the_post() ?>

									<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

								<?php endwhile ?>

							</ul>
						</nav>

					<?php endif ?>

				</div>

			</div><!-- .u-cols -->

		</div><!-- .Project-header -->

		<div class="Project-content Entry">
			
			<?php the_content() ?>

		</div>

		<div class="Project-footer">
			<nav class="Project-footer-nav">
				<ul>
					<?php if ( $previous_post ) : ?>
						<li class="prev"><a href="<?php echo get_permalink($previous_post->ID) ?>"><i class="icon-arrow-left"></i> <span><?php echo $previous_post->post_title ?></span></a></li>
					<?php endif ?>
					<?php if ( $next_post ) : ?>
						<li class="next"><a href="<?php echo get_permalink($next_post->ID) ?>"><span><?php echo $next_post->post_title ?></span> <i class="icon-arrow-right"></i></a></li>
					<?php endif ?>
				</ul>
			</nav>

		</div>

	</div>

</article>