<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mos_term_meta_options');

function mos_term_meta_options() {
    Container::make( 'term_meta', __( 'Category Properties' ) )
    ->where( 'term_taxonomy', '=', 'product_cat' )
    ->add_fields( array(
        Field::make( 'image', 'mos_product_cat_banner_image', __( 'Banner Image' ) ),
    ));
}