<?php get_header();?>
<section class="layout-single-wrapper">
    <div class="wrapper">
            <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                <?php the_content()?>
            </article>
        </div>        
        <div class="comment-part">
            <?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>
        </div>
    </div>
</section> 
<?php get_footer() ?>
