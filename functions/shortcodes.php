<?php
function admin_shortcodes_page(){
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
    add_menu_page( 
        __( 'Theme Short Codes', 'textdomain' ),
        'Short Codes',
        'manage_options',
        'shortcodes',
        'shortcodes_page',
        'dashicons-book-alt',
        3
    ); 
}
add_action( 'admin_menu', 'admin_shortcodes_page' );
function shortcodes_page(){
	?>
<div class="wrap">
    <h1>Theme Short Codes</h1>
    <ol>
        <li>[home-url slug=''] <span class="sdetagils">displays home url</span></li>
        <li>[site-identity class='' container_class=''] <span class="sdetagils">displays site identity according to theme option</span></li>
        <li>[site-name link='0'] <span class="sdetagils">displays site name with/without site url</span></li>
        <li>[copyright-symbol] <span class="sdetagils">displays copyright symbol</span></li>
        <li>[this-year] <span class="sdetagils">displays 4 digit current year</span></li>
        <li>[email class='' display='all' title='0'] <span class="sdetagils">displays email from theme options</span></li>
        <li>[phone class='' display='all' title='0'] <span class="sdetagils">displays phone from theme options</span></li>
        <li>[business-hours class='' display='all' title='0'] <span class="sdetagils">displays business hours from theme options</span></li>
        <li>[contact-address class='' display='all' title='0'] <span class="sdetagils">displays contact address from theme options</span></li>
        <li>[woo-searchform class=''] <span class="sdetagils">displays woo searchform from theme options</span></li>
        <li>[newsletter-form class=''] <span class="sdetagils">displays newsletter form from theme options</span></li>
        <li>[product-brand] <span class="sdetagils">displays product brand</span></li>
        <li>[product-status] <span class="sdetagils">displays product status</span></li>
        <li>[product-category-filter class='' title=''] <span class="sdetagils">displays product category filter</span></li>
        <li>[mobile-menu class='' title=''] <span class="sdetagils">displays mobile menu icon</span></li>
        <li>[mos-translate input='' ucf=false] <span class="sdetagils">displays translate</span></li>
    </ol>
</div>
<?php
}
function home_url_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'slug' => '',
	), $atts, 'home-url' );

	return home_url( $atts['slug'] );
}
add_shortcode( 'home-url', 'home_url_func' );
function site_identity_func( $atts = array(), $content = null ) {
	global $forclient_options;
	$logo = carbon_get_theme_option( 'mos-logo' );
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'container_class' => ''
	), $atts, 'site-identity' ); 
    ob_start(); ?>
    <div class="logo-wrapper <?php echo $atts['container_class']?>">
        <?php if($logo) : ?>
        <a class="logo <?php echo $atts['class']?>" href="<?php echo home_url()?>">
            <?php if(carbon_get_theme_option( 'mos-logo' )) : ?>
            <?php echo wp_get_attachment_image( $logo, 'full', "", array( "class" => "img-responsive img-fluid" ) );  ?>
            <?php else : ?>
            <img class="img-responsive img-fluid" src="<?php echo get_template_directory_uri(). '/images/logo.png'?>" alt="<?php echo get_bloginfo('name').' - Logo'?>">
            <?php endif?>
        </a>
        <?php else : ?>
        <div class="<?php echo $atts['class']?>">
            <h1 class="site-title"><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></h1>
            <p class="site-description"><?php echo get_bloginfo( 'description' )?></p>
        </div>
        <?php endif;?>
    </div>
    <?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'site-identity', 'site_identity_func' );
function site_name_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'link' => 0,
	), $atts, 'site-name' );
    
	if ($atts['link']) $html .=	'<a href="'.esc_url( home_url( '/' ) ).'">';
	$html .= get_bloginfo('name');
	if ($atts['link']) $html .=	'</a>';
	return $html;
}
add_shortcode( 'site-name', 'site_name_func' );
function copyright_symbol_func() {
	return '&copy;';
}
add_shortcode( 'copyright-symbol', 'copyright_symbol_func' );
function this_year_func() {
	return date('Y');
}
add_shortcode( 'this-year', 'this_year_func' );

