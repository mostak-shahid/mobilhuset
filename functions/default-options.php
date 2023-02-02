<?php
function mosgutenberg_settings_init() {
	register_setting( 'mosgutenberg', 'mosgutenberg_options' );
	add_settings_section('mosgutenberg_section_top_nav', '', 'mosgutenberg_section_top_nav_cb', 'mosgutenberg');
	add_settings_section('mosgutenberg_section_dash_start', '', 'mosgutenberg_section_dash_start_cb', 'mosgutenberg');

	add_settings_field( 'field_logo', __( 'Company Logo', 'mosgutenberg' ), 'mosgutenberg_field_logo_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'company_logo', 'class' => 'mosgutenberg_row' ] );	
	add_settings_field( 'field_name', __( 'Company Name', 'mosgutenberg' ), 'mosgutenberg_field_name_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'company_name', 'class' => 'mosgutenberg_row' ] );	
	add_settings_field( 'field_email', __( 'Company Email', 'mosgutenberg' ), 'mosgutenberg_field_email_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'company_email', 'class' => 'mosgutenberg_row' ] );	
	add_settings_field( 'field_phone', __( 'Company Phone', 'mosgutenberg' ), 'mosgutenberg_field_phone_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'company_phone', 'class' => 'mosgutenberg_row' ] );	
	add_settings_field( 'field_address', __( 'Company Address', 'mosgutenberg' ), 'mosgutenberg_field_address_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'company_address', 'class' => 'mosgutenberg_row' ] );	
	add_settings_field( 'field_invioce_prefix', __( 'Invoice Prefix', 'mosgutenberg' ), 'mosgutenberg_field_invioce_prefix_cb', 'mosgutenberg', 'mosgutenberg_section_dash_start', [ 'label_for' => 'invioce_prefix', 'class' => 'mosgutenberg_row' ] );	

	add_settings_section('mosgutenberg_section_dash_end', '', 'mosgutenberg_section_end_cb', 'mosgutenberg');
	
	add_settings_section('mosgutenberg_section_scripts_start', '', 'mosgutenberg_section_scripts_start_cb', 'mosgutenberg');
	//add_settings_field( 'field_jquery', __( 'JQuery', 'mosgutenberg' ), 'mosgutenberg_field_jquery_cb', 'mosgutenberg', 'mosgutenberg_section_scripts_start', [ 'label_for' => 'jquery', 'class' => 'mosgutenberg_row' ] );
	//add_settings_field( 'field_bootstrap', __( 'Bootstrap', 'mosgutenberg' ), 'mosgutenberg_field_bootstrap_cb', 'mosgutenberg', 'mosgutenberg_section_scripts_start', [ 'label_for' => 'bootstrap', 'class' => 'mosgutenberg_row' ] );
	//add_settings_field( 'field_css', __( 'Custom Css', 'mosgutenberg' ), 'mosgutenberg_field_css_cb', 'mosgutenberg', 'mosgutenberg_section_scripts_start', [ 'label_for' => 'mosgutenberg_css' ] );
	//add_settings_field( 'field_js', __( 'Custom Js', 'mosgutenberg' ), 'mosgutenberg_field_js_cb', 'mosgutenberg', 'mosgutenberg_section_scripts_start', [ 'label_for' => 'mosgutenberg_js' ] );
	add_settings_section('mosgutenberg_section_scripts_end', '', 'mosgutenberg_section_end_cb', 'mosgutenberg');

}
add_action( 'admin_init', 'mosgutenberg_settings_init' );

function get_mosgutenberg_active_tab () {
	$output = array(
		'option_prefix' => admin_url() . "/options-general.php?page=mosgutenberg_settings&tab=",
		//'option_prefix' => "?post_type=p_file&page=mosgutenberg_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function mosgutenberg_section_top_nav_cb( $args ) {
	$data = get_mosgutenberg_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function mosgutenberg_section_dash_start_cb( $args ) {
	$data = get_mosgutenberg_active_tab ();
  global $mosgutenberg_options;
	?>
	<div id="mos-invoice-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php var_dump($mosgutenberg_options) ?>

	<?php
}
function mosgutenberg_section_scripts_start_cb( $args ) {
	$data = get_mosgutenberg_active_tab ();
	?>
	<div id="mos-invoice-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function mosgutenberg_field_logo_cb( $args ) {
	global $mosgutenberg_options;
	?>	
	<div class="input-group">
	<input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text mos_uploaded_image" value="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>">
	<input class="mos_upload_image_button button" type="button" value="Upload Logo" />
	</div>
	<img class="company-logo" src="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>" alt="">
	
	<?php
}
function mosgutenberg_field_name_cb( $args ) {
	global $mosgutenberg_options;
	?>	
	<div class="input-group">
	<input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function mosgutenberg_field_email_cb( $args ) {
	global $mosgutenberg_options;
	?>	
	<div class="input-group">
	<input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function mosgutenberg_field_phone_cb( $args ) {
	global $mosgutenberg_options;
	?>	
	<div class="input-group">
	<input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function mosgutenberg_field_address_cb( $args ) {
	global $mosgutenberg_options;
	?>
	<textarea name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?></textarea>
	<?php
}
function mosgutenberg_field_invioce_prefix_cb( $args ) {
	global $mosgutenberg_options;
	?>	
	<div class="input-group">
	<input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function mosgutenberg_field_jquery_cb( $args ) {
	global $mosgutenberg_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? ( checked( $mosgutenberg_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mosgutenberg' ); ?></label>
	<?php
}
function mosgutenberg_field_bootstrap_cb( $args ) {
	global $mosgutenberg_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? ( checked( $mosgutenberg_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mosgutenberg' ); ?></label>
	<?php
}
function mosgutenberg_field_css_cb( $args ) {
	global $mosgutenberg_options;
	?>
	<textarea name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mosgutenberg_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mosgutenberg_field_js_cb( $args ) {
	global $mosgutenberg_options;
	?>
	<textarea name="mosgutenberg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mosgutenberg_options[ $args['label_for'] ] ) ? esc_html_e($mosgutenberg_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mosgutenberg_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mosgutenberg_section_end_cb( $args ) {
	$data = get_mosgutenberg_active_tab ();
	?>
	</div>
	<?php
}


function mosgutenberg_options_page() {
	add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'mosgutenberg-options', 'mosgutenberg_options_page_html' );
	//add_submenu_page( 'mosgutenberg', 'Invoice Company Settings', 'Company Settings', 'manage_options', 'mosgutenberg_settings', 'mosgutenberg_admin_page' );
}
add_action( 'admin_menu', 'mosgutenberg_options_page' );

function mosgutenberg_options_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mosgutenberg_messages', 'mosgutenberg_message', __( 'Settings Saved', 'mosgutenberg' ), 'updated' );
	}
	settings_errors( 'mosgutenberg_messages' );
	?>
	<div class="wrap mos-invoice-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'mosgutenberg' );
		do_settings_sections( 'mosgutenberg' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}