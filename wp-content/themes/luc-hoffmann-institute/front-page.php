<?php  
/**
 * index.php
 *
 * Default template
 */

get_header();

$posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 3
) );

$banner = new Banner();
?>

<section class="Cards">

    <div class="Cards-content u-cols" style="background-image: url(<?php echo $banner->url() ?>);">

        <div class="u-container">
    
            <article class="Card u-col u-col-4of12" id="card-1">
                
                <div class="Card-inner">
                    
                    <header class="Card-header">
                        
                        <h2 class="Card-title">Place Based Conservation Effectiveness</h2>

                    </header>

                    <div class="Card-content Card-excerpt">
                        <p>Evaluating the present and future effectiveness of placed-based conservation systems.</p>
                        <p><small>Current projects: <a href="#">MPA</a> <a href="#">DYCE</a></small></p>
                    </div>

                </div>

            </article>

            <article class="Card u-col u-col-4of12" id="card-2">
                
                <div class="Card-inner">
                    
                    <header class="Card-header">
                        
                        <h2 class="Card-title">Natural Capital and Ecosystem Services</h2>

                    </header>

                    <div class="Card-content Card-excerpt">
                        <p>Focused on the value of natural capital, and the quantification and linkage of ecosystem services.</p>
                        <p><small>Current projects: <a href="#">LIVES</a></small></p>
                    </div>

                </div>

            </article>

            <article class="Card u-col u-col-4of12" id="card-3">
                
                <div class="Card-inner">
                    
                    <header class="Card-header">
                        
                        <h2 class="Card-title">Sustainable Production and Consumption</h2>

                    </header>

                    <div class="Card-content">
                        <p>Evaluating the feasibility and impact of methods to reduce the human footprint on the planet.</p>

                        <p><small>Projects: <a href="#">Certification</a> <a href="#">China Review</a></small></p>
                    </div>

                </div>

            </article>

        </div><!-- .u-container -->

        <?php if ($banner) : ?>

            <div class="u-container">
                    
                <div class="Cards-caption">
                    <p><?php echo $banner->caption() ?></p>
                </div>

            </div>

        <?php endif ?>

    </div><!-- .Cards-content -->

</section><!-- .Cards -->

<div class="u-container">
    
    <div class="u-cols">
        
        <div class="u-col u-col-8of12">
            
            <?php if ( $posts->have_posts() ) : ?>

                <section class="Widget Widget--latest-news">
                    
                    <header class="Widget-header">

                        <h2 class="Widget-title">Latest News</h2>

                    </header>

                    <div class="Widget-content Articles">
                        
                        <?php while ( $posts->have_posts() ) : $posts->the_post() ?>

                            <?php get_template_part('templates/article-mini') ?>

                        <?php endwhile ?>

                    </div>

                    <footer class="Widget-footer">
                        
                        <a class="Button Button--action" href="<?php echo get_bloginfo('url') ?>/blog/">More news</a>

                    </footer>

                </section>

                <?php wp_reset_postdata() ?>

            <?php endif ?>

        </div><!-- .u-col -->

        <div class="u-col u-col-4of12">
            
            <section class="Widget Widget--stay-connected">
                
                <header class="Widget-header">
                    <h2 class="Widget-title">Stay Connected</h2>
                </header>

                <div class="Widget-content">
                    
                    <form class="Form validate" action="http://wwfint.us7.list-manage2.com/subscribe/post?u=9027d13aee5d8d2ac7bab6eb4&amp;id=ec0233486c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>

                        <div class="Form-content">
                            <p>Subscribe to our newsletter</p>
                                
                            <label class="Form-label" for="EMAIL">Enter your email address</label>

                            <input class="Form-input Form-input--text" type="text" value="" name="EMAIL" placeholder="Enter your email address" />

                            <button class="Form-input Form-input--submit Button Button--action" type="submit">Submit</button>
                        </div>

                    </form>

                    <ul>
                        <?php if ( get_option( 'contact_email' ) ) : ?>
                            <li><a href="mailto:<?php echo get_option( 'contact_email' ) ?>?Subject=Luc%20Hoffmann%20Institute"><i class="icon-mail"></i> <span>Contact us</span></a></li>
                        <?php endif ?>
                        <li><a href="<?php bloginfo( 'rss2_url' ) ?>"><i class="icon-rss"></i> <span>Subscribe via RSS</span></a></li>
                        <?php if ( get_option( 'twitter_handle' ) ) : ?>
                            <li><a href="https://twitter.com/<?php echo get_option( 'twitter_handle' ) ?>"><i class="icon-twitter"></i> <span>Twitter</span></a></li>
                        <?php endif ?>
                        <!--<li><a href="#"><i class="icon-facebook"></i> <span>Facebook</span></a></li>-->
                        <?php if ( get_option( 'linked_in' ) ) : ?>
                            <li><a href="<?php echo get_option( 'linked_in' ) ?>"><i class="icon-linkedin"></i> <span>LinkedIn</span></a></li>
                        <?php endif ?>
                    </ul> 

                </div>

            </section>

        </div><!-- .u-col -->

    </div><!-- .u-cols -->

</div><!-- .u-container -->

<?php get_footer() ?>