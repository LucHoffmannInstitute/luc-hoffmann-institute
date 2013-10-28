<?php
$categories = get_the_category_list();
?>

<article class="entry">
    
    <?php if ( the_field('video_lede') ) : ?>
        <div class="entry-video-lede">
            <?php echo the_field('video_lede') ?>
        </div>
    <?php endif ?>

    <header class="entry-header">
        <div class="entry-meta">
            <?php the_category() ?>
            <time class="entry-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
        </div>
        <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <?php if ( get_field('subtitle') ) : ?>
            <h3 class="entry-subtitle"><?php echo get_field('subtitle') ?></h3>
        <?php endif ?>
    </header>

</article>