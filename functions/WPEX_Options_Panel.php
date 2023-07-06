<?php
class WPEX_Options_Panel {

    /**
     * Options panel arguments.
     */
    protected $args = [];

    /**
     * Options panel title.
     */
    protected $title = '';

    /**
     * Options panel slug.
     */
    protected $slug = '';

    /**
     * Option name to use for saving our options in the database.
     */
    protected $option_name = '';

    /**
     * Option group name.
     */
    protected $option_group_name = '';

    /**
     * User capability allowed to access the options page.
     */
    protected $user_capability = '';

    /**
     * Our array of settings.
     */
    protected $settings = [];

    /**
     * Our class constructor.
     */
    public function __construct( array $args, array $settings ) {
        $this->args              = $args;
        $this->settings          = $settings;
        $this->title             = $this->args['title'] ?? esc_html__( 'Options', 'text_domain' );
        $this->slug              = $this->args['slug'] ?? sanitize_key( $this->title );
        $this->option_name       = $this->args['option_name'] ?? sanitize_key( $this->title );
        $this->option_group_name = $this->option_name . '_group';
        $this->user_capability   = $args['user_capability'] ?? 'manage_options';

        add_action( 'admin_menu', [ $this, 'register_menu_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    /**
     * Register the new menu page.
     */
    public function register_menu_page() {
        add_menu_page(
            $this->title,
            $this->title,
            $this->user_capability,
            $this->slug,
            [ $this, 'render_options_page' ]
        );
    }

    /**
     * Register the settings.
     */
    public function register_settings() {
        register_setting( $this->option_group_name, $this->option_name, [
            'sanitize_callback' => [ $this, 'sanitize_fields' ],
            'default'           => $this->get_defaults(),
        ] );

        add_settings_section(
            $this->option_name . '_sections',
            false,
            false,
            $this->option_name
        );

        foreach ( $this->settings as $key => $args ) {
            $type = $args['type'] ?? 'text';
            $callback = "render_{$type}_field";
            if ( method_exists( $this, $callback ) ) {
                $tr_class = '';
                if ( array_key_exists( 'tab', $args ) ) {
                    $tr_class .= 'wpex-tab-item wpex-tab-item--' . sanitize_html_class( $args['tab'] );
                }
                add_settings_field(
                    $key,
                    $args['label'],
                    [ $this, $callback ],
                    $this->option_name,
                    $this->option_name . '_sections',
                    [
                        'label_for' => $key,
                        'class'     => $tr_class
                    ]
                );
            }
        }
    }

    /**
     * Saves our fields.
     */
    public function sanitize_fields( $value ) {
        $value = (array) $value;
        $new_value = [];
        foreach ( $this->settings as $key => $args ) {
            $field_type = $args['type'];
            $new_option_value = $value[$key] ?? '';
            if ( $new_option_value ) {
                $sanitize_callback = $args['sanitize_callback'] ?? $this->get_sanitize_callback_by_type( $field_type );
                $new_value[$key] = call_user_func( $sanitize_callback, $new_option_value, $args );
            } elseif ( 'checkbox' === $field_type ) {
                $new_value[$key] = 0;
            }
        }
        return $new_value;
    }

    /**
     * Returns sanitize callback based on field type.
     */
    protected function get_sanitize_callback_by_type( $field_type ) {
        switch ( $field_type ) {
            case 'select':
                return [ $this, 'sanitize_select_field' ];
                break;
            case 'textarea':
                return 'wp_kses_post';
                break;
            case 'checkbox':
                return [ $this, 'sanitize_checkbox_field' ];
                break;
            case 'repeater':
                return [ $this, 'sanitize_repeater_field' ];
                break;
            default:
            case 'text':
                return 'sanitize_text_field';
                break;
        }
    }

    /**
     * Returns default values.
     */
    protected function get_defaults() {
        $defaults = [];
        foreach ( $this->settings as $key => $args ) {
            $defaults[$key] = $args['default'] ?? '';
        }
        return $defaults;
    }

    /**
     * Sanitizes the checkbox field.
     */
    protected function sanitize_checkbox_field( $value = '', $field_args = [] ) {
        return ( 'on' === $value ) ? 1 : 0;
    }

    /**
     * Sanitizes the select field.
     */
    protected function sanitize_select_field( $value = '', $field_args = [] ) {
        $choices = $field_args['choices'] ?? [];
        if ( array_key_exists( $value, $choices ) ) {
            return $value;
        }
    }

    /**
     * Sanitizes the repeater field.
     */
    protected function sanitize_repeater_field( $value = '', $field_args = [] ) {
        // var_dump($value);
        // die();
        if(@$value && is_array($value) && !end($value)) {
            array_pop($value);
        }
        return $value;
    }

    /**
     * Renders the options page.
     */
    public function render_options_page() {
        if ( ! current_user_can( $this->user_capability ) ) {
            return;
        }

        if ( isset( $_GET['settings-updated'] ) ) {
            add_settings_error(
            $this->option_name . '_mesages',
            $this->option_name . '_message',
            esc_html__( 'Settings Saved', 'text_domain' ),
            'updated'
            );
        }

        settings_errors( $this->option_name . '_mesages' );

        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <?php $this->render_tabs(); ?>
            <form action="options.php" method="post" class="wpex-options-form">
                <?php
                    settings_fields( $this->option_group_name );
                    do_settings_sections( $this->option_name );
                    submit_button( 'Save Settings' );
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Renders options page tabs.
     */
    protected function render_tabs() {
        if ( empty( $this->args['tabs'] ) ) {
            return;
        }

        $tabs = $this->args['tabs'];
        ?>

        <style>.wpex-tab-item{ display: none; ?></style>

        <h2 class="nav-tab-wrapper wpex-tabs"><?php
            $first_tab = true;
            foreach ( $tabs as $id => $label ) {?>
                <a href="#" data-tab="<?php echo esc_attr( $id ); ?>" class="nav-tab<?php echo ( $first_tab ) ? ' nav-tab-active' : ''; ?>"><?php echo ucfirst( $label ); ?></a>
                <?php
                $first_tab = false;
            }
        ?></h2>

        <script>
            ( function() {
                document.addEventListener( 'click', ( event ) => {
                    const target = event.target;
                    if ( ! target.closest( '.wpex-tabs a' ) ) {
                        return;
                    }
                    event.preventDefault();
                    document.querySelectorAll( '.wpex-tabs a' ).forEach( ( tablink ) => {
                        tablink.classList.remove( 'nav-tab-active' );
                    } );
                    target.classList.add( 'nav-tab-active' );
                    targetTab = target.getAttribute( 'data-tab' );
                    document.querySelectorAll( '.wpex-options-form .wpex-tab-item' ).forEach( ( item ) => {
                        if ( item.classList.contains( `wpex-tab-item--${targetTab}` ) ) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    } );
                } );
                document.addEventListener( 'DOMContentLoaded', function () {
                    document.querySelector( '.wpex-tabs .nav-tab' ).click();
                }, false );
            } )();
        </script>

        <?php
    }

    /**
     * Returns an option value.
     */
    protected function get_option_value( $option_name ) {
        $option = get_option( $this->option_name );
        if ( ! array_key_exists( $option_name, $option ) ) {
            return array_key_exists( 'default', $this->settings[$option_name] ) ? $this->settings[$option_name]['default'] : '';
        }
        return $option[$option_name];
    }

    /**
     * Renders a repeater field.
     */
    public function render_repeater_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        var_dump($value);
        ?>
            <div class="repeater-wrapper">
                <div class="repeater-data">
                    <?php if (@$value && is_array($value)) { ?>
                        <?php foreach($value as $val) { ?>
                            <?php $n = 0;?>
                            <div class="repeater-unit">
                                <input
                                    type="text"
                                    id="<?php echo esc_attr( $args['label_for'] ); ?>"
                                    name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>][]"
                                    value="<?php echo esc_attr( $val ); ?>">
                                <?php if ($n!=0) ?><span class="theme_option_repeater_remove_button button button-secondary">x</span>
                            </div>
                            <?php $n++?>
                        <?php } ?>
                    <?php } else  { ?>
                        <div class="repeater-unit">
                            <input
                                type="text"
                                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>][]"
                                value="">
                        </div>
                    <?php }?>
                </div>
                <span class="theme_option_repeater_add_button button button-secondary">Add Row</span>
                <div class="repeater-data-wrapper" style="display: none">
                    <div class="repeater-unit">
                        <input
                            type="text"
                            name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>][]"
                            value=""><span class="theme_option_repeater_remove_button button button-secondary">x</span>
                    </div>
                </div>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
            </div>
        <?php
    }
    /**
     * Renders a text field.
     */
    public function render_text_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="text"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a color field.
     */
    public function render_color_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="color"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a date field.
     */
    public function render_date_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="date"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }
    

