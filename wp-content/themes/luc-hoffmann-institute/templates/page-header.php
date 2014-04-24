<?php
/**
 * Page header with banner and section title
 */
$page_ancestor_id = hoffmann_ancestor();
$page_ancestor = get_post( $page_ancestor_id );

$style = '';

$banner = new Banner();

if ( ! $banner->hasImages())
{
	$banner = new Banner(array('id' => $page_ancestor_id));
}

$style .= ' background-image: url(' . $banner->url() . ');';
$style .= ' background-position: ' . $banner->position() . ';';

?>
<header class="Page-header Page-header--banner" style="<?php echo $style ?>">

	<div class="Page-header-inner">

		<div class="u-container">

			<h1 class="Page-title"><?php echo $page_ancestor->post_title ?></h1>

			<p class="Page-header-caption"><?php echo $banner->caption() ?></p>

		</div>

	</div>

</header>