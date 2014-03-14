<?php	
/**
 * Article represented as thumbnail and title
 */
$image_id = get_field('image');
if ( $image_id )
{
	$image_url = wp_get_attachment_url( $image_id );
} else {
	$image_url = get_template_directory_uri() . '/assets/img/build/apple-touch-icon-144x144-precomposed.png';
}
?>

<article class="Article Article--mini" id="article-<?php the_ID() ?>">
					
	<div class="Article-thumbnail" style="background-image: url(<?php echo $image_url ?>);"></div>

	<header class="Article-header">

		<div class="Article-meta">
			<time class="Article-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
		</div>
		
		<h2 class="Article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

	</header>

</article>