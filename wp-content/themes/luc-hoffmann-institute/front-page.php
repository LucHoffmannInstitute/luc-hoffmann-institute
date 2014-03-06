<?php 
get_header();

$blog_posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 3
) );
?>

    <section class="Cards">

        <div class="Cards-content u-cols" style="background-image: url(<?php echo get_bloginfo('url') ?>/wp-content/uploads/2013/10/HI_230600.jpg);">

            <div class="u-container">
        
                <article class="Card u-col u-col-4of12">
                    
                    <div class="Card-inner">

                        <div class="Card-image" style="background-image: url(<?php echo get_bloginfo('url') ?>/wp-content/uploads/2013/10/HI_230600.jpg);"></div>
                        
                        <header class="Card-header">
                            
                            <h2 class="Card-title">Place Based Conservation Effectiveness</h2>

                        </header>

                        <div class="Card-content Card-excerpt">
                            <p><!--Research and synthesis-->Evaluating the present and future effectiveness of placed-based conservation systems.</p>
                            <p><small>Current projects: MPA, DYCE</small></p>
                        </div>

                        <div class="Card-footer">
                            <a href="#" class="Button">Learn more</a>
                        </div>

                    </div>

                </article>

                <article class="Card u-col u-col-4of12">
                    
                    <div class="Card-inner">

                        <div class="Card-image" style="background-image: url(<?php echo get_bloginfo('url') ?>/wp-content/uploads/2013/10/259587.jpg);"></div>
                        
                        <header class="Card-header">
                            
                            <h2 class="Card-title">Natural Capital and Ecosystem Services</h2>

                        </header>

                        <div class="Card-content Card-excerpt">
                            <p><!--Research and synthesis-->Focused on the value of natural capital, and the quantification and linkage of ecosystem services.</p>
                            <p><small>Current projects: LIVES</small></p>
                        </div>

                        <div class="Card-footer">
                            <a href="#" class="Button">Learn more</a>
                        </div>

                    </div>

                </article>

                <article class="Card u-col u-col-4of12">
                    
                    <div class="Card-inner">

                        <div class="Card-image" style="background-image: url(<?php echo get_bloginfo('url') ?>/wp-content/uploads/2013/10/50492.jpg);"></div>
                        
                        <header class="Card-header">
                            
                            <h2 class="Card-title">Sustainable Production and Consumption</h2>

                        </header>

                        <div class="Card-content Card-excerpt">
                            <p><!--Research and synthesis-->Evaluating the feasibility and impact of methods to reduce the human footprint on the planet.</p>
                            <p><small>Current projects: Certification, China Review</small></p>
                        </div>

                        <div class="Card-footer">
                            <a href="#" class="Button">Learn more</a>
                        </div>

                    </div>

                </article>

            </div><!-- .u-container -->

        </div><!-- .Cards-content -->

    </section><!-- .Cards -->

    <div class="u-container">

        <div class="u-cols">

            <div class="u-col u-col-4of12">
                
                <section class="Widget Widget--Stay-Connected">
                    
                    <header class="Widget-header">
                        <h2 class="Widget-title">Stay Connected</h2>
                    </header>

                    <div class="Widget-content">
                        
                        

                    </div>

                </section>

            </div><!-- .u-col -->

            <div class="u-col u-col-8of12">

                <?php if ( $blog_posts->have_posts() ) : ?>
                
                    <section class="Widget Widget--Feed">

                        <div class="Feed">

                            <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post() ?>

                                <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>
                            
                                <article class="Feed-item Media-object">
                                    
                                    <div class="Feed-item-image" style="background-image: url(<?php echo $image_url ?>);"></div>

                                    <header class="Feed-item-header">
                                        <h3 class="Feed-item-title"><?php the_title() ?></h3>
                                    </header>

                                </article>

                            <?php endwhile ?>

                        </div><!-- .Feed -->

                    </section>

                    <?php wp_reset_postdata() ?>

                <?php endif ?>

            </div><!-- .u-col -->

        </div><!-- .u-cols -->

    </div><!-- .u-container -->

<?php get_footer() ?>