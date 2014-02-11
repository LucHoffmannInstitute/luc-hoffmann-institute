<?php  

$banner_id = get_field( 'image', $post->ID );

$banner_post = get_post( $banner_id );

$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

$banner = array(
	'url' => $image_src[0],
	'credit' => $banner_post->post_excerpt
);
?>

<article class="Projects-list-item" <?php the_ID() ?>>
	
	<div class="Projects-list-item-inner">

		<a href="<?php the_permalink() ?>" class="Projects-list-item-header">

			<div class="Projects-list-item-image" style="background-image: url(<?php echo $banner['url'] ?>)"></div>

			<div class="Projects-list-item-title-container">

				<h2 class="Projects-list-item-title"><?php the_title() ?></h2>

			</div>
			
		</a>

		<div class="Projects-list-item-content">
			
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, eum doloribus praesentium ex quas animi sunt perferendis suscipit aperiam ipsam vitae cumque ipsum corrupti hic iste unde porro voluptatum quaerat sapiente quia.</p>

		</div>

	</div>

</article>