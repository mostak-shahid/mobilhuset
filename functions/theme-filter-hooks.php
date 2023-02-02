<?php
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) AND $post->post_type == 'page' ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    } else {
        $classes[] = $post->post_type . '-archive';
    }
    
    if ( is_user_logged_in() ) {
        $classes[] = 'logged-in-user';
    } else {
        $classes[] = 'guest-user';
    }

    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

function mos_excerpt_more($more) {
    //global $post;
    //return ' <a class="moretag btn btn-primary" href="'. get_permalink($post->ID) . '">Read More »</a>'; //Change to suit your needs
    return ''; //Change to suit your needs
} 
add_filter( 'excerpt_more', 'mos_excerpt_more' );

function mos_excerpt_length($length){ 
    return 20; 
} 
add_filter('excerpt_length', 'mos_excerpt_length');

function back_to_top_fnc () {
    global $mosgutenberg_options;
    if ($mosgutenberg_options['misc-back-top']) :
    ?>
    <a href="javascript:void(0)" class="scrollup" style="display: none;"><img width="40" height="40" src="<?php echo get_template_directory_uri() ?>/images/icon_top.png" alt="Back To Top"></a>
    <?php 
    endif;
}
add_action( 'action_below_footer', 'back_to_top_fnc', 10, 1 );


add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php.
remove_filter( 'pre_user_description', 'wp_filter_kses' );
// Add sanitization for WordPress posts.
add_filter( 'pre_user_description', 'wp_filter_post_kses' );