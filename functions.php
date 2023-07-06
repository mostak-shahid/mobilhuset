<?php
// show_admin_bar( false );
// add_filter('show_admin_bar', false, PHP_INT_MAX);
function disable_edit_options() {
	define('DISALLOW_FILE_EDIT',true);
	define('DISALLOW_FILE_MODS',true);
}
//add_action('init','disable_edit_options');
require_once('functions/theme-init/plugin-update-checker.php');
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mobilhuset.json',
	__FILE__,
	'mobilhuset'
);

require_once('functions/theme-functions.php');
require_once('functions/scripts.php');
require_once('functions/setup.php');
require_once('functions/shortcodes.php');
require_once('functions/widgets.php');
require_once('functions/custom-comments.php');
require_once('functions/theme-filter-hooks.php');
require_once('functions/ajax.php');

require_once('inc/TGM-Plugin-Activation-develop/plugin-management.php');

require_once('functions/aq_resizer.php');
require_once('functions/Mobile_Detect.php');
//require_once('functions/bs4navwalker.php');
require_once('functions/class-wp-bootstrap-navwalker.php');
require_once('functions/breadcrumb.php');
require_once('functions/contact-form-7-element.php');
require_once('functions/post-types.php');
require_once('functions/postgrid-column-custimozation.php');
require_once ('carbon-fields.php');
require_once('functions/theme-options.php');
require_once('functions/gutenberg-blocks.php');
require_once('functions/post-metas.php');
require_once('functions/term-metas.php');
require_once('functions/woo-functions.php');
// require_once('functions/WPEX_Options_Panel.php');
// Register new Options panel.
$panel_args = [
    'title'           => 'My Options',
    'option_name'     => 'my_options',
    'slug'            => 'my-options-panel',
    'user_capability' => 'manage_options',
    'tabs'            => [
        'tab-1' => esc_html__( 'Tab 1', 'text_domain' ),
        'tab-2' => esc_html__( 'Tab 2', 'text_domain' ),
    ],
];

$panel_settings = [
    // Tab 1
    'checkbox' => [
        'label'       => esc_html__( 'Checkbox Option', 'text_domain' ),
        'type'        => 'checkbox',
        'text'       => 'Yes I like to add lavel too',
        'description' => 'My checkbox field description.',
        'tab'         => 'tab-1',
    ],
    'select' => [
        'label'       => esc_html__( 'Select Option', 'text_domain' ),
        'type'        => 'select',
        'description' => 'My select field description.',
        'choices'     => [
            ''         => esc_html__( 'Select', 'text_domain' ),
            'choice_1' => esc_html__( 'Choice 1', 'text_domain' ),
            'choice_2' => esc_html__( 'Choice 2', 'text_domain' ),
            'choice_3' => esc_html__( 'Choice 3', 'text_domain' ),
        ],
        'tab'         => 'tab-1',
    ],
    'radio' => [
        'label'       => esc_html__( 'Radio Option', 'text_domain' ),
        'type'        => 'radio',
        'description' => 'My select field description.',
        'choices'     => [
            'choice_1' => esc_html__( 'Choice 1', 'text_domain' ),
            'choice_2' => esc_html__( 'Choice 2', 'text_domain' ),
            'choice_3' => esc_html__( 'Choice 3', 'text_domain' ),
        ],
        'tab'         => 'tab-1',
    ],
    'color' => [
        'label'       => esc_html__( 'Color Option', 'text_domain' ),
        'type'        => 'color',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'date' => [
        'label'       => esc_html__( 'Date Option', 'text_domain' ),
        'type'        => 'date',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'time' => [
        'label'       => esc_html__( 'Time Option', 'text_domain' ),
        'type'        => 'time',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'datetime' => [
        'label'       => esc_html__( 'Datetime Option', 'text_domain' ),
        'type'        => 'datetime',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'url' => [
        'label'       => esc_html__( 'URL Option', 'text_domain' ),
        'type'        => 'url',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'number' => [
        'label'       => esc_html__( 'Number Option', 'text_domain' ),
        'type'        => 'number',
        'description' => 'My field 1 description.',
        'min'         => 10,
        'max'         => 50,
        'step'        => 10,
        'tab'         => 'tab-1',
    ],
    'range' => [
        'label'       => esc_html__( 'Range Option', 'text_domain' ),
        'type'        => 'range',
        'description' => 'My field 1 description.',
        'min'         => 10,
        'max'         => 100,
        'step'        => 5,
        'tab'         => 'tab-1',
    ],
    'tel' => [
        'label'       => esc_html__( 'Tel Option', 'text_domain' ),
        'type'        => 'tel',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    'repeater' => [
        'label'       => esc_html__( 'Repeater Option', 'text_domain' ),
        'type'        => 'repeater',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-1',
    ],
    // Tab 2
    'text' => [
        'label'       => esc_html__( 'Text Option', 'text_domain' ),
        'type'        => 'text',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-2',
    ],
    'textarea' => [
        'label'       => esc_html__( 'Textarea Option', 'text_domain' ),
        'type'        => 'textarea',
        'description' => 'My textarea field description.',
        'tab'         => 'tab-2',
    ],
    'image' => [
        'label'       => esc_html__( 'Image Option', 'text_domain' ),
        'type'        => 'image',
        'description' => 'My field 1 description.',
        'tab'         => 'tab-2',
    ],
];
// new WPEX_Options_Panel( $panel_args, $panel_settings );

//require_once('functions/MobileDetect.php');
// $detect = new Mobile_Detect;
// var_dump($detect->isMobile());
/*if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>')) {    
    // WP > 5 beta
    add_filter('use_block_editor_for_post_type', '__return_false', 100);    
} else {    
    // WP < 5 beta
    add_filter('gutenberg_can_edit_post_type', '__return_false');    
}*/