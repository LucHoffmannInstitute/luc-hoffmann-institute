<?php  
/**
 * Single project
 */
global $count;

$banner = new Banner();

$work_streams = get_the_terms(get_the_ID(), 'work_streams');
$work_stream = array_pop($work_streams);
$color = get_field('color', $work_stream->taxonomy . '_' . $work_stream->term_id);
?>

<article class="Project Project--list">
	
	<div class="Project-inner">

		<a class="Project-image" href="<?php the_permalink() ?>" style="background-image: url(<?php echo $banner->url() ?>)"></a>

		<div class="Project-header"<?php if (isset($color)) echo ' style="border-bottom-color: ' . $color . ';"' ?>>

			<h2 class="Project-title"><?php echo $count ?>. <?php the_title() ?></h2>
		</div>

		<div class="Project-content">

			<div class="Project-excerpt">
				<?php the_field('abstract') ?>
			</div>

		</div>

	</div>

</article>