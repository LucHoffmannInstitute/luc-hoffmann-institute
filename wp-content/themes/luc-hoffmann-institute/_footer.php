        </section><!-- .main -->

        <footer class="footer" role="contentinfo">

            <div class="container">

                <div class="cols">

                    <div class="col col-6 align-right">

                        <div class="cols social-and-search">
                            
                            <div class="col col-7">
                                <?php get_search_form(); ?>            
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
                        <p class="info">&copy; <?php echo date('Y') ?> Luc Hoffmann Institute | <a href="<?php bloginfo('url') ?>/credits/">Credits</a></p>
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