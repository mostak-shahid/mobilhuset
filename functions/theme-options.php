<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mos_theme_options');
function mos_theme_options() {
    $basic_options_container = Container::make('theme_options', __('Theme Options'))
    ->set_icon('dashicons-admin-customizer')
    ->add_fields(array(
        Field::make('image', 'mos-logo', __('Logo'))
        ->set_default_value(get_template_directory_uri() . '/assets/img/logo.svg'),
        Field::make('header_scripts', 'crb_header_script', __('Header Script'))
        ->set_classes('html-editor'),
        Field::make('footer_scripts', 'crb_footer_script', __('Footer Script'))
        ->set_classes('html-editor'),
    ));

    Container::make('theme_options', __('Color scheme'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('color', 'mos_body_bg', 'Body Background')
        //->set_palette(array('#FF0000', '#00FF00', '#0000FF'))
        ->set_alpha_enabled(true)
        ->set_help_text('Pick the color for body background, by default it is set to #ffffff. You can use this color in your css with var(--mos-body-bg)')
        ->set_default_value('#ffffff'),
        
        Field::make('color', 'mos_primary_color', 'Primary Color')
        ->set_help_text('Pick the primary color, by default it is set to #00f5eb. You can use this color in your css with var(--mos-primary-color)')
        ->set_default_value('#00f5eb'),
        
        Field::make('color', 'mos_secondary_color', 'Secondary Color')
        ->set_help_text('Pick the secondary color, by default it is set to #21fff6. You can use this color in your css with var(--mos-secondary-color)')
        ->set_default_value('#21fff6'),
        
        Field::make('color', 'mos_content_color', 'Content Color')
        ->set_help_text('Pick the content color, by default it is set to #212529. You can use this color in your css with var(--mos-content-color)')
        ->set_default_value('#212529'),
        Field::make('color', 'mos_link_color', 'Link Color')
        ->set_help_text('Pick the link color, by default it is set to #015ea5.')
        ->set_default_value('#015ea5'),
        Field::make('color', 'mos_link_hover_color', 'Link Hover Color')
        ->set_help_text('Pick the link hover color, by default it is set to #0a58ca.')
        ->set_default_value('#0a58ca'),
    ));
    
    Container::make('theme_options', __('Theme Resourcess'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(                   

        Field::make('radio', 'mos_plugin_bootstrap', __('Bootsrap'))
        ->set_options(array(
            'bootstrap-bundle' => 'Bundle CSS',
            'seperated-files' => 'Seperated Files',
            'off' => 'Disabled',
        ))
        ->set_default_value('bootstrap-bundle'),
        
        Field::make('multiselect', 'mos_plugin_bootstrap_seperated_files', __('Files'))
        ->set_options(array(
            'bootstrap-reboot' => 'Reboot CSS',
            'bootstrap-grid' => 'Grid CSS',
            'bootstrap-utilities' => 'Utilities CSS',
        ))
        ->set_required( true )
        ->set_conditional_logic(array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_plugin_bootstrap',
                'value' => 'seperated-files', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),

        Field::make('radio', 'mos_plugin_jquery', __('Jquery'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),

        Field::make('radio', 'mos_plugin_fontawesome', __('Font Awesome'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),         

        Field::make('radio', 'mos_plugin_fancybox', __('Fancybox'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),

        Field::make('radio', 'mos_plugin_isotop', __('Isotop'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),

        Field::make('radio', 'mos_plugin_card_slider', __('Card Slider'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_jpages', __('jPages'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_lazyload', __('Lazy Load'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_table_shrinker', __('Table Shrinker'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_owlcarousel', __('Owl Carousel'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_slick', __('Slick Slider'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_wow', __('Wow'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_animate', __('Animate CSS'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_jflip', __('Jquery Flip'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),  
        Field::make('complex', 'mos_plugin_additional', __('Additional Assets'))
        ->add_fields(array(
            Field::make('select', 'type', __('Asset Type'))
            ->set_options(array(
                'style' => 'CSS',
                'script' => 'Script',
            )),
            Field::make('select', 'from', __('From'))
            ->set_options(array(
                'parent' => 'Parent Theme',
                'child' => 'Child Theme',
                'outside' => 'CDN/Outside',
            )),
            Field::make('text', 'source', __('Source')),
        )),
    ));
    Container::make('theme_options', __('Contact Info'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('text', 'mos-contact-form-shortcode', __('Contact form shortcode ')),
        Field::make('complex', 'mos-contact-phone', __('Phone'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'number', __('Phone Number')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- number ? "(" + number + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-email', __('Email'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'email', __('Email Address')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- email ? "(" + email + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-business-hours', __('Business Hours'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'hours', __('Business Hours')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- hours ? "(" + hours + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-contact-address', __('Contact Address'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'address', __('Address')),
            Field::make('text', 'link', __('Map Link')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-social-media', __('Social Media'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('text', 'icon', __('Icon Class'))
            ->set_help_text( 'Example: fa-facebook' ),
            Field::make('checkbox', 'new-tab', __('Open in new tab'))
            ->set_option_value('no'),
        ))        
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
    ));
    Container::make('theme_options', __('Back to Top'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('radio', 'mos-back-to-top', __('Back to top option'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),
        Field::make('image', 'mos-back-to-top-image', __('Back to top image')),
        Field::make('text', 'mos-back-to-top-class', __('Back to top class')),
    ));
    Container::make('theme_options', __('Page Loader'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('radio', 'mos-page-loader', __('Page loader option'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),
        Field::make('image', 'mos-page-loader-image', __('Page loader image')),
        Field::make('color', 'mos-page-loader-background', 'Page loader background')
        ->set_alpha_enabled(true),
        Field::make('text', 'mos-page-loader-class', __('Page loader class')),
    ));

    Container::make('theme_options', __('Header Section'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'association', 'mos-header-layout', __( 'Select Header Layout' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),
        Field::make('text', 'mos-header-padding', __('Padding')),
        Field::make('text', 'mos-header-margin', __('Margin')),
        Field::make('text', 'mos-header-border', __('Border')),
        Field::make('text', 'mos-header-class', __('Class')),
        Field::make('color', 'mos-header-content-color', __('Content Color')),
        Field::make('color', 'mos-header-link-color', __('Links Color')),
        Field::make('color', 'mos-header-link-color-hover', __('Hover Color')),

        
        Field::make('complex', 'mos-header-background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('no-repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    ));

    Container::make('theme_options', __('Sticky Header'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'checkbox', 'mos-header-sticky-enable', __( 'Enable Sticky Header' ) ),
        Field::make( 'radio_image', 'mos-header-sticky-layout', __( 'Sticky Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_options( array(
            'header-1' => get_template_directory_uri() . '/images/header-1.png',
            'header-2' => get_template_directory_uri() . '/images/header-2.png',
            'header-3' => get_template_directory_uri() . '/images/header-3.png',
            'header-4' => get_template_directory_uri() . '/images/header-4.png',
            'header-5' => get_template_directory_uri() . '/images/header-5.png',
            'header-6' => get_template_directory_uri() . '/images/header-6.png',
            'header-7' => get_template_directory_uri() . '/images/header-7.png',
        ))
        ->set_default_value('header-1'),
        Field::make('image', 'mos-header-sticky-menu-icon', __('Sticky Header Menu Icon'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
        Field::make('complex', 'mos-header-sticky-icons', __('Sticky Header Icons'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_collapsed(true)        
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required( true ),
            Field::make('text', 'icon', __('Icon Class')),
            Field::make('textarea', 'svg', __('SVG')),
            Field::make('image', 'image', __('Image')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('text', 'attributes', __('Attributes'))
            ->set_help_text( 'You can add your tag attributes like class, id, data-* attributes here.' ),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        '),
    ));

    Container::make('theme_options', __('Mobile Header'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'checkbox', 'mos-header-mobile-enable', __( 'Enable Mobile Header' ) ),
        Field::make( 'radio_image', 'mos-header-mobile-layout', __( 'Mobile Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_options( array(
            'header-1' => get_template_directory_uri() . '/images/header-1.png',
            'header-2' => get_template_directory_uri() . '/images/header-2.png',
            'header-3' => get_template_directory_uri() . '/images/header-3.png',
            'header-4' => get_template_directory_uri() . '/images/header-4.png',
            'header-5' => get_template_directory_uri() . '/images/header-5.png',
            'header-6' => get_template_directory_uri() . '/images/header-6.png',
            'header-7' => get_template_directory_uri() . '/images/header-7.png',
        ))
        ->set_default_value('header-1'),
        Field::make('image', 'mos-header-mobile-menu-icon', __('Mobile Header Menu Icon'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
        Field::make('complex', 'mos-header-mobile-icons', __('Mobile Header Icons'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_collapsed(true)        
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required( true ),
            Field::make('text', 'icon', __('Icon Class')),
            Field::make('textarea', 'svg', __('SVG')),
            Field::make('image', 'image', __('Image')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('text', 'attributes', __('Attributes'))
            ->set_help_text( 'You can add your tag attributes like class, id, data-* attributes here.' ),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        '),        
        Field::make('select', 'mos-header-mobile-search', __('Search Option'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_options(array(
            '' => 'None',
            'top' => 'Top',
            'bottom' => 'Bottom',
        ))
    ));

    Container::make('theme_options', __('Breadcumb Section'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'checkbox', 'mos-breadcump-enable', __( 'Enable Breadcump' ) ),
        
        Field::make('text', 'mos-breadcumb-height', __('Height')),
        Field::make('text', 'mos-breadcumb-padding', __('Padding')),
        Field::make('text', 'mos-breadcumb-margin', __('Margin')),
        Field::make('text', 'mos-breadcumb-border', __('Border')),
        Field::make('text', 'mos-breadcumb-class', __('Class')),
        Field::make('color', 'mos-breadcumb-content-color', __('Content Color')),
        Field::make('color', 'mos-breadcumb-link-color', __('Links Color')),
        Field::make('color', 'mos-breadcumb-link-color-hover', __('Hover Color')),
        Field::make('complex', 'mos-breadcumb-background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('no-repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    ));

    Container::make('theme_options', __('Woocommerce'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        //Field::make('checkbox', 'mos-woocommerce-hide-title', __('Hide Archive Title')),
        Field::make('text', 'mos-woocommerce-archive-nop', __('Archive product count'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(9)
        ->set_required( true ),
        // Field::make( 'checkbox', 'mos-woocommerce-vmb', 'Enable Marginal Vat' ),
        Field::make('text', 'mos-woocommerce-add-to-cart-text', __('Add to cart button text for simple product'))
        ->set_default_value("Add to cart")
        ->set_required( true ),
        Field::make('text', 'mos-woocommerce-add-to-cart-text-variable', __('Add to cart button text for variable product'))
        ->set_default_value("Select options")
        ->set_required( true ),
        Field::make('text', 'mos-woocommerce-add-to-cart-text-grouped', __('Add to cart button text for grouped product'))
        ->set_default_value("View products")
        ->set_required( true ),
        Field::make('text', 'mos-woocommerce-add-to-cart-text-outofstock', __('Add to cart button text for out of stock product'))
        ->set_default_value("Read More")
        ->set_required( true ),        
        Field::make('text', 'mos-woocommerce-instock-text', __('In Stock text'))
        ->set_default_value("In Stock")
        ->set_required( true ),
        Field::make('text', 'mos-woocommerce-outofstock-text', __('Out of Stock text'))
        ->set_default_value("Out of Stock")
        ->set_required( true ),
        Field::make('text', 'mos-woocommerce-backorder-text', __('Backorder text'))
        ->set_default_value("Backorder")
        ->set_required( true ),

        Field::make( 'select', 'mos-woocommerce-show-price', __( 'Price visible to' ) )
        ->set_options( array(
            'all' => 'All',
            'loggedin' => 'Logged in user',
        )),
        Field::make('text', 'mos-woocommerce-login-advice-text', __('Login advice text'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-woocommerce-show-price',
                'value' => 'loggedin', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_default_value("Lonin to see price")
        ->set_required( true ),
        
        Field::make('text', 'mos-woocommerce-login-button-text', __('Login button text'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-woocommerce-show-price',
                'value' => 'loggedin', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_default_value("Login")
        ->set_required( true ),
        Field::make('checkbox', 'mos-woocommerce-hide-additional-tab', __('Hide additional tab')),
        
        Field::make('complex', 'mos-woocommerce-usp', __('USP'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required(true),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('image', 'image', __('Image')),
        ))        
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
    ));
    Container::make('theme_options', __('Footer Section'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'association', 'mos-footer-layout', __( 'Select Footer Layout' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),
        Field::make('text', 'mos-footer-padding', __('Padding')),
        Field::make('text', 'mos-footer-margin', __('Margin')),
        Field::make('text', 'mos-footer-border', __('Border')),
        Field::make('text', 'mos-footer-class', __('Class')),
        Field::make('color', 'mos-footer-content-color', __('Content Color')),
        Field::make('color', 'mos-footer-link-color', __('Links Color')),
        Field::make('color', 'mos-footer-link-color-hover', __('Hover Color')),
        Field::make('rich_text', 'mos-footer-content', __('Copyright')),
        Field::make('complex', 'mos-footer-background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('no-repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    ));
}