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

// is this page associated with a workstream?
$work_stream = get_term(get_field('work_stream'), 'work_streams');

if ( isset($work_stream) && !empty($work_stream) ) {
	$style .= ' border-bottom-color: ' . get_field('color', 'work_streams_' . $work_stream->term_id) . ';';
}

?>
<header class="Page-header Page-header--banner" style="<?php echo $style ?>">

	<div class="Page-header-inner">

		<div class="u-container">

			<h1 class="Page-title"><?php echo $page_ancestor->post_title ?></h1>

			<p class="Page-header-caption"><?php echo $banner->caption() ?></p>

		</div>

	</div>

</header>