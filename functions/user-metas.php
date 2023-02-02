<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'mos_user_meta_options');

function mos_user_meta_options() {
    Container::make('user_meta', 'User Data')
    ->add_fields(array(
        Field::make('image', 'mos_profile_image', __('Profile Image'))
        ->set_type(array('image'))
        ->set_value_type('url')
        ->set_help_text( "Image size must be 512x512px." ),
        Field::make('text', 'mos_profile_designation', 'Designation'),
        Field::make('text', 'mos_profile_linkedin', 'LinkedIn'),
    ));
}