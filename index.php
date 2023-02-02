<?php 
get_header();
//if (is_home()) {
    $page_id = get_option( 'page_for_posts' );
    $post   = get_post( $page_id );
    $blog_page_content =  apply_filters( 'the_content', $post->post_content );
//}
$newsletter_button_url = carbon_get_theme_option( 'mos-archive-newsletter-button-url' );

$term = get_queried_object();

?>

<?php //echo $blog_page_content?>
<section class="blogWrapper">
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
                                <option value="<?php echo home_url().'/?s=&category='.$category['term_id'] ?>" <?php if (@$term && $term->term_id == $category['term_id']) echo 'selected'?>  ><?php echo $category['name'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="singleFilter custom-mos-select">
                            <select class="bg-transparent rounded-pill px-4 form-select postFilter"onchange="window.location.replace(this.value)">
                                <option value="<?php echo home_url().'/?s=&time=' ?>0" selected="">Select One</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>week">Last 7 day's</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>month">Last Month</option>
                                <option value="<?php echo home_url().'/?s=&time=' ?>year">Last year</option>
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
        <?php if ( have_posts() ) :?>
        <div id="blogs" class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php 
                $post_id = get_the_ID();
                $author_id = get_post_field( 'post_author', $post_id );
                $author_name = get_the_author_meta('display_name',$author_id);
                $categories = get_the_category();
                ?>
                <div class="col-sm-6 col-lg-4 mb-4">
                    <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                        <div class="content-part">
                            <?php 
                            if (has_post_thumbnail()) : 
                            $featured_img_url = get_the_post_thumbnail_url($post_id,'full');
                            $featured_img_resized = aq_resize($featured_img_url, 350, 200, true);
                            ?>
                            <div class="blog-image">
                                <a class="text-decoration-none d-block" href="<?php echo get_the_permalink() ?>">
                                    <img decoding="async" class="lazy-load-image lazyload img-fluid w-100" src="<?php echo $featured_img_resized?$featured_img_resized:$featured_img_url ?>" alt="<?php echo get_the_title() ?>" width="350px" height="200px" loading="lazy">
                                </a>
                            </div>
                            <?php endif?>
                            
                            <div class="entry-meta">	
                                <?php if (comments_open() || '0' != get_comments_number()) : ?>
                                    <span class="comments-link">
                                    <?php if ( get_comments_number() ) : ?>
                                        <a href="<?php echo get_the_permalink() ?>#comments"><?php comments_number( 'No Comments', '1 Comments', '% Comments' );?></a>
                                    <?php else : ?>
                                        <a href="<?php echo get_the_permalink() ?>#respond">Leave a Comment</a>
                                    <?php endif ?>
                                    </span>
                                <?php endif;?>	
                                <?php if (! empty( $categories ) ) : ?>
                                    <span class="cat-links">
                                        <?php
                                        $separator = ', ';
                                        $output = '';
                                        foreach( $categories as $category ) {
                                            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                        }
                                        echo trim( $output, $separator );                                    
                                        ?>
                                    </span>
                                <?php endif?>
                                <span class="posted-by" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
                                    By <a title="View all posts by <?php echo $author_name ?>" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="url" itemprop="url">
                                        <span class="author-name" itemprop="name"><?php echo $author_name ?></span>
                                    </a>
                                </span>
                            </div>
                            
                            <div class="blog-info" itemprop="text">
                                <h3 class="blog-title" itemprop="headline">
                                    <a class="text-decoration-none" href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                                </h3>
                                <div class="blog-intro">
                                <?php //echo wp_trim_words( strip_shortcodes(get_the_content()), 28, '...' )?>
                                <?php echo get_the_excerpt() ?>
                                </div>
                            </div>
                        </div>
                        <div class="link-part">
                            <a class="btn-read-more" href="<?php echo get_the_permalink() ?>">
                                <span class="screen-reader-text d-none"><?php echo get_the_title() ?></span>
                                <span>Read More</span>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endwhile;?>
        </div>
        <div class="blog-pagination-wrapper pagination-wrapper">
            <?php
                the_posts_pagination( array(
                    'show_all' => false,
                    'screen_reader_text' => " ",
                    'prev_text'          => 'Prev',
                    'next_text'          => 'Next',
                ) );
            ?>
        </div>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif;?>
    </div>
</section>
<?php get_footer() ?>
