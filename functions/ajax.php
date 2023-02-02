<?php
/* AJAX action callback */
add_action( 'wp_ajax_reset_prl', 'reset_prl_ajax_callback' );
add_action( 'wp_ajax_nopriv_reset_prl', 'reset_prl_ajax_callback' );
/* Ajax Callback */
function reset_prl_ajax_callback () {
    $post_id = $_GET['post_id'];
    delete_post_meta($post_id, '_mosgutenberg_page_section_layout');
    //http://tippproperty.belocal.today/wp-admin/post.php?post=16&action=edit
    $location = admin_url('/') . 'post.php?post=' . $post_id . '&action=edit';
    wp_redirect( $location, $status = 302 );
    exit; // required. to end AJAX request.
}
/* AJAX action callback */
add_action( 'wp_ajax_dummy', 'dummy_ajax_callback' );
add_action( 'wp_ajax_nopriv_dummy', 'dummy_ajax_callback' );
/* Ajax Callback */
function dummy_ajax_callback () {
    $post_id = $_POST['product'];
    $output = array();
	echo json_encode($output);
    exit; // required. to end AJAX request.
}

/* AJAX action callback */
add_action( 'wp_ajax_get_searched_products', 'get_searched_products_ajax_callback' );
add_action( 'wp_ajax_nopriv_get_searched_products', 'get_searched_products_ajax_callback' );
/* Ajax Callback */
function get_searched_products_ajax_callback () {
    $search_value = $_POST['search_value'];
    $output = array();
    $html = '';
    if ($search_value) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 10,
            's' => $search_value
        );
        // The Query
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            $html .= '<ul>';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                //$html .= '<li>' . preg_replace($search_value, '<b>'.$search_value.'</b>', get_the_title()) . '</li>';
                $str = 'Visit Microsoft!';
                $pattern = '/'.$search_value.'/i';
                $html .= '<li><a href="'.get_the_permalink().'">' . preg_replace($pattern, '<b><u>'.$search_value.'</u></b>', get_the_title()) . '</a></li>';
                //$html .= '<li>' . preg_replace($search_value, '<b>'.$search_value.'</b>', get_the_title()) . '</li>';
            }
            $html .= '</ul>';
        } else {
            $html .= '<ul>'; 
            $html .= '<li>No Results Found</li>';
            $html .= '</ul>';
        }
        wp_reset_postdata();
    }
	echo json_encode($html);
    exit; // required. to end AJAX request.
}