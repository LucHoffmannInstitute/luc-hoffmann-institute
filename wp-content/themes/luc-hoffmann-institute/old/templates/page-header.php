<?php
$page_ancestor_id = hoffmann_ancestor();
$page_ancestor = get_post( $page_ancestor_id );

$banner = new Banner();

if ( ! $banner->hasImages())
{
	$banner = new Banner(array('id' => $page_ancestor_id));
}
?>
<header class="Page-header Page-header--banner" style="background-image: url(<?php echo $banner->url() ?>);">

	<div class="Page-header-inner">

		<div class="u-container">

			<h1 class="Page-title"><?php echo $page_ancestor->post_title ?></h1>

			<p class="Page-header-caption"><?php echo $banner->caption() ?></p>

		</div>

	</div>

</header>