<?php 
get_header();
?>

<section id="blogWrapper" class="blogWrapper commonPadding">
    <div class="filterArea pb-5 isBgBorder mb-5">
        <div class="container-lg">
            <div class="row">
                <div class="col-xl-6">
                    <div class="filterLeft d-flex gap-3">
                        <div class="singleFilter custom-mos-select">
                            <?php $categories = mos_get_terms('category'); ?>
                            <select class="bg-transparent rounded-pill px-4 form-select postFilter"onchange="window.location.replace(this.value)">
                                <option value="0" selected="">All Categories</option>
                                <?php foreach($categories as $category) : ?>
                                <option value="<?php echo home_url().'/?s=&category='.$category['term_id'] ?>" <?php echo (@$_GET['category'] == $category['term_id'])?'selected':'' ?>><?php echo $category['name'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="singleFilter custom-mos-select">
                            <select class="bg-transparent rounded-pill px-4 form-select postFilter"onchange="window.location.replace(this.value)">
                                <option value="<?php echo home_url().'/?s=&time=' ?>0" selected="">Select One</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>week" <?php echo (@$_GET['time'] == 'week')?'selected':''?>>Last 7 day's</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>month" <?php echo (@$_GET['time'] == 'month')?'selected':''?>>Last Month</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>year" <?php echo (@$_GET['time'] == 'year')?'selected':''?>>Last year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3"></div>
                <div class="col-xl-3">
                    <div class="searchInput">
                        <?php get_search_form( true ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-lg">
        <?php
//        echo @$_GET['category'];
//        echo @$_GET['time'];
        $args = array( 
            'post_type' 		=> 'post'
        );
        if (@$_GET['s']) $args['s'] = $_GET['s'];
        if (@$_GET['category']) {
            $args['cat'] = $_GET['category'];
        }
        if (@$_GET['time']) {
            $today = getdate();
            if ($_GET['time'] == 'week') $args['date_query'][]['after'] = '1 week ago';  
            elseif ($_GET['time'] == 'month') $args['monthnum'] = $today['mon'];            
            elseif ($_GET['time'] == 'year') $args['year'] = $today['year']; 
        }
        $query = new WP_Query( $args );
//        echo '<pre>';
//        var_dump($args);
//        echo '</pre>';
        ?>
        <?php if ( $query->have_posts() ) :?>
        <div id="blogs" class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="item-wrapper h-100">
                    <div class="singleBlog isRadius16 d-flex flex-column justify-content-between">
                        <div class="content-part">
                            <?php 
                                if (has_post_thumbnail()) : 
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                                $featured_img_resized = aq_resize($featured_img_url, 350, 200, true);
                            ?>
                            <div class="blogImage">
                                <a class="text-decoration-none" href="<?php echo get_the_permalink() ?>">
                                    <img decoding="async" class="lazy-load-image lazyload img-fluid w-100" src="<?php echo $featured_img_resized?$featured_img_resized:$featured_img_url ?>" alt="<?php echo get_the_title() ?>" width="350px" height="200px" loading="lazy">
                                </a>
                            </div>
                            <?php endif?>
                            <div class="blogInfo">
                                <h3 class="blogTitle mb-2">
                                    <a class="text-decoration-none" href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                                </h3>
                                <div class="blogDesc"><?php echo wp_trim_words( get_the_content(), 28, '...' )?></div>
                            </div>
                        </div>
                        <div class="link-part">
                            <a class="readMore d-flex align-items-center text-decoration-none" href="<?php echo get_the_permalink() ?>">
                                <span>Read More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile;?>
        </div>
        <div class="search-pagination-wrapper pagination-wrapper">
           <nav class="navigation pagination">
               <div class="nav-links">
            <?php
//                the_posts_pagination( array(
//                    'show_all' => false,
//                    'screen_reader_text' => " ",
//                    'prev_text'          => 'Prev',
//                    'next_text'          => 'Next',
//                ) );
            ?>
            <?php 
                $big = 999999999; // need an unlikely integer
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $query->max_num_pages,
                    'prev_text'          => __('Prev'),
                    'next_text'          => __('Next')
                ));
            ?>
                   
               </div>
           </nav>
        </div>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif;?>
    </div>
</section>

<?php get_footer() ?>
