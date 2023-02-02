<?php
/**
 * Remove the title
 */
add_filter( 'woocommerce_show_page_title', 'hide_shop_page_title' ); 
function hide_shop_page_title( $title ) {
   if ( is_shop() ) $title = false;
   return $title;
}

// remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );



add_action( 'wp_head', 'mos_customize_woo_action' );
function mos_customize_woo_action() {
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	if (is_single()) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	} else {
		add_action('woocommerce_before_main_content', 'mos_bootstrap_row_start',2);//Row start
		add_action('woocommerce_before_main_content', 'mos_bootstrap_col_9_start',3);//Col 9 Start
		add_action('woocommerce_after_main_content', 'mos_div_wrapper_end',100);//Col 9 End
		add_action('woocommerce_after_main_content', 'mos_bootstrap_col_3_start',101);//Col 3 Start
		add_action('woocommerce_sidebar', 'mos_div_wrapper_end',11);//Col 3 End
		add_action('woocommerce_sidebar', 'mos_div_wrapper_end',12);//Row 3 End
	}
}
add_action( 'woocommerce_product_thumbnails', 'mos_woocommerce_show_product_thumbnails', 20 );
function mos_woocommerce_show_product_thumbnails () {
	global $product;

	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids && $product->get_image_id() ) { ?>
		<div class="flex-control-nav flex-control-thumbs owl-carousel owl-theme">
		<?php foreach ( $attachment_ids as $attachment_id ) : ?>
			<a class="fancybox-active" href="<?php echo wp_get_attachment_url($attachment_id)?>" data-fancybox="<?php echo $product->get_id() ?>">
			<?php echo wp_get_attachment_image( $attachment_id, "thumbnail", "", array( 
				"class" => "img-responsive img-fluid img-product-thumbnail"
				//"100"=> aq_resize(wp_get_attachment_url($attachment_id), 100, 100, true)
			));
			//echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>
			</a>
		<?php endforeach?>
		</div>
		<?php 
	}
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'mos_first_sort_by_stock_amount', 9999 );
 
function mos_first_sort_by_stock_amount( $args ) {
   $args['orderby'] = 'meta_value';
   $args['meta_key'] = '_stock_status';
   return $args;
}
add_action('woocommerce_single_product_summary', 'mos_woocommerce_single_product_summary', 4);
function mos_woocommerce_single_product_summary() {
	?>
	<div class="mos-product-meta mos-product-meta-1 d-flex justify-content-between align-items-center w-100">
		<div class="mos-brand"><?php echo do_shortcode('[product-brand]'); ?></div>
	</div>
	    
	<?php
};
add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_1', 8, 0);
function mos_woocommerce_shop_loop_item_title_meta_set_1( ) {
	?>
	<div class="mos-product-meta mos-product-meta-1 d-flex justify-content-between align-items-center w-100">
		<div class="mos-brand"><?php echo do_shortcode('[product-brand]'); ?></div>
		<div class="mos-ststus"><?php echo do_shortcode('[product-status]'); ?></div>
	</div>
	    
	<?php
};



add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_start', 11, 0);
function mos_woocommerce_shop_loop_item_title_meta_set_2_start( ) {
	?>
	<div class="mos-product-meta mos-product-meta-2 d-flex justify-content-between align-items-center w-100">	    
	<?php
};
function mos_customize_add_tocart(){
	if (carbon_get_theme_option( 'mos-woocommerce-show-price') == 'loggedin' && !is_user_logged_in()) {
		add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_content', 12, 0);
	} else {
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 12, 0);
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 13, 0);
	}
}
add_action( 'wp_head', 'mos_customize_add_tocart' );
add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_end', 14, 0);


