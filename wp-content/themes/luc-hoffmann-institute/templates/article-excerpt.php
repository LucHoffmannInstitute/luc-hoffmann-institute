<?php
/**
 * The basic article template
 */
?>

<article class="Article Article--excerpt" id="article-<?php the_ID() ?>">
										
	<header class="Article-header">

		<div class="Article-meta">
			<time class="Article-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
			<div class="Article-categories">
				<?php the_category(', ') ?>
			</div>
		</div>
		
		<h2 class="Article-title"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></h2>

	</header>

	<div class="Article-content Entry">
    	<?php the_excerpt() ?>
    </div>

</article>