    /**
     * Renders a time field.
     */
    public function render_time_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="time"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a datetime field.
     */
    public function render_datetime_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="datetime-local"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a url field.
     */
    public function render_url_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="url"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a number field.
     */
    public function render_number_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $min = $this->settings[$option_name]['min'] ?? '0';
        $max = $this->settings[$option_name]['max'] ?? '100';
        $step = $this->settings[$option_name]['step'] ?? '1';
        ?>
            <input
                type="number"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>""
                min="<?php echo esc_html( $min ); ?>" 
                max="<?php echo esc_html( $max ); ?>" 
                step="<?php echo esc_html( $step ); ?>">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a range field.
     */
    public function render_range_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $min = $this->settings[$option_name]['min'] ?? '0';
        $max = $this->settings[$option_name]['max'] ?? '100';
        $step = $this->settings[$option_name]['step'] ?? '1';
        ?>
            <div class="range-wrapper">
                <input
                    type="range"
                    id="<?php echo esc_attr( $args['label_for'] ); ?>"
                    class="theme_option_range"
                    name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                    value="<?php echo esc_attr( $value ); ?>"
                    min="<?php echo esc_html( $min ); ?>" 
                    max="<?php echo esc_html( $max ); ?>" 
                    step="<?php echo esc_html( $step ); ?>">
                <input
                    type="number"
                    id="<?php echo esc_attr( $args['label_for'] ); ?>-input"
                    class="theme_option_range_value"
                    value="<?php echo esc_attr( $value ); ?>""
                    min="<?php echo esc_html( $min ); ?>" 
                    max="<?php echo esc_html( $max ); ?>" 
                    step="<?php echo esc_html( $step ); ?>"
                    readonly
                    >
            </div>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a tel field.
     */
    public function render_tel_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <input
                type="tel"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo esc_attr( $value ); ?>"">
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a image field.
     */
    public function render_image_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        ?>
            <div class="photo-container">
                <input
                    class="photo"
                    type="text"
                    id="<?php echo esc_attr( $args['label_for'] ); ?>"
                    name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                    value="<?php echo esc_attr( $value ); ?>">
                <span class="theme_option_photo_upload_button button button-secondary">Upload image</span>
                <span class="theme_option_photo_remove_button button button-secondary">Remove image</span>
                <?php if ( $description ) { ?>
                    <p class="description"><?php echo esc_html( $description ); ?></p>
                <?php } ?>
                <div class="theme_option_photo_container"><img src="<?php echo ( $value )?esc_attr( $value ):get_template_directory_uri().'/images/no_image_available.jpg'; ?>" data-src="<?php echo get_template_directory_uri().'/images/no_image_available.jpg'; ?>"/></div>
            </div>
        <?php
    }
    /**
     * Renders a textarea field.
     */
    public function render_textarea_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $rows        = $this->settings[$option_name]['rows'] ?? '4';
        $cols        = $this->settings[$option_name]['cols'] ?? '50';
        ?>
            <textarea
                type="text"
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                rows="<?php echo esc_attr( absint( $rows ) ); ?>"
                cols="<?php echo esc_attr( absint( $cols ) ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"><?php echo esc_attr( $value ); ?></textarea>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a checkbox field.
     */
    public function render_checkbox_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $text = $this->settings[$option_name]['text'] ?? '';
        ?>
            <input
                type="checkbox"            
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                <?php checked( $value, 1, true ); ?>
            >
            <?php if ( $text ) { ?>
                <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php echo esc_html( $text ); ?></label>
            <?php } ?>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a radio field.
     */
    public function render_radio_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $choices     = $this->settings[$option_name]['choices'] ?? [];
        ?>
            <div
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
            >
                <?php foreach ( $choices as $choice_v => $label ) { ?>
                    <input 
                    name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
                    value="<?php echo esc_attr( $choice_v ); ?>" 
                    type="radio"            
                    id="<?php echo sanitize_title(esc_attr( $choice_v )); ?>"
                    <?php checked( $choice_v, $value, true ); ?>>
                    <label for="<?php echo sanitize_title(esc_attr( $choice_v )); ?>"><?php echo esc_html( $label ); ?></label>
                <?php } ?>
            </div>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

    /**
     * Renders a select field.
     */
    public function render_select_field( $args ) {
        $option_name = $args['label_for'];
        $value       = $this->get_option_value( $option_name );
        $description = $this->settings[$option_name]['description'] ?? '';
        $choices     = $this->settings[$option_name]['choices'] ?? [];
        ?>
            <select
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                name="<?php echo $this->option_name; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
            >
                <?php foreach ( $choices as $choice_v => $label ) { ?>
                    <option value="<?php echo esc_attr( $choice_v ); ?>" <?php selected( $choice_v, $value, true ); ?>><?php echo esc_html( $label ); ?></option>
                <?php } ?>
            </select>
            <?php if ( $description ) { ?>
                <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php } ?>
        <?php
    }

}