<?php  
/**
 * Single project
 */
$banner = new Banner();
?>

<article class="Project Project--list">
	
	<div class="Project-inner">

		<a class="Project-image" href="<?php the_permalink() ?>" style="background-image: url(<?php echo $banner->url() ?>)"></a>

		<div class="Project-header">

			<h2 class="Project-title"><?php the_title() ?></h2>

			<p class="Project-author"><?php echo get_field('author') ?></p>
		</div>

		<div class="Project-content">

			<div class="Project-excerpt">
				<?php the_excerpt() ?>
			</div>

		</div>

	</div>

</article>