function email_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'email' );  
    ob_start();     
    $emails = carbon_get_theme_option( 'mos-contact-email' );  
    if($emails && sizeof($emails)) :
    ?>
    <span class="email-wrapper <?php echo $atts['class'] ?>">
        <?php if (!is_numeric($atts['display'])) : ?>
        <?php foreach($emails as $email) :?>
        <span class="contact-unit email-unit">
            <span class="contact-unit-title email-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $email['title'] ?></span>
            <span class="contact-unit-intro email-link"><a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a></span>
        </span>
        <?php endforeach;?>
        <?php else : ?>
        <span class="contact-unit email-unit">
            <span class="contact-unit-title email-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $emails[$atts['display']]['title'] ?></span>
            <span class="contact-unit-intro email-link"><a href="mailto:<?php echo $emails[$atts['display']]['email'] ?>"><?php echo $emails[$atts['display']]['email'] ?></a></span>
        </span>
        <?php endif ?>
        <?php echo do_shortcode($content) ?>
    </span>
    <?php else : ?>
        <span class="contact-unit email-unit d-none">Please contact web admin</span>
    <?php endif?>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'email', 'email_func' );

function phone_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'phone' );  
    ob_start();     
    $phones = carbon_get_theme_option( 'mos-contact-phone' );  
    if($phones && sizeof($phones)) :
    ?>
    <span class="phone-wrapper <?php echo $atts['class'] ?>">
        <?php if (!is_numeric($atts['display'])) : ?>
        <?php foreach($phones as $phone) :?>
        <span class="contact-unit phone-unit">
            <span class="contact-unit-title phone-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $phone['title'] ?></span>
            <span class="contact-unit-intro phone-link"><a href="mailto:<?php echo $phone['number'] ?>"><?php echo $phone['number'] ?></a></span>
        </span>
        <?php endforeach;?>
        <?php else : ?>
        <span class="contact-unit phone-unit">
            <span class="contact-unit-title phone-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $phones[$atts['display']]['title'] ?></span>
            <span class="contact-unit-intro phone-link"><a href="mailto:<?php echo $phones[$atts['display']]['number'] ?>"><?php echo $phones[$atts['display']]['number'] ?></a></span>
        </span>
        <?php endif ?>
        <?php echo do_shortcode($content) ?>
    </span>
    <?php else : ?>
        <span class="contact-unit phone-unit d-none">Please contact web admin</span>
    <?php endif?>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'phone', 'phone_func' );

function business_hours_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'business-hours' );  
    ob_start();     
    $hours = carbon_get_theme_option( 'mos-contact-business-hours' );  
    if($hours && sizeof($hours)) :
    ?>
    <span class="business-hour-wrapper <?php echo $atts['class'] ?>">
        <?php if (!is_numeric($atts['display'])) : ?>
        <?php foreach($hours as $hour) :?>
        <span class="contact-unit business-hour-unit">
            <span class="contact-unit-title business-hour-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $hour['title'] ?></span>
            <span class="contact-unit-intro business-hour-time"><?php echo $hour['hours'] ?></span>
        </span>
        <?php endforeach;?>
        <?php else : ?>
        <span class="contact-unit business-hour-unit">
            <span class="contact-unit-title business-hour-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $hours[$atts['display']]['title'] ?></span>
            <span class="contact-unit-intro business-hour-time"><?php echo $hours[$atts['display']]['hours'] ?></span>
        </span>
        <?php endif ?>
        <?php echo do_shortcode($content) ?>
    </span>
    <?php else : ?>
        <span class="contact-unit business-hour-unit d-none">Please contact web admin</span>
    <?php endif?>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'business-hours', 'business_hours_func' );

