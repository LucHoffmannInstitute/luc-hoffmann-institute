        </section><!-- .main -->

        <footer class="footer" role="contentinfo">

            <div class="container">

                <div class="cols">

                    <div class="col col-6 align-right">

                        <form class="signup-form" action="http://wwfint.us7.list-manage2.com/subscribe/post?u=9027d13aee5d8d2ac7bab6eb4&amp;id=ec0233486c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <h2 class="form-title">Subscribe to our newsletter</h2>
                            <label for="EMAIL">Enter your email address</label>
                            <div class="input-wrap">
                                <input type="text" value="" name="EMAIL" placeholder="Enter your email address" />
                                <button type="submit"><i class="icon-arrow-right"></i> <span>Subscribe</span></button>
                            </div>
                        </form>

                        <div class="cols social-and-search">
                            
                            <div class="col col-7">
                                <?php get_search_form(); ?>            
                            </div>

                            <div class="col col-5">
                                <div class="social">
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
                            </div>
                        
                        </div>

                    </div><!-- .col.col-6 -->

                    <div class="col col-6 align-left">

                        <div class="col col-6">
                            <a class="panda-logo" href="http://panda.org/"><img src="<?php echo get_template_directory_uri() ?>/assets/img/panda-logo.svg" alt=""></a>
                        </div>
                        <div class="col col-6">
                            <a class="mava-logo" href="http://en.mava-foundation.org/"><i class="icon-mava"></i>
                                The Luc Hoffmann Institute is supported by a generous gift from the MAVA Foundation
                            </a>
                        </div>

                    </div><!-- .col.col-6 -->

                </div><!-- .cols -->

                <div class="cols">

                    <div class="col col-6">
                        <p class="info">&copy; 2013 Luc Hoffmann Institute | <a href="<?php bloginfo('url') ?>/credits/">Credits</a></p>
                    </div>

                </div><!-- .cols -->
            
            </div><!-- .container -->

        </footer><!-- .footer -->


        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php wp_footer() ?>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-44743795-1', 'luchoffmanninstitute.org');
            ga('send', 'pageview');
        </script>
    </body>
</html>