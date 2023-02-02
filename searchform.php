<div class="searchInput">
    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-group">
            <input name="s" type="search" class="form-control" placeholder="<?php echo get_search_query() ? 'Search result for ' . get_search_query() : 'Search for...' ?>" aria-label="<?php echo get_search_query() ? 'Search result for ' . get_search_query() : 'Search for...' ?>">
            <button name="submit" class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>
