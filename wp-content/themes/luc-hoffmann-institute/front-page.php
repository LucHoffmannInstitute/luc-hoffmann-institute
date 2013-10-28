<?php 
get_header(); 

$projects = new WP_Query( array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'feature',
            'value' => '1',
            'compare' => '=='
        )
    )
) );

$blog_posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 3
) );
?>

    <section class="projects">

        <nav class="projects-arrows">
            <ul>
                <li class="prev"><a href="#"><i class="icon-arrow-left"></i><span>Back</span></a></li>
                <li class="next"><a href="#"><i class="icon-arrow-right"></i><span>Next</span></a></li>
            </ul>
        </nav>

        <?php if ( $projects->have_posts() ) : ?>
        
            <div class="projects-slider rsDefault">

                <?php while ( $projects->have_posts() ) : $projects->the_post() ?>

                    <?php get_template_part( 'partials/partial', 'project' ) ?>

                <?php endwhile ?>

            </div>

        <?php endif ?>

        <?php wp_reset_postdata() ?>

    </section><!-- .projects -->

    <div class="container">

        <div class="cols">

            <div class="col col-8">

                <?php if ( $blog_posts->have_posts() ) : ?>

                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post() ?>
                        
                        <?php get_template_part( 'partials/partial', 'entry-home-page' ) ?>

                    <?php endwhile ?>

                <?php endif ?>

                <?php wp_reset_postdata() ?>

            </div><!-- .col.col-8 -->

            <div class="col col-4">

                <?php get_sidebar( 'home' ) ?>
                
            </div><!-- .col.col-4 -->

        </div><!-- .cols -->

    </div><!-- .container -->

<?php get_footer() ?>