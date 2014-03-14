<?php 
$image_id = get_field('image');
if ( $image_id )
{
	$image_url = wp_get_attachment_url( $image_id );
} else {
	$image_url = get_template_directory_uri() . '/assets/img/build/apple-touch-icon-144x144-precomposed.png';
}
?>
                                
<article class="Feed-item Feed-item--blurb">
    
    <a class="Feed-item-inner" href="<?php the_permalink() ?>">

        <div class="Feed-item-image" style="background-image: url(<?php echo $image_url ?>);"></div>

        <header class="Feed-item-header">
            <time class="Feed-item-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
            <h3 class="Feed-item-title"><?php the_title() ?></h3>
        </header>

    </a>

</article>