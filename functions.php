<?php
show_admin_bar( false );
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

/*if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>')) {    
    // WP > 5 beta
    add_filter('use_block_editor_for_post_type', '__return_false', 100);    
} else {    
    // WP < 5 beta
    add_filter('gutenberg_can_edit_post_type', '__return_false');    
}*/