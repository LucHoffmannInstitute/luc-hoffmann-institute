<form class="Form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Search this site" />
    <button class="Button Button--action" type="submit">Search</button>
</form>