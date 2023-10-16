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


add_action('woocommerce_before_main_content', 'mos_custom_page_title', 1);
function mos_custom_page_title () {
	?>

	<section class="page-title woocommerce-page-title">
        <div class="wrapper">
            <div class="container">
                <!-- <h1><?php //woocommerce_page_title(); ?></h1> -->
                <?php echo woocommerce_breadcrumb() ?>
            </div>
        </div>
    </section>
	<?php
}
add_action('yith_wacp_after_related_item', 'mos_custom_product_stock_status');
function mos_custom_product_stock_status () {
	global $product;
	//echo $product->get_id();
	?>
	<div class="mos-ststus"><?php echo do_shortcode('[product-status]'); ?></div>
	<?php
}
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
	//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_output_product_data_tabs', 10 );
	add_action( 'woocommerce_after_product_thumbnails' , 'woocommerce_output_product_data_tabs', 20 );

	remove_action( 'woocommerce_before_shop_loop_item' , 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item' , 'woocommerce_template_loop_product_link_close', 5 );

	remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_output_related_products', 20 );

	add_action( 'woocommerce_after_single_product' , 'woocommerce_output_related_products', 20 );


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
add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_open', 9);
add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close', 11);
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_link_open', 9);
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_link_close', 11);
add_action( 'woocommerce_shop_loop_item_title', 'mos_woocommerce_loop_text_wrapper', 1 );
add_action( 'woocommerce_single_product_summary', 'mos_upsell_products_show', 31 );
function mos_upsell_products_show () {
	global $product;
	$upsell_ids = $product->get_upsell_ids();
	if ($upsell_ids && is_array($upsell_ids)) : ?>
		<div class="woobt-wrap woobt-layout-separate woobt-wrap-<?php echo get_the_ID() ?> woobt-wrap-responsive" data-id="<?php echo get_the_ID() ?>" data-selection="multiple" data-total="0">
        	<div class="woobt-products woobt-products-<?php echo get_the_ID() ?>" >
		<?php foreach($upsell_ids as $upsell_id) : 
			$product = wc_get_product( $upsell_id );
			?>
				<form class="cart" method="post" enctype="multipart/form-data">
					<div class="mos-woobt-product mos-woobt-product-together d-flex flex-wrap">
						<div class="woobt-choose">
							<div class="woobt-thumb-ori" style="width:80px">
							<?php echo wp_get_attachment_image( $product->get_image_id(), 'thumbnail' );  ?>
							</div>
						</div>
						<div class="woobt-title">
							<div class="brand-name"><?php echo do_shortcode('[product-brand]')?></div>
							<span class="woobt-title-inner"><a href="<?php echo get_permalink( $upsell_id ) ?>"><span><?php echo $product->get_title() ?></span></a> </span>
							<div class="d-flex mos-woobt-price-rating">
							<div class="woobt-availability">
								<?php if ($product->get_stock_status() == 'outofstock') : ?>
								<p class="stock out-of-stock"><?php echo carbon_get_theme_option( 'mos-woocommerce-outofstock-text' )?></p>
								<?php elseif ($product->get_stock_status() == 'onbackorder') : ?>
								<p class="stock onbackorder"><?php echo carbon_get_theme_option( 'mos-woocommerce-backorder-text' )?></p>
								<?php else : ?>
								<p class="stock in-stock"><?php echo carbon_get_theme_option( 'mos-woocommerce-instock-text' );?></p>
								<?php endif?>
							</div>
							</div>
						</div>
						<div class="woobt-button d-flex flex-md-column justify-content-between align-items-end">
							<div class="woobt-price d-flex flex-md-column align-items-md-end gap-2 gap-md-0">
								<?php echo $product->get_price_html(); ?>
							</div>
							<?php
								if ($product->get_stock_status() == 'outofstock')
								$add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-outofstock' );
								else if ($product->get_type() == 'variable')
								$add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-variable' );
								else if ($product->get_type() == 'grouped')
								$add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-grouped' );
								else if ($product->get_type() == 'external') 
								$add_to_cart_text = get_post_meta($product->get_id(), '_button_text', true);   
								else
								$add_to_cart_text = carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text' );
							?>
							<button type="submit" name="add-to-cart" value="<?php echo $upsell_id ?>" class="single_add_to_cart_button button alt <?php echo $product->get_stock_status() ?>-button"><?php echo $add_to_cart_text ?></button>
						</div>
					</div>
				</form>
		<?php endforeach; ?>
		
			</div>
		</div>
	<?php endif;
}

add_action( 'woocommerce_after_shop_loop_item', 'mos_div_wrapper_end', 20 );
function mos_woocommerce_loop_text_wrapper () {
	?>
	<div class="text-wrapper">
	<?php
}

//add_action( 'woocommerce_product_thumbnails', 'mos_woocommerce_show_product_thumbnails', 20 );
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



//add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_short_description', 11, 0);
function mos_woocommerce_shop_loop_item_short_description() {
	global $product;
	?>
	<div class="mos-product-meta-3 mb-2">
		<div class="short-description mb-1"><?php echo $product->get_short_description(); ?></div>
		<div class="sku"><?php echo $product->get_sku(); ?></div>
	</div>
	<?php
}

add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_start', 12, 0);
function mos_woocommerce_shop_loop_item_title_meta_set_2_start() {
	?>
	<div class="mos-product-meta mos-product-meta-2 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center w-100">	
		    <!-- mos-product-meta mos-product-meta-2 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center w-100 -->
			<!-- mos-product-meta mos-product-meta-2 d-flex justify-content-between align-items-center w-100 -->
	<?php
};
function mos_customize_add_tocart(){
	if (carbon_get_theme_option( 'mos-woocommerce-show-price') == 'loggedin' && !is_user_logged_in()) {
		//loop
		add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_content', 12, 0);	
		//single
		remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_add_to_cart', 30 );
		add_action( 'woocommerce_single_product_summary' , 'mos_woocommerce_shop_loop_item_title_meta_set_2_content', 25 );		

	} else {
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 12, 0);
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 13, 0);
	}
}
add_action( 'wp_head', 'mos_customize_add_tocart' );
function mos_remove_product_addiotional_tabs(){
	if (carbon_get_theme_option( 'mos-woocommerce-hide-additional-tab')) {
		add_filter( 'woocommerce_product_tabs', 'mos_remove_product_tabs', 9999 );
	}	
}
add_action( 'wp_head', 'mos_remove_product_addiotional_tabs' );
function mos_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'mos_loop_shop_per_page', 20 );

