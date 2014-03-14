<article class="entry">
    
    <header class="entry-header">
        <div class="entry-meta">
        	<?php if ( get_post_type() == 'post' ) : ?>
        		<?php the_category() ?>
            	<time class="entry-date" datetime="<?php get_the_date( 'c' ) ?>"><?php echo get_the_date( 'd.m.Y' ) ?></time>
        	<?php else : ?>
        		<?php echo get_post_type() ?>
			<?php endif ?>
        </div>
        <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <?php if ( get_field('subtitle') ) : ?>
            <h3 class="entry-subtitle"><?php echo get_field('subtitle') ?></h3>
        <?php endif ?>
    </header>

    <div class="entry-content">
        
        <?php the_excerpt() ?>

    </div><!-- .entry-content -->

</article>