function contact_address_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'contact-address' );  
    ob_start();     
    $address = carbon_get_theme_option( 'mos-contact-contact-address' );  
    if($address && sizeof($address)) :
    ?>
    <span class="contact-address-wrapper <?php echo $atts['class'] ?>">
        <?php if (!is_numeric($atts['display'])) : ?>
        <?php foreach($address as $value) :?>
        <span class="contact-unit contact-address-unit">
            <span class="contact-unit-title contact-address-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $value['title'] ?></span>
            <span class="contact-unit-intro contact-address-time"><?php echo $value['address'] ?></span>
        </span>
        <?php endforeach;?>
        <?php else : ?>
        <span class="contact-unit contact-address-unit">
            <span class="contact-unit-title contact-address-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $address[$atts['display']]['title'] ?></span>
            <span class="contact-unit-intro contact-address-time"><?php echo $address[$atts['display']]['address'] ?></span>
        </span>
        <?php endif ?>
        <?php echo do_shortcode($content) ?>
    </span>
    <?php else : ?>
        <span class="contact-unit contact-address-unit d-none">Please contact web admin</span>
    <?php endif?>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'contact-address', 'contact_address_func' );

function woo_searchform_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => ''
	), $atts, 'woo-searchform' ); 
    ob_start(); ?>
    <div class="woo-searchform-wrapper position-relative <?php echo $atts['class']?>">
        <?php echo get_product_search_form( false );?>
        <div class="search-suggestion-results"></div>
    </div>
    <?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'woo-searchform', 'woo_searchform_func' );

function newsletter_form_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => ''
	), $atts, 'newsletter-form' ); 
    ob_start(); ?>
    <div class="newsletter-form-wrapper <?php echo $atts['class']?>">
    <form method="get" id="newsletter" action="">
		<div class="input-group">
			<input class="form-control" type="text" name="newsletetr-email" id="newsletetr-email" placeholder="<?php echo  __( 'Your Email Address:' ) ?>"/>
			<button type="submit" id="searchsubmit" class="btn btn-newsletetr">
            <i class="fa fa-envelope"></i>
            </button> 
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>
    </div>
    <?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'newsletter-form', 'newsletter_form_func' );

function mos_displat_product_brand(){
    global $product;
    // $product = wc_get_product();    
	$branding_name = $product->get_attribute( 'brand' );
    return $branding_name;
}
add_shortcode('product-brand', 'mos_displat_product_brand');

function mos_product_status( ) {
    global $product;
    $stock_status = $product->get_stock_status();
    $availability = $product->get_availability();
    //var_dump($stock_status);//onbackorder
    //return '<div class="mos-product-stock">'.$availability.'</div>';
    if($stock_status == 'instock') {
        $stock = [
            'class' => 'in-stock',
            //'name'  => $availability['availability'] ? $availability['availability'] : __('In Stock', 'woocommerce'),
            //'name'  => esc_html__('In Stock', 'woocommerce'),
            //'name'  => esc_html__('I lager', 'woocommerce'),
            'name'  => carbon_get_theme_option( 'mos-woocommerce-instock-text' ),
        ];
    } elseif($stock_status == 'onbackorder') {
        $stock = [
            'class' => 'on-backorder',
            //'name'  => esc_html__('Backorder', 'woocommerce'),
            //'name'  => esc_html__('Restorder', 'woocommerce'),
            'name'  => carbon_get_theme_option( 'mos-woocommerce-backorder-text' ),            
        ];
    } else {
        $stock = [
            'class' => 'out-of-stock',
            //'name'  => esc_html__('Ej i lager', 'woocommerce'),
            //'name'  => esc_html__('Out of Stock', 'woocommerce'),
            //'name'  => esc_html__('Slut i lager', 'woocommerce'),
            'name'  => carbon_get_theme_option( 'mos-woocommerce-outofstock-text' ),
        ];
    }
    //return esc_html_e('In Stock');
	return '<div class="mos-product-stock '.$stock['class'].'">'.$stock['name'].'</div>';
    //echo sprintf('<div class="wd-product-stock %1$s">%2$s</div>', $stock['class'], $stock['name']);
}
add_shortcode('product-status', 'mos_product_status');
function mos_product_cat_filter_func( $atts = array(), $content = null ) {
    $cterm = get_queried_object();
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'title' => '',
	), $atts, 'product-category-filter' ); 
    ob_start(); ?>
    <div class="product-category-filter-wrapper <?php echo $atts['class']?>"> 
        	
        <?php 
        $taxonomy_name = 'product_cat';
        $term = get_queried_object();
        //var_dump($term);
		$args = [];
		if(@$term && $term->name !='product' && $term->parent) {
            //var_dump($term->name);
			$parent_term = (@$term->parent)?get_term($term->parent):$term;    
			$termchildren = get_term_children( (@$parent_term->term_id)?$parent_term->term_id:0, $taxonomy_name );  
            $active_class = ($cterm->name == $parent_term->name)?'active':'';  
			$args = array(
				'taxonomy' => $taxonomy_name,
				'depth'    => 1,
				'show_count' => 0,
				'orderby'           =>  'menu_order',
				'title_li'            => '<a href="'.get_term_link( $parent_term, $taxonomy_name ).'">'.$parent_term->name.'</a>',
				'child_of' => $parent_term->term_id
			);
		} else {
            $args = array(
				'taxonomy' => $taxonomy_name,
				'depth'    => 2,
				'show_count' => 0,
				'orderby'           =>  'menu_order',
				'title_li'            => '',
				'child_of' => 0
			);
        }
        ?>
		
        <?php if (@$atts['title']) :?>
        <h5 class="widget-title"><?php echo $atts['title']?></h5>
		<?php endif?>
        <ul class="product-categories list-parent list-for-<?php echo $term->parent?$term->parent:0 ?>"> 
        <?php 
            wp_list_categories($args);
        ?>
        </ul>
    </div>