function mos_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = carbon_get_theme_option( 'mos-woocommerce-archive-nop');
  return $cols;
}


add_action('woocommerce_shop_loop_item_title', 'mos_woocommerce_shop_loop_item_title_meta_set_2_end', 14, 0);


function mos_woocommerce_shop_loop_item_title_meta_set_2_content( ) {
	?>
	<div class="login-wrapper">
	<span class="text"><?php _e(carbon_get_theme_option( 'mos-woocommerce-login-advice-text'),'woocommerce'); ?></span>
	<!--  -->
	<a class="button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e(carbon_get_theme_option( 'mos-woocommerce-login-button-text'),'woocommerce'); ?>"><?php _e(carbon_get_theme_option( 'mos-woocommerce-login-button-text'),'woocommerce'); ?></a>
</div>
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
	//global $product;
	$product = wc_get_product( get_the_ID() );
	if($product){
		if ($product->get_stock_status() == 'outofstock')
		return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-outofstock' ), 'woocommerce' );
		else if ($product->get_type() == 'variable')
		return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-variable' ), 'woocommerce' );
		else if ($product->get_type() == 'grouped')
		return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text-grouped' ), 'woocommerce' );
		else if ($product->get_type() == 'external') 
		return __( get_post_meta($product->get_id(), '_button_text', true), 'woocommerce' );		   
		else
		return __( carbon_get_theme_option( 'mos-woocommerce-add-to-cart-text' ), 'woocommerce' );
	} 
	else
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
add_action('woocommerce_before_shop_loop', 'mos_view_change', 31);
function mos_view_change(){
	?>
	<div class="d-flex align-items-center">
		<a href="#" class="view-changer list-view <?php echo (@$_COOKIE['product_view_type'] && $_COOKIE['product_view_type']=='list')?'active':'' ?>" data-type="list">List View</a>
		<a href="#" class="view-changer grid-view <?php echo (!@$_COOKIE['product_view_type'] || $_COOKIE['product_view_type']=='grid')?'active':'' ?>" data-type="grid">Grid View</a>
	</div>
	<?php
}
add_action('woocommerce_before_shop_loop', 'mos_div_wrapper_end', 40);
add_action('woocommerce_single_product_summary', 'mos_out_of_stock_text', 30);
function mos_out_of_stock_text () {	
	global $product;
	if($product->get_stock_status() == 'outofstock') {
		echo '<span class="button mos-outofstock-single-button">'.carbon_get_theme_option( 'mos-woocommerce-outofstock-text' ).'</span>';
	}
}
add_action('woocommerce_single_product_summary', 'mos_usp_text', 30);
function mos_usp_text () {
	//mos-woocommerce-usp
	$usp = carbon_get_theme_option( 'mos-woocommerce-usp');
	if(sizeof($usp)): ?>
		<ul class="list-inline usp-group">
			<?php foreach($usp as $key => $value) : ?>
			<li class="list-inline-item position-relative">
				<?php if ($value["image"]) : ?>
					<?php echo wp_get_attachment_image( $value["image"], "full", "", array( "class" => "img-usp img-fluid" ) );  ?>
				<?php endif?>
				<?php if ($value["title"]) : ?>
					<span class="usp-text"><?php echo do_shortcode($value["title"]) ?></span>
				<?php endif?>
				<?php if ($value["link"]) : ?>
					<a class="hidden-link" href="<?php echo do_shortcode($value["link"]) ?>">Read more about <?php echo do_shortcode($value["title"]) ?></a>
				<?php endif?>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php endif;
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 33);

add_action('woocommerce_before_single_product', function() {mos_div_wrapper_start('before-product-single text-center');}, 0);
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_rating', 5);
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_title', 6);
add_action( 'woocommerce_before_single_product', 'mos_div_wrapper_end', 7);


add_action( 'woocommerce_single_product_summary', 'comments_template', 33);
add_filter( 'woocommerce_product_review_tab_title', 'change_review_tab_title', 10, 2 ); 
 
function change_review_tab_title( $title, $product ) { 
    $count = $product->get_review_count(); 
    $title = sprintf( __( 'Reviews (%d)', 'woocommerce' ), $count ); 
    return $title; 
} 
// function mos_product_reply(){
//   comments_template();
// }
function mos_product_reply () {
	global $product;
	var_dump(have_comments());
	if ( ! comments_open() ) {
		return;
	}
	
	?>
	<div id="reviews" class="woocommerce-Reviews">
		<div id="comments">
			<h2 class="woocommerce-Reviews-title">
				<?php
				$count = $product->get_review_count();
				if ( $count && wc_review_ratings_enabled() ) {
					// translators: 1: reviews count 2: product name
					$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
					echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
				} else {
					esc_html_e( 'Reviews', 'woocommerce' );
				}
				?>
			</h2>
	
			<?php if ( $count ) : ?>
				<ol class="commentlist">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>
	
				<?php
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links(
						apply_filters(
							'woocommerce_comment_pagination_args',
							array(
								'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
								'next_text' => is_rtl() ? '&larr;' : '&rarr;',
								'type'      => 'list',
							)
						)
					);
					echo '</nav>';
				endif;
				?>
			<?php else : ?>
				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
			<?php endif; ?>
		</div>
	
		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form_wrapper">
				<div id="review_form">
					<?php
					$commenter    = wp_get_current_commenter();
					$comment_form = array(
						// translators: %s is product title 
						'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						// translators: %s is product title
						'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
						'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</span>',
						'comment_notes_after' => '',
						'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
						'logged_in_as'        => '',
						'comment_field'       => '',
					);
	
					$name_email_required = (bool) get_option( 'require_name_email', 1 );
					$fields              = array(
						'author' => array(
							'label'    => __( 'Name', 'woocommerce' ),
							'type'     => 'text',
							'value'    => $commenter['comment_author'],
							'required' => $name_email_required,
						),
						'email'  => array(
							'label'    => __( 'Email', 'woocommerce' ),
							'type'     => 'email',
							'value'    => $commenter['comment_author_email'],
							'required' => $name_email_required,
						),
					);
	
					$comment_form['fields'] = array();
	
					foreach ( $fields as $key => $field ) {
						$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
						$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );
	
						if ( $field['required'] ) {
							$field_html .= '&nbsp;<span class="required">*</span>';
						}
	
						$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';
	
						$comment_form['fields'][ $key ] = $field_html;
					}
	
					$account_page_url = wc_get_page_permalink( 'myaccount' );
					if ( $account_page_url ) {
						// translators: %s opening and closing link tags respectively
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
					}
	
					if ( wc_review_ratings_enabled() ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
						</select></div>';
					}
	
					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';
	
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>
		<?php else : ?>
			<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	
		<div class="clear"></div>
	</div>
	<?php
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );
    return $tabs;
}

