<?php
/**
 * Search results article template
 */
$breadcrumbs = hoffmann_breadcrumbs();
?>

<article class="Article Article--excerpt" id="article-<?php the_ID() ?>">
										
	<header class="Article-header">

		<div class="Article-meta">
			<?php if ( $breadcrumbs ) : ?>
				<div class="Article-breadcrumbs"><?php echo $breadcrumbs ?></div>
			<?php endif ?>
		</div>
		
		<h2 class="Article-title"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></h2>

	</header>

	<div class="Article-content Entry">
    	<?php the_excerpt() ?>
    </div>

</article>