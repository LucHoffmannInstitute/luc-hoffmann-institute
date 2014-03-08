<?php
$page_ancestor_id = hoffmann_ancestor();
$page_ancestor = get_post( $page_ancestor_id );

$banner = new Banner();

if ( ! $banner->hasImages())
{
	$banner = new Banner(array('id' => $page_ancestor_id));
}
?>
<header class="page-header" style="background-image: url(<?php echo $banner->url() ?>);">

	<div class="page-header-inner">

		<div class="container">

			<h1><?php echo $page_ancestor->post_title ?></h1>

			<p class="photo-credit"><?php echo $banner->caption() ?></p>

		</div>

	</div>

</header>