/*
add_filter( 'woocommerce_product_tabs','woocommerce_product_reviews_tab');
//remove_action( 'woocommerce_product_tab_panels','woocommerce_product_reviews_panel', 30);
function woocommerce_product_reviews_tab ( $tabs ) {
    //unset( $tabs['additional_information'] ); 
	unset( $tabs['reviews'] );
    return $tabs;
}

add_action('woocommerce_single_product_summary', 'mos_product_reply', 32);
function mos_product_reply () {
	global $product;

	if ( ! comments_open() ) {
		return;
	}
	
	?>
	<div id="reviews" class="woocommerce-Reviews">
		<div id="comments">
			<h2 class="woocommerce-Reviews-title">
				<?php
				$count = $product->get_review_count();
				if ( $count && wc_review_ratings_enabled() ) {
					// translators: 1: reviews count 2: product name
					$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
					echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
				} else {
					esc_html_e( 'Reviews', 'woocommerce' );
				}
				?>
			</h2>
	
			<?php if ( have_comments() ) : ?>
				<ol class="commentlist">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>
	
				<?php
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links(
						apply_filters(
							'woocommerce_comment_pagination_args',
							array(
								'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
								'next_text' => is_rtl() ? '&larr;' : '&rarr;',
								'type'      => 'list',
							)
						)
					);
					echo '</nav>';
				endif;
				?>
			<?php else : ?>
				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
			<?php endif; ?>
		</div>
	
		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form_wrapper">
				<div id="review_form">
					<?php
					$commenter    = wp_get_current_commenter();
					$comment_form = array(
						// translators: %s is product title 
						'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						// translators: %s is product title
						'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
						'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</span>',
						'comment_notes_after' => '',
						'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
						'logged_in_as'        => '',
						'comment_field'       => '',
					);
	
					$name_email_required = (bool) get_option( 'require_name_email', 1 );
					$fields              = array(
						'author' => array(
							'label'    => __( 'Name', 'woocommerce' ),
							'type'     => 'text',
							'value'    => $commenter['comment_author'],
							'required' => $name_email_required,
						),
						'email'  => array(
							'label'    => __( 'Email', 'woocommerce' ),
							'type'     => 'email',
							'value'    => $commenter['comment_author_email'],
							'required' => $name_email_required,
						),
					);
	
					$comment_form['fields'] = array();
	
					foreach ( $fields as $key => $field ) {
						$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
						$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );
	
						if ( $field['required'] ) {
							$field_html .= '&nbsp;<span class="required">*</span>';
						}
	
						$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';
	
						$comment_form['fields'][ $key ] = $field_html;
					}
	
					$account_page_url = wc_get_page_permalink( 'myaccount' );
					if ( $account_page_url ) {
						// translators: %s opening and closing link tags respectively
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
					}
	
					if ( wc_review_ratings_enabled() ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
						</select></div>';
					}
	
					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';
	
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>
		<?php else : ?>
			<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	
		<div class="clear"></div>
	</div>
	<?php
}
*/
add_action('woocommerce_archive_description', 'mos_archive_banner', 1);
function mos_archive_banner() {
	$term_id = get_queried_object_id();
	$banner_image = carbon_get_term_meta( $term_id, 'mos_product_cat_banner_image' );
	if($banner_image){
		echo wp_get_attachment_image( $banner_image, "full", "", array( "class" => "w-100 img-fluid mb-4" ) );
	}
}
add_action('woocommerce_archive_description', 'mos_archive_banner_title', 2);
function mos_archive_banner_title() {
	echo '<h1 class="woocommerce-products-header__title page-title mb-3">';
	woocommerce_page_title();
	echo '</h1>';
}
// add_action( 'woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 10);
add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 3);

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
add_action( 'woocommerce_archive_description', 'mos_woocommerce_maybe_show_product_subcategories', 4);
function mos_woocommerce_maybe_show_product_subcategories() {
	$display_type = woocommerce_get_loop_display_mode();
	//var_dump($display_type);
	if ( 'subcategories' === $display_type || 'both' === $display_type ) {
		echo '<ul class="category-child-slider">';
		woocommerce_output_product_categories(
			array(
				'parent_id' => is_product_category() ? get_queried_object_id() : 0,
			)
		);
		echo '</ul>';
	}
	if ( 'subcategories' === $display_type ) {
		wc_set_loop_prop( 'total', 0 );

		// This removes pagination and products from display for themes not using wc_get_loop_prop in their product loops.  @todo Remove in future major version.
		global $wp_query;

		if ( $wp_query->is_main_query() ) {
			$wp_query->post_count    = 0;
			$wp_query->max_num_pages = 0;
		}
	}
}

