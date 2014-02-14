<?php  

$banner_id = get_field( 'image', $post->ID );

$banner_post = get_post( $banner_id );

$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

$banner = array(
	'url' => $image_src[0],
	'credit' => $banner_post->post_excerpt
);
?>

<article class="Project" <?php the_ID() ?>>
	
	<div class="Project-inner">

		<a class="Project-header" href="<?php the_permalink() ?>" style="background-image: url(<?php echo $banner['url'] ?>)"></a>

		<div class="Project-title">
			<?php the_title() ?>

			<p><?php the_time(get_option('date_format')) ?></p>

			<p>Dr. John Q. Doe</p>
		</div>

		<div class="Project-content">
			
			<div class="Project-content-side">
				
			</div>

			<div class="Project-content-main">
				<?php the_excerpt() ?>
			</div>

		</div>

		<div class="Project-footer">
			
			<a href="<?php the_permalink() ?>">View project <i class="icon-arrow-right"></i></a>

		</div>

	</div>

</article>