<?php
/**
 * Blog item excerpt
 */
$categories = get_the_category_list();
?>

<article class="Blog-item Blog-item--excerpt">
    
    <header class="Blog-item-header">

        <div class="Blog-item-meta">
            <?php the_category() ?>
            <time class="Blog-item-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
        </div>

        <?php if ( is_single() ) : ?>
            <h2 class="Blog-item-title"><?php the_title() ?></h2>
        <?php else : ?>
            <h2 class="Blog-item-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <?php endif ?>
        <?php if ( get_field('subtitle') ) : ?>
            <h3 class="Blog-item-subtitle"><?php echo get_field('subtitle') ?></h3>
        <?php endif ?>
    </header>

    <div class="Blog-item-content">

        <div class="Entry">
            <?php the_excerpt() ?>
        </div>

    </div>

</article>