add_filter( 'get_product_search_form' , 'mos_woo_custom_product_searchform' );

// remove_filter( string $hook_name, callable|string|array $callback, int $priority = 10 );
/**
 * mos_woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function mos_woo_custom_product_searchform( $form ) {
	$product_cat = mos_get_terms('product_cat');
	//var_dump($product_cat);
	$options = '';
	foreach($product_cat as $cat) {
		$selected = (@$_GET['category'] && $_GET['category'] == $cat["slug"])?'selected':'';
		$options .= '<option '.$selected.' value="'.$cat["slug"].'">'.$cat["name"].'</option>';
	}
	ob_start(); ?>
	<form role="search" method="get" class="searchform" id="searchform" action="<?php echo esc_url( home_url( '/'  ) )?>">
		<div class="input-group">
			<label class="screen-reader-text" for="s"><?php echo __( 'Search for:', 'woocommerce' )?></label>
			
			<select name="category" class="form-select mos-product-categories d-none" id="inputGroupSelect01">
				<option value="">All Categories</option><?php echo $options?>
			</select>
			<!-- <input class="form-control mos-product-search" type="text" name="s" id="s" placeholder="<?php echo esc_html__( 'Search for Products', 'woocommerce' )?>" autocomplete="off" value="<?php echo get_search_query()?>" required oninvalid="this.setCustomValidity('Please type your keywords here.')" onvalid="this.setCustomValidity('')" /> -->
			<input class="form-control mos-product-search" type="text" name="s" id="s" placeholder="<?php echo _mos_translate( 'Search for products', true )?>" autocomplete="off" value="<?php echo get_search_query()?>" required oninvalid="this.setCustomValidity('<?php echo _mos_translate('Please enter your keywords here', true) ?>')" onvalid="this.setCustomValidity('')" />
			<button type="submit" id="searchsubmit" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18.382" height="18.34" viewBox="0 0 18.382 18.34">
<g id="searc-icon" transform="translate(-1250 -76)">
<path id="Search" d="M1658.563,1091.246l-2.828-2.828c-.025-.024-.058-.034-.084-.056a8.487,8.487,0,1,0-1.381,1.394.758.758,0,0,0,.051.076l2.828,2.83a1,1,0,0,0,1.414-1.416Zm-9.589-1.633a6.5,6.5,0,1,1,6.5-6.5A6.508,6.508,0,0,1,1648.974,1089.613Z" transform="translate(-390.474 -998.613)"></path>
</g>
</svg>
            </button> 
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>
	<?php $form = ob_get_clean();	
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

function mos_div_wrapper_start($class_name = '') {
    echo '<div class="'.$class_name .'">';
}
function mos_div_wrapper_end() {
    echo '</div>';
}

/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	//unset( $tabs['reviews'] );
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
					echo '<div class="tab-intro">'.$product_tab['intro'].'</div>';		
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
    //$tabs['reviews']['priority'] = 30;
    return $tabs;
}

function theme_pgp( $query ) {

    if( is_admin() ) {
        return;                 // If we're in the admin panel - drop out
    }

    if( $query->is_main_query() && $query->is_search() ) {      // Apply to all search queries

        // IF our category is set and not empty - include it in the query
        if( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
            $query->set( 'tax_query', array( array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => array( sanitize_text_field( $_GET['category'] ) ),
            ) ) );
        }
    }
}
add_action( 'pre_get_posts', 'theme_pgp' );
/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}

function tax_cat_active( $output, $args ) {

if(is_single()){
	global $post;

	$terms = get_the_terms( $post->ID, $args['taxonomy'] );
	foreach( $terms as $term )
		if ( preg_match( '#cat-item-' . $term ->term_id . '#', $output ) )
			$output = str_replace('cat-item-'.$term ->term_id, 'cat-item-'.$term ->term_id . ' current-cat', $output);
}

return $output;
}
add_filter( 'wp_list_categories', 'tax_cat_active', 10, 2 );

add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

function custom_get_availability( $availability, $_product ) {
  global $product;
  $stock = $product->get_stock_quantity();

  if ( $_product->is_in_stock() ) $availability['availability'] = carbon_get_theme_option( 'mos-woocommerce-instock-text' );
  elseif ( $_product->is_on_backorder() ) $availability['availability'] = carbon_get_theme_option( 'mos-woocommerce-backorder-text' );
  else $availability['availability'] = carbon_get_theme_option( 'mos-woocommerce-outofstock-text' );

  return $availability;
}

add_filter( 'woocommerce_product_tabs', 'misha_rename_description_tab' );
function misha_rename_description_tab( $tabs ) {
	$tabs[ 'description' ][ 'title' ] = 'Overview';
	return $tabs;
}
// Display Fields
//add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');

// Save Fields
//add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');


function woocommerce_product_custom_fields() {
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Taxable amount
    woocommerce_wp_text_input(
        array(
            'id' => '_mos_product_purchase_price',
            //'placeholder' => 'Custom Product Number Field',
            'label' => __('Purchase price', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product Number Field
    /*woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_number_field',
            'placeholder' => 'Custom Product Number Field',
            'label' => __('Custom Product Number Field', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
            'placeholder' => 'Custom Product Textarea',
            'label' => __('Custom Product Textarea', 'woocommerce')
        )
    );*/
    echo '</div>';
}
function woocommerce_product_custom_fields_save($post_id) {
    // Custom Product Text Field
    $woocommerce_mos_product_purchase_price = $_POST['_mos_product_purchase_price'];
    if (!empty($woocommerce_mos_product_purchase_price))
        update_post_meta($post_id, '_mos_product_purchase_price', esc_attr($woocommerce_mos_product_purchase_price));
// Custom Product Number Field
    /*$woocommerce_custom_product_number_field = $_POST['_custom_product_number_field'];
    if (!empty($woocommerce_custom_product_number_field))
        update_post_meta($post_id, '_custom_product_number_field', esc_attr($woocommerce_custom_product_number_field));
// Custom Product Textarea Field
    $woocommerce_custom_procut_textarea = $_POST['_custom_product_textarea'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_custom_product_textarea', esc_html($woocommerce_custom_procut_textarea));*/

}
//add_action( 'woocommerce_before_calculate_totals', 'custom_cart_items_prices', 10, 1 );
function custom_cart_items_prices( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
	if (get_option('woocommerce_calc_taxes') == 'yes' && get_option('woocommerce_prices_include_tax') == 'no'){
		// Loop Through cart items
		$tax = new WC_Tax();
		$WC_Order_Item_Product = new WC_Order_Item_Product();
		foreach ( $cart->get_cart() as $cart_item ) {
			// Get the product id (or the variation id)
			$product_id = $cart_item['data']->get_id();
			$product = $cart_item['data'];
			$mos_product_purchase_price = get_post_meta($product->get_id(),'_mos_product_purchase_price', true);

			$taxes = $tax->get_rates($product->get_tax_class());
			$rates = array_shift($taxes);
			//Take only the item rate and round it. 
			$item_rate = round(array_shift($rates));
			// GET THE NEW PRICE (code to be replace by yours)
			$old_price = $product->get_price();

			$price = ($product->get_price())/(1 + $item_rate/100);
			$new_tax = ($price - $mos_product_purchase_price)*$item_rate/100;
			//$cart_item['data']->set_price( 100 - 25 ); 
			//$cart_item['data']->set_tax_class( 'zero-rate' ); 
			//$WC_Order_Item_Product->set_taxes( 25 );
			//var_dump($cart_item);
		}
	}
}
/**
*  Add custom handling fee to an order 
*/
function mos_add_handling_fee() {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
	if(carbon_get_theme_option( 'mos-woocommerce-vmb')){
		global $woocommerce;
		global $new_total_tax;
		$tax = new WC_Tax();
		$total_tax_reduiced = $item_rate = $item_tax = $raw_tax = $raw_profit =0;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			//$product_id = $cart_item['product_id'];
			$product = $cart_item['data'];
			$mos_product_purchase_price = get_post_meta($cart_item['product_id'],'_mos_product_purchase_price', true);
			if ($mos_product_purchase_price) {
				$taxes = $tax->get_rates($product->get_tax_class());
				$rates = array_shift($taxes);
				if (is_array($taxes) && is_array($rates)){
					//Take only the item rate and round it. 
					$item_rate = round(array_shift($rates));
					if (get_option('woocommerce_calc_taxes') == 'yes'){
						if (get_option('woocommerce_prices_include_tax') == 'yes'){
							$price = $product->get_price();
							$profit_with_tax = $price - $mos_product_purchase_price;
							$raw_profit = $profit_with_tax/(1 + $item_rate/100);
							$raw_tax = round($profit_with_tax - (($profit_with_tax)/(1 + $item_rate/100)));
							$item_tax = round($product->get_price() - (($product->get_price())/(1 + $item_rate/100))) * $cart_item['quantity'];
							//$item_tax = $woocommerce->cart->get_taxes_total();
							$new_tax = $raw_tax * $cart_item['quantity'];
						}
						// else {
						// 	$price = (get_post_meta($cart_item['product_id'], '_sale_price', true))?get_post_meta($cart_item['product_id'], '_sale_price', true):get_post_meta($cart_item['product_id'], '_regular_price', true);
						// 	$item_tax = round($price * $item_rate/100);
						// 	$new_tax = ($price - $mos_product_purchase_price)*$item_rate/100;
						// }				
						$item_tax_reduced = $item_tax - $new_tax;
						$total_tax_reduiced += $item_tax_reduced;
					}
				}
			}
		}
		// $title2 = "Get_taxes_total: " . $woocommerce->cart->get_taxes_total() . ", New tax: " .$new_tax;
		// $fee2 = 0;
		// $woocommerce->cart->add_fee( $title2, $fee2, TRUE, 'standard' );

		if (get_option('woocommerce_calc_taxes') == 'yes'){
			$new_total_tax = $woocommerce->cart->get_taxes_total() - $total_tax_reduiced;
			add_filter( 
				'woocommerce_cart_taxes_total', 
				function(){
					global $new_total_tax;
					return $new_total_tax;
				}, 
				10, 
				4 
			);
		}
		//$title =  'Enable taxes: ' . get_option('woocommerce_calc_taxes') . ', Prices entered with tax: ' . get_option('woocommerce_prices_include_tax');
		//$title = "Title";
		
		// $fee = 0.00;
		// $woocommerce->cart->add_fee( $title, $fee, TRUE, 'standard' );
		//var_dump($woocommerce->cart->get_tax_totals());
		//$woocommerce->cart->get_tax_totals()
		//*$woocommerce->cart->get_taxes_total()
		//$woocommerce->cart->get_taxes()
		//echo $woocommerce->cart->get_taxes();
		//$WC_Order_Item_Tax->set_tax_total( $value );
	}
}
 
