<?php 
get_header();
$post_id = get_the_ID();
$author_id = get_post_field( 'post_author', $post_id );
$author_name = get_the_author_meta('display_name',$author_id);
$author_description = get_the_author_meta('description',$author_id);
$author_designation = carbon_get_user_meta( $author_id, 'mos_profile_designation' );
$author_image = carbon_get_user_meta( $author_id, 'mos_profile_image' );
$categories = get_the_category();
?>

<section class="blog-single-wrapper">
    <div class="container-lg">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                        <div class="entry-header">                            
                            <?php if ( ! empty( $categories ) ) : ?>
                                <p class="blogSingleTag"><?php echo esc_html( $categories[0]->name ); ?></p>
                            <?php endif?>
                            <h1 class="blog-title" itemprop="headline"><?php echo get_the_title() ?></h1>
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
                                <span class="posted-by" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">By 
                                    <a title="View all posts by <?php echo $author_name ?>" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="url" itemprop="url">
                                        <span class="author-name" itemprop="name"><?php echo $author_name ?></span>
                                    </a>
                                </span>
                            </div>
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-image"><?php the_post_thumbnail('full', ['class' => 'lazy-load-image lazyload img-fluid img-blog-single', 'title' => get_the_title()]); ?></div>
                            <?php endif?>                            
                        </div>
                        <div class="blog-info">
                            <div class="blog-intro"><?php the_content()?></div>
                            <?php
							wp_link_pages(
								array(
									'before'      => '<div class="page-links">',
									'after'       => '</div>',
									'link_before' => '<span class="page-link">',
									'link_after'  => '</span>',
								)
							);
							?>
							
							<div class="post-navigation d-flex justify-content-between align-items-center">
								<?php previous_post_link('%link', '<i class="fa fa-arrow-left"></i> %title'); ?>
								<?php next_post_link('%link', '%title <i class="fa fa-arrow-right"></i>'); ?>
							</div>
                            <hr>
                            <div class="author-intro">
                                <?php if ($author_image) :?>
                                    <div class="left-part">
                                        <img class="lazy-load-image lazyload author-image mb-1" src="<?php echo $author_image ?>" alt="<?php echo $author_name ?>" width="120px" height="120px" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="right-part">
                                    <div class="contributor-title">Author</div>
                                    <div class="d-sm-flex justify-content-start align-items-center mb-15">
                                        <div class="fs-24 authoredBy"><strong><?php echo $author_name; ?></strong></div>
                                        <?php if ($author_designation) : ?>
                                            <div class="authorDesignation">
                                                <div class="d-inline-block"><?php echo $author_designation; ?></div>
                                            </div>
                                        <?php endif?>
                                    </div>
                                    <?php if ($author_description) :  ?>
                                    <div class="fs-6 fw-normal textClrGray authorDesc">
                                        <?php echo $author_description; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="post-navigation d-flex justify-content-between align-items-center">
                        <?php previous_post_link('%link', '%title'); ?>
                        <?php next_post_link('%link', '%title'); ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php get_sidebar();?>
                    <div class="blogSingle-sidebar pb-5 position-sticky">
                        <div class="widget">
                            <?php get_search_form( true ); ?>
                        </div>
                        <div class="widget">
                            <span class="widget-title">Categories</span>
                            <div class="widget-content">
                                <?php $categories = mos_get_terms ('category');?>
                                <ul class="widget-category-list">
                                    <?php foreach($categories as $category) : ?>
                                        <?php if ($category['count']) :  ?>
                                        <li>
                                            <a class="" href="<?php echo home_url()?>/category/<?php echo $category['slug']?>/">
                                                <span class="title"><?php echo $category['name']?></span> 
                                                <span class="count">(<?php echo $category['count']?>)</span>
                                            </a>
                                        </li>
                                        <?php endif?>
                                    <?php endforeach?>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="widget">
                            <div class="socialLink d-flex align-items-center">
                                <div class="socialLinkTitle">Share</div>
                                <div class="socialLinkShare d-flex align-items-center">
                                    <?php //echo do_shortcode("[addtoany]") ?>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>        
            <div class="comment-part">
                <?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>
            </div>
        </div>
    </div>
</section> 


<?php get_footer() ?>
