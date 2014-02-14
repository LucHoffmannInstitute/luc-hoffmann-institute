<?php  

$banner_id = get_field( 'image', $post->ID );

$banner_post = get_post( $banner_id );

$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

$banner = array(
	'url' => $image_src[0],
	'credit' => $banner_post->post_excerpt
);
?>

<article class="Project Project--single" <?php the_ID() ?>>
	
	<div class="Project-inner">

		<div class="Project-header" style="background-image: url(<?php echo $banner['url'] ?>)"></div>

		<div class="Project-title-area">

			<h1 class="Project-title"><?php the_title() ?></h1>

			<p class="Project-author">Dr. John Q. Doe</p>
		</div>

		<div class="Project-content entry">

			<div class="entry-content">
				<?php the_content() ?>
			</div>

		</div>

		<div class="Project-footer">

		</div>

	</div>

</article>