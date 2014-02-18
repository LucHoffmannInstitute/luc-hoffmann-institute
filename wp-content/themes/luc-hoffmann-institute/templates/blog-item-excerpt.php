<?php
/**
 * Blog item excerpt
 */
$categories = get_the_category_list();
?>

<article class="Blog-item Blog-item--excerpt">
    
    <div class="Blog-item-image" style="background-image: url(http://placehold.it/400x400);"></div>

    <header class="Blog-item-header">

        <div class="Blog-item-meta">
            <time class="Blog-item-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
        </div>

        <h2 class="Blog-item-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

        <?php if ( get_field('subtitle') ) : ?>
            <h3 class="Blog-item-subtitle"><?php echo get_field('subtitle') ?></h3>
        <?php endif ?>

        <div class="Blog-item-excerpt">
            <?php the_excerpt() ?>
        </div>

    </header>

</article>