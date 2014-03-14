		</section><!-- .Main -->

		<footer class="Footer" role="contentinfo">
			
			<div class="u-container">
				
				<div class="u-cols">
					
					<div class="Footer-logos u-col u-col-6of12">

		                <ul>
		                    
		                    <li>
		                        <a class="panda-logo" href="http://panda.org/"></a>
		                    </li>

		                    <li>
		                        <a class="mava-logo" href="http://en.mava-foundation.org/"></a>
		                    </li>

		                </ul>

		            </div><!-- .u-col -->

		            <div class="u-col u-col-4of12 align-right">

		                <div class="Widget Widget--search">
		                    <?php get_search_form(); ?>

		                    <div class="info">
		                        <p>&copy; <?php echo date('Y') ?> Luc Hoffmann Institute | <a href="<?php bloginfo('url') ?>/credits/">Credits</a></p>
		                    </div>
		                </div>

		            </div><!-- .u-col -->

				</div><!-- .u-cols -->

			</div><!-- .u-container -->

		</footer>

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