// Action -> Add custom handling fee to an order
add_action( 'woocommerce_cart_calculate_fees', 'mos_add_handling_fee' );
function mos_show_regular_price_on_cart( $price, $values, $cart_item_key ) { 
   $is_on_sale = $values['data']->is_on_sale(); 
   if ( $is_on_sale ) { 
        $_product = $values['data'];
        $regular_price = $_product->get_regular_price();
        $price = '<span class="wpd-discount-price" style="text-decoration: line-through; opacity: 0.5; padding-right: 5px;">' . wc_price( $regular_price ) . '</span>' . $price; 
   } 
   return $price; 
}
add_filter( 'woocommerce_cart_item_price', 'mos_show_regular_price_on_cart', 30, 3 );

//add_filter( 'woocommerce_cart_taxes_total', 'wp_kama_woocommerce_cart_taxes_total_filter', 10, 4 );
function wp_kama_woocommerce_cart_taxes_total_filter( $total, $compound, $display, $that ){
	// filter...
	return 100;
}
// function get_product_data(){
// 	$product = wc_get_product( 11086 );
// 	var_dump($product);
// }
// add_action('wp_head', 'get_product_data');
// add_action( 'woocommerce_cart_totals_after_order_total', 'uw_display_cart_totals_after' );
// add_action( 'woocommerce_review_order_after_order_total', 'uw_display_cart_totals_after' );
add_action( 'woocommerce_cart_totals_before_order_total', 'uw_display_cart_totals_after', 99 );
/**
 * Pulls in cart totals and adds a new table row to the cart/checkout totals
 *
 * @author UltimateWoo - https://www.ultimatewoo.com
 */
