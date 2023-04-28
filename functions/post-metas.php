<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'mos_post_meta_options');

function mos_post_meta_options() {
    Container::make('post_meta', 'Audio Data')
    ->where('post_type', '=', 'post')
    ->add_fields(array(
        Field::make('select', 'mos_blog_details_audio_option', __('Audio Source'))
        ->set_options(array(
            'none' => 'No Audio',
            'ga' => 'Given Audio',
        )),
        Field::make('file', 'mos_blog_details_audio', __('Audio File'))
        ->set_type(array('audio'))
    ));
  
    Container::make('post_meta', 'Page Data')
    ->where('post_type', '=', 'page')
    ->add_fields(array(        
        Field::make( 'select', 'mos_page_header_type', __( 'Header Option' ) )
        ->set_options( array(
            'default' => 'Default',
            'none' => 'Hide Header',
            'custom' => 'Custom Header',
        )),         
        Field::make( 'association', 'mos_page_header_layout', __( 'Select Header Layout' ) )
        ->set_required( true )
        ->set_conditional_logic(array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_page_header_type',
                'value' => 'custom', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),         
        Field::make( 'select', 'mos_page_footer_type', __( 'Footer Option' ) )
        ->set_options( array(
            'default' => 'Default',
            'none' => 'Hide Footer',
            'custom' => 'Custom Footer',
        )),         
        Field::make( 'association', 'mos_page_footer_layout', __( 'Select Footer Layout' ) )
        ->set_required( true )
        ->set_conditional_logic(array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_page_footer_type',
                'value' => 'custom', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),   
    ));
    Container::make('post_meta', 'Additional Tabs')
    ->where('post_type', '=', 'product')
    ->add_fields(array(        
        Field::make('complex', 'mos_product_tabs', __('Additional Tabs'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required( true ),
            Field::make('rich_text', 'intro', __('Intro')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true)
        ->set_max( 90 ),
    ));
}