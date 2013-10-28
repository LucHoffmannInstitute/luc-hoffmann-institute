<?php
	$section = array();
	$banner = array();

	$page_ancestor_id = hoffmann_page_ancestor();
	$page_ancestor = get_post( $page_ancestor_id );

	$banner_id = get_field( 'image', $page_ancestor_id );
	$banner_post = get_post( $banner_id );

	$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

	$banner = array(
		'url' => $image_src[0],
		'credit' => $banner_post->post_excerpt
	);
?>
<header class="page-header" style="background-image: url(<?php echo $banner['url'] ?>);">

	<div class="page-header-inner">

		<div class="container">

			<h1><?php echo $page_ancestor->post_title ?></h1>

			<p class="photo-credit"><?php echo $banner['credit'] ?></p>

		</div>

	</div>

</header>