function uw_display_cart_totals_after() {
	if(carbon_get_theme_option( 'mos-woocommerce-vmb')){
		global $woocommerce;
		global $new_total_tax;
		$tax = new WC_Tax();
		$total_tax_reduiced = $item_rate = $item_tax = $raw_tax = $raw_profit = $total_profit = 0;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			//$product_id = $cart_item['product_id'];
			$product = $cart_item['data'];
			$mos_product_purchase_price = get_post_meta($cart_item['product_id'],'_mos_product_purchase_price', true);
			if ($mos_product_purchase_price) {
				$taxes = $tax->get_rates($product->get_tax_class());
				$rates = array_shift($taxes);
				//Take only the item rate and round it. 
				$item_rate = round(array_shift($rates));
				if (get_option('woocommerce_calc_taxes') == 'yes'){
					if (get_option('woocommerce_prices_include_tax') == 'yes'){
						$price = $product->get_price();
						$profit_with_tax = $price - $mos_product_purchase_price;
						$raw_profit = $profit_with_tax/(1 + $item_rate/100) * $cart_item['quantity'];
						$raw_tax = round($profit_with_tax - (($profit_with_tax)/(1 + $item_rate/100)));
						$item_tax = $woocommerce->cart->get_taxes_total();
						$new_tax = $raw_tax * $cart_item['quantity'];
					}
					$total_profit += $raw_profit;
				}
			}
		}
		if ($total_profit) {
			?>
			<tr class="taxable-amount" id="final-total">
				<th><?php _e( 'Taxable amount', 'woocommerce' ); ?></th>
				<td><?php echo $total_profit . get_woocommerce_currency_symbol() ?></td>
			</tr>
			<?php
		}
	}
}
function mos_cross_sale_product_popup () {
	?>
	<!-- Modal -->
<div class="modal fade" id="crossProductModal" tabindex="-1" aria-labelledby="crossProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-0">
        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body p-4">loading...</div>
    </div>
  </div>
</div>
	<?php
}
add_action('wp_footer', 'mos_cross_sale_product_popup');