<?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'product-category-filter', 'mos_product_cat_filter_func' );
function mos_mobile_menu_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'title' => '',
	), $atts, 'mobile-menu' ); 
    ob_start(); ?>
    <a class="toggle position-relative <?php echo @$atts['class']?>" href="#"><span></span></a>
<?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'mobile-menu', 'mos_mobile_menu_func' );
function trustpilot_widget_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'locale' => '',
		'template-id' => '',
		'businessunit-id' => '',
		'style-height' => '24px',
		'style-width' => '100%',
		'theme' => 'light',
		'min-review-count' => 0,
        'without-reviews-preferred-string-id' => 2,
        'style-alignment' => 'center',
        'href' => ''
	), $atts, 'trustpilot-widget' ); 
    
    ob_start(); ?>
    <div class="mos-trustpilot-widget-wrapper">
    <!-- TrustBox widget - Micro Review Count -->
    <div class="trustpilot-widget <?php echo @$atts['class']?>" data-locale="<?php echo @$atts['locale']?>" data-template-id="<?php echo @$atts['template-id']?>" data-businessunit-id="<?php echo @$atts['businessunit-id']?>" data-style-height="<?php echo @$atts['style-height']?>" data-style-width="<?php echo @$atts['style-width']?>" data-theme="<?php echo @$atts['theme']?>" data-min-review-count="<?php echo (@$atts['min-review-count'])?$atts['min-review-count']:0?>" data-without-reviews-preferred-string-id="<?php echo @$atts['without-reviews-preferred-string-id']?>" data-style-alignment="left">
    <a href="<?php echo @$atts['href']?>" target="_blank" rel="noopener">Trustpilot</a>
    </div>
    <!-- End TrustBox widget -->
    </div>
<?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'trustpilot-widget', 'trustpilot_widget_func' );


function _mos_translate($input='', $ucf=false){
    $words = carbon_get_theme_option( 'mos-translate' );
    $found = 0;
    foreach($words as $word) {
        if (strtolower($word['input']) == strtolower($input)) {
            $found++;
            break;
        } 
    }
    $t_input = __($input, 'mosgutenberg');
    return ($ucf)?
        (ucfirst(($found)?$word['output']:esc_html__($t_input))):
        strtolower(($found)?$word['output']:esc_html__($t_input));
}
function _e_mos_translate($input='', $ucf=false){
    echo _mos_translate($input, $ucf);
}

function mos_translate_func( $atts = array(), $content = null ) {
	$atts = shortcode_atts( array(
		'input' => '',
        'ucf' => false
	), $atts, 'mos-translate' ); 
    return _mos_translate($atts['input'],$atts['ucf']);
}
add_shortcode( 'mos-translate', 'mos_translate_func' );