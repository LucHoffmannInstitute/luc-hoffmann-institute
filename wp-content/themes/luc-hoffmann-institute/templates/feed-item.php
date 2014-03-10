<?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>
                                
<article class="Feed-item">
    
    <a class="Feed-item-inner" href="<?php the_permalink() ?>">

        <div class="Feed-item-image" style="background-image: url(<?php echo $image_url ?>);"></div>

        <header class="Feed-item-header">
            <time class="Feed-item-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
            <h3 class="Feed-item-title"><?php the_title() ?></h3>
        </header>

    </a>

</article>