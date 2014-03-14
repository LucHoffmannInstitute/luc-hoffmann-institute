<?php
/**
 * A single pitch post
 */
?>

<article class="Article Article--pitch" id="article-<?php the_ID() ?>">
										
	<header class="Article-header">

		<div class="Article-meta">
			<time class="Article-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
			<p class="Article-byline"><?php echo __('Posted by', 'hoffmann'); ?> <?php echo get_the_author(); ?><?php echo $comments ?></p>
		</div>
		
		<?php if ( is_single() ) : ?>
			
			<h2 class="Article-title"><?php the_title() ?></h2>

		<?php else : ?>

			<h2 class="Article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

		<?php endif ?>

		<?php if ( get_field('subtitle') ) : ?>

			<p class="Article-subtitle"><?php echo get_field('subtitle') ?></p>

		<?php endif ?>

	</header>

	<div class="Article-content Entry">

    	<?php the_content() ?>
    	
    </div>

</article>