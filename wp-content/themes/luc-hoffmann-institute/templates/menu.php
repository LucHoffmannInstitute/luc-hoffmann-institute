<nav class="Menu" id="menu" role="navigation">
	
	<div class="u-container">
		
		<?php wp_nav_menu( array(
            'theme_location' => 'main-menu',
            'depth' => 1,
            'menu_id' => false,
            'container' => false,
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new Menu_With_Description()
        ) ) ?>

	</div>

</nav>