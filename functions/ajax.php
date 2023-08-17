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
            'posts_per_page' => 5,
            's' => $search_value
        );
        if ($_POST['search_category']) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $_POST['search_category'],
                )
            );
        }
        // The Query
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            $html .= '<ul id="suggestions">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $product = wc_get_product( get_the_ID() );
                $str = 'Visit Microsoft!';
                $pattern = '/'.$search_value.'/i';
                $html .= '<li class="suggestion-unit"><a class="d-flex align-items-center gap-2" href="'.get_the_permalink().'">';
                $html .= '<span class="product-image"><img src="'.aq_resize(get_the_post_thumbnail_url(get_the_ID(), 'full'), 100, 100, true).'"/></span>';
                $html .= '<span class="product-data d-block">';
                $html .= '<span class="product-brand d-block text-theme">'.do_shortcode("[product-brand]").'</span>';
                $html .= '<span class="product-name d-block">';
                $html .= preg_replace($pattern, '<b><u>'.$search_value.'</u></b>', get_the_title());
                $html .= '</span>';
                $html .= '<span class="product-price d-block">'.$product->get_price_html().'</span>';
                $html .= '</span>';
                $html .= '</a></li>';
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

add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart'); 
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');          
function ql_woocommerce_ajax_add_to_cart() {  
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id); 
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 
        do_action('ql_woocommerce_ajax_added_to_cart', $product_id);      
        $product = wc_get_product( $product_id );
        $image_id = $product->get_image_id();
        $cross_sell_ids = $product->get_cross_sell_ids();;
        ob_start();
        ?>
            <div class="alert alert-success rounded-0" role="alert"><img class="me-2" src="<?php echo get_template_directory_uri() ?>/images/green-tick-icon.svg" alt="" width="25px" height="25px"><?php _e_mos_translate('The product has been added to your shopping cart')?></div>
            <div class="product-details d-flex gap-2 align-items-center">
                <div class="part-media"><?php echo wp_get_attachment_image( $image_id );  ?></div>
                <div class="part-title">
                    <div class="product-brand"><?php echo $product->get_attribute( 'brand' ); ?></div>
                    <h3 class="product-title"><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo $product->get_title() ?></a></h3>
                    <div class="part-price"><?php echo $product->get_price_html(); ?></div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                <a href="<?php echo wc_get_cart_url() ?>" class="btn btn-cross-sale-cart"><?php _e_mos_translate('Cart')?></a>
                <a href="<?php echo wc_get_checkout_url() ?>" class="btn btn-cross-sale-checkout"><?php _e_mos_translate('Checkout')?></a>
            </div>
            <?php if ($cross_sell_ids) : ?>
            <div class="group-product-details">
                <h2 class="cross-sale-title"><?php _e_mos_translate('Suggested Products')?></h2>
                <?php foreach($cross_sell_ids as $cross_sell_id) : 
                    $cross_product = wc_get_product( $cross_sell_id );                    
                    $cross_image_id = $cross_product->get_image_id();

                    if ($cross_product->get_stock_status() == 'outofstock')
                    $add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-outofstock' );
                    else if ($cross_product->get_type() == 'variable')
                    $add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-variable' );
                    else if ($cross_product->get_type() == 'grouped')
                    $add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-grouped' );
                    else if ($cross_product->get_type() == 'external') 
                    $add_to_cart_text = get_post_meta($cross_product->get_id(), '_button_text', true);   
                    else
                    $add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text' );

                    ?>
                    <div class="product-details d-flex gap-2 align-items-center">
                        <div class="part-media"><?php echo wp_get_attachment_image( $cross_image_id );  ?></div>
                        <div class="part-title w-100">
                            <div class="product-brand"><?php echo $cross_product->get_attribute( 'brand' ); ?></div>
                            <h3 class="product-title"><a href="<?php echo esc_url( get_permalink( $cross_sell_id ) ); ?>"><?php echo $cross_product->get_title() ?></a></h3>
                            <div class="part-price"><?php echo $cross_product->get_price_html(); ?></div>
                            <div class="product-availability">
								<?php if ($cross_product->get_stock_status() == 'outofstock') : ?>
								<span class="stock out-of-stock"><?php _e_mos_translate('Out of Stock')?></span>
								<?php elseif ($cross_product->get_stock_status() == 'onbackorder') : ?>
								<span class="stock onbackorder"><?php _e_mos_translate('On backorder')?></span>
								<?php else : ?>
								<span class="stock in-stock"><?php _e_mos_translate('In Stock')?></span>
								<?php endif?>
							</div>
                            <div class="part-link d-block d-lg-none">                           
                                <a href="?add-to-cart=<?php echo $cross_sell_id ?>" data-quantity="1" class="btn product_type_simple add_to_cart_button ajax_add_to_cart  <?php echo $cross_product->get_stock_status() ?>-button" data-product_id="<?php echo $cross_sell_id ?>" data-product_sku="APA269" aria-label="Add “<?php echo $cross_product->get_title() ?>” to your cart" aria-describedby="" rel="nofollow"><?php echo $add_to_cart_text ?></a>
                            </div>
                        </div>
                        <div class="part-link d-none d-lg-block">                           
                            <a href="?add-to-cart=<?php echo $cross_sell_id ?>" data-quantity="1" class="btn product_type_simple add_to_cart_button ajax_add_to_cart  <?php echo $cross_product->get_stock_status() ?>-button" data-product_id="<?php echo $cross_sell_id ?>" data-product_sku="APA269" aria-label="Add “<?php echo $cross_product->get_title() ?>” to your cart" aria-describedby="" rel="nofollow"><?php echo $add_to_cart_text ?></a>
                        </div>
                    </div>
                <?php endforeach?>
            </div>
            <?php endif?>
        <?php
        $data['html'] = ob_get_clean();
        
        //$data['html'] = 'HTML';
        echo wp_send_json($data);
        if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) { 
            wc_add_to_cart_message(array($product_id => $quantity), true); 
        } 
        WC_AJAX :: get_refreshed_fragments(); 
    } else { 
            $data = array( 
                'error' => true,
                'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
            echo wp_send_json($data);
    }
    wp_die();
}