function mos_woocommerce_shop_loop_item_title_meta_set_2_content( ) {
	?>
	<span class="text">Lonin to see price</span>
	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login',''); ?>"><?php _e('Login',''); ?></a>
	<?php
}
function mos_woocommerce_shop_loop_item_title_meta_set_2_end( ) {
	?>
	</div>	    
	<?php
};
add_action( 'woocommerce_before_single_product_summary', 'mos_woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'mos_woocommerce_show_product_loop_sale_flash', 9 );
function mos_woocommerce_show_product_loop_sale_flash () {
	global $product;
	$discount = $discountP = 0;
	if ($product->get_sale_price()) {
		$discount = $product->get_regular_price() - $product->get_sale_price();
		$discountP = $discount * 100 / $product->get_regular_price();
	
	/**
	 * $product->get_regular_price();
	 * $product->get_sale_price();
	 */
	?>
	<div class="product-labels labels-rectangular"><span class="mos-onsale mos-product-label">-<?php echo number_format($discountP) ?>%</span></div>
	<?php
	}
}

// Change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'mos_woocommerce_add_to_cart_button_text_single' ); 
function mos_woocommerce_add_to_cart_button_text_single() {
    return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text' ), 'woocommerce' ); 
}
// Change add to cart text on product archives page
add_filter( 'woocommerce_product_add_to_cart_text', 'mos_woocommerce_add_to_cart_button_text_archives' );  
function mos_woocommerce_add_to_cart_button_text_archives() {
    return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text' ), 'woocommerce' );
}

add_action('woocommerce_before_main_content', 'mos_bootstrap_wrapper_start', 1);
function mos_bootstrap_wrapper_start() {
    echo '<section id="shop-main"><div class="wrapper"><div class="container-xxl">';
}
add_action('woocommerce_sidebar', 'mos_bootstrap_wrapper_end', 100);
function mos_bootstrap_wrapper_end() {
    echo '</div></div></section>';
}

add_action('woocommerce_before_shop_loop', function() {mos_flex_wrapper_start('before-product-list');}, 19);
add_action('woocommerce_before_shop_loop', 'mos_div_wrapper_end', 31);

add_filter( 'get_product_search_form' , 'mos_woo_custom_product_searchform' );

/**
 * mos_woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function mos_woo_custom_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div class="input-group">
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
			<input class="form-control mos-product-search" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for Products', 'woocommerce' ) . '" />
			<button type="submit" id="searchsubmit" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18.382" height="18.34" viewBox="0 0 18.382 18.34">
<g id="searc-icon" transform="translate(-1250 -76)">
<path id="Search" d="M1658.563,1091.246l-2.828-2.828c-.025-.024-.058-.034-.084-.056a8.487,8.487,0,1,0-1.381,1.394.758.758,0,0,0,.051.076l2.828,2.83a1,1,0,0,0,1.414-1.416Zm-9.589-1.633a6.5,6.5,0,1,1,6.5-6.5A6.508,6.508,0,0,1,1648.974,1089.613Z" transform="translate(-390.474 -998.613)"></path>
</g>
</svg>
            </button> 
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	
	return $form;
	
}

function mos_bootstrap_row_start() {
    echo '<div class="row">';
}
function mos_bootstrap_col_9_start() {
    echo '<div class="col-lg-9">';
}
function mos_bootstrap_col_3_start() {
    echo '<div class="col-lg-3 order-lg-first">';
}
function mos_flex_wrapper_start($class_name = '') {
    echo '<div class="d-flex justify-content-between align-items-center '.$class_name .'">';
}

function mos_div_wrapper_end() {
    echo '</div>';
}

/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	global $product;
	$product_tabs = carbon_get_post_meta( $product->get_id(), 'mos_product_tabs' );
	// Adds the new tab
	if(@$product_tabs && sizeof($product_tabs)) {
		foreach($product_tabs as $index=>$product_tab) {
			$tabs['custom_tab_'.$index] = array(
				'title' 	=> __( $product_tab['title'], 'woocommerce' ),
				'priority' 	=> 50,
				'callback' 	=> function () use ($product_tab) {
					// The new tab content		
					echo '<h2 class="tab-title">'.$product_tab['title'].'</h2>';
					echo $product_tab['intro'];			
				}
			);
		}
	}
	


	return $tabs;

}
function woo_new_product_tab_content() {

	// The new tab content

	echo '<h2 class="tab-title">New Product Tab</h2>';
	echo '<p>Here\'s your new product tab.</p>';
	
}

add_filter( 'woocommerce_product_tabs', 'mos_woo_move_description_tab', 98);
function mos_woo_move_description_tab($tabs) {
	global $product;
	$product_tabs = carbon_get_post_meta( $product->get_id(), 'mos_product_tabs' );
	if(@$product_tabs && sizeof($product_tabs)) {
		foreach($product_tabs as $index=>$product_tab) {
			$tabs['custom_tab_'.$index]['priority'] = 15 + $index;
		}
	}
    //$tabs['test_tab']['priority'] = 15;
    $tabs['reviews']['priority'] = 110;
    return $tabs;
}