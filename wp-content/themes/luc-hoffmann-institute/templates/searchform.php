<form class="Form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">

	<div class="Form-input-wrap">

    	<input class="Form-input Form-input--text" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Search this site" />

    	<button class="Button Button--action Form-input Form-input--submit" type="submit"><i class="icon-search"></i><span>Search</span></button>

    </div>

</form>