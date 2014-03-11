<?php  

$banner_id = get_field( 'image', $post->ID );

$banner_post = get_post( $banner_id );

$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

$banner = array(
	'url' => $image_src[0],
	'credit' => $banner_post->post_excerpt
);
?>

<article class="Project Project--list">
	
	<div class="Project-inner">

		<a class="Project-image" href="<?php the_permalink() ?>" style="background-image: url(<?php echo $banner['url'] ?>)"></a>

		<div class="Project-header">

			<h2 class="Project-title"><?php the_title() ?></h2>

			<p class="Project-author"><?php echo get_field('author', $post->ID) ?></p>
		</div>

		<div class="Project-content">

			<div class="Project-excerpt">
				<?php the_excerpt() ?>
			</div>

		</div>

	</div>

</article>