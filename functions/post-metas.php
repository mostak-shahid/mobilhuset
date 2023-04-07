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
        Field::make('checkbox', 'mos_page_hide_header', __('Hide Header')),
        Field::make('checkbox', 'mos_page_hide_footer', __('Hide Footer')),
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