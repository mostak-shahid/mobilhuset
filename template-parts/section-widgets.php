<?php 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_widgets', $page_details ); 
?>
<section id="section-widgets" class="section-widgets">
    <div class="content-wrap">
        <?php do_action( 'action_before_widgets', $page_details ); ?>
        <div class="container">
            <div class="widgets-wrapper">
                <?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
                <?php dynamic_sidebar( 'footer_1' ); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php do_action( 'action_after_widgets', $page_details ); ?>
    </div>
</section>
<?php do_action( 'action_below_widgets', $page_details  ); ?>
