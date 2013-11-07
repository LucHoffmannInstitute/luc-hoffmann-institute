<?php
$categories = get_the_category_list();
?>

<article class="entry">
    
    <header class="entry-header">
        <div class="entry-meta">
            <!--<?php the_category() ?>-->
            <p class="entry-byline"><?php echo __('Posted by', 'hoffmann'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>
            <time class="entry-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
        </div>
        <?php if ( is_single() ) : ?>
            <h2 class="entry-title"><?php the_title() ?></h2>
        <?php else : ?>
            <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <?php endif ?>
        <?php if ( get_field('subtitle') ) : ?>
            <h3 class="entry-subtitle"><?php echo get_field('subtitle') ?></h3>
        <?php endif ?>
    </header>

    <div class="entry-content">
        
        <?php the_content() ?>

    </div><!-- .entry-content -->

</article>