<article class="Article Article--excerpt">
										
	<header class="Article-header">

		<div class="Article-meta">
			<time class="Article-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
			<?php the_category() ?>
		</div>
		
		<h2 class="Article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

	</header>

	<div class="Article-content entry">
    	<?php the_excerpt() ?>
    </div>

</article>