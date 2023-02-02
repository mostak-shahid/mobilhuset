<?php 
/**
 * Customize the default option selected on CF7
 */
 function mos_cf7_form_elements($html) {
    $text = 'Select';
    $html = str_replace('---',  $text , $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'mos_cf7_form_elements');

function mos_cf7_select_values($tag)
{
    if ($tag['basetype'] != 'select') {
        return $tag;
    }

    $values = [];
    $labels = [];
    foreach ($tag['raw_values'] as $raw_value) {
        $raw_value_parts = explode('|', $raw_value);
        if (count($raw_value_parts) >= 2) {
            $values[] = $raw_value_parts[1];
            $labels[] = $raw_value_parts[0];
        } else {
            $values[] = $raw_value;
            $labels[] = $raw_value;
        }
    }
    $tag['values'] = $values;
    $tag['labels'] = $labels;

    // Optional but recommended:
    //    Display labels in mails instead of values
    //    You can still use values using [_raw_tag] instead of [tag]
    $reversed_raw_values = array_map(function ($raw_value) {
        $raw_value_parts = explode('|', $raw_value);
        return implode('|', array_reverse($raw_value_parts));
    }, $tag['raw_values']);
    $tag['pipes'] = new \WPCF7_Pipes($reversed_raw_values);

    return $tag;
}
add_filter('wpcf7_form_tag', 'mos_cf7_select_values', 10);



add_action( 'wpcf7_init', 'custom_add_form_tag_source' );
 
function custom_add_form_tag_source() {
    wpcf7_add_form_tag( 'source', 'custom_source_form_tag_handler' ); // "source" is the type of the form-tag
}
 
function custom_source_form_tag_handler( $tag ) {    
    //return date_i18n( get_option( 'time_format' ) );
    return '<input type="hidden" name="source" value="'.get_the_permalink(get_the_ID()).'" />';
}

/**/
add_action( 'wpcf7_init', 'custom_add_form_tag_jobs' );

function custom_add_form_tag_jobs() {
    wpcf7_add_form_tag( array( 'jobs', 'jobs*' ), 'custom_jobs_form_tag_handler', true );
}

function custom_jobs_form_tag_handler( $tag ) {

    $tag = new WPCF7_FormTag( $tag );

    if ( empty( $tag->name ) ) {
        return '';
    }

    $validation_error = wpcf7_get_validation_error( $tag->name );

    $class = wpcf7_form_controls_class( $tag->type );

    if ( $validation_error ) {
        $class .= ' wpcf7-not-valid';
    }

    $atts = array();

    $atts['class'] = $tag->get_class_option( $class );
    $atts['id'] = $tag->get_id_option();

    if ( $tag->is_required() ) {
        $atts['aria-required'] = 'true';
    }

    $atts['aria-invalid'] = $validation_error ? 'true' : 'false';

    $atts['name'] = $tag->name;

    $atts = wpcf7_format_atts( $atts );

    $jobs = '<option value="">Select</option>';

    $query = new WP_Query(array(
        'post_type' => 'job',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'       => 'title',
        'order'         => 'ASC',
    ));
    $id = @$_GET["id"];
    while ($query->have_posts()) {
        $query->the_post();
        $post_title = get_the_title();
        $selected = (get_the_ID() == $id)?'selected':'';
        
        //$jobs .= sprintf( '<option value="%1$s" %2$s>%3$s</option>', get_the_ID(), $selected, esc_html( $post_title ) );
        $jobs .= sprintf( '<option %1$s>%2$s</option>', $selected, esc_html( $post_title ) );
    }

    wp_reset_query();

    $jobs = sprintf(
        '<span class="wpcf7-form-control-wrap %1$s"><select %2$s>%3$s</select>%4$s</span>',
        sanitize_html_class( $tag->name ),
        $atts,
        $jobs,
        $validation_error
    );

    return $jobs;
}
//add_filter( 'wpcf7_validate_jobs', 'wpcf7_jobs_validation_filter', 10, 2 );
//add_filter( 'wpcf7_validate_jobs*', 'wpcf7_jobs_validation_filter', 10, 2 );

function wpcf7_jobs_validation_filter( $result, $tag ) {
    $tag = new WPCF7_FormTag( $tag );

    $name = $tag->name;

    if ( isset( $_POST[$name] ) && is_array( $_POST[$name] ) ) {
        foreach ( $_POST[$name] as $key => $value ) {
            if ( '' === $value ) {
                unset( $_POST[$name][$key] );
            }
        }
    }

    $empty = ! isset( $_POST[$name] ) || empty( $_POST[$name] ) && '0' !== $_POST[$name];

    if ( $tag->is_required() && $empty ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
    }

    return $result;
}

//Adding Button
add_action( 'wpcf7_init', 'mos_add_form_tag_phone', 10, 0 );

function mos_add_form_tag_phone() {
	wpcf7_add_form_tag( array('phone', 'phone*'), 'mos_phone_form_tag_handler', true );
}

function mos_phone_form_tag_handler( $tag ) {
    
    global $countryCodes;
    
    if ( empty( $tag->name ) ) {
        return '';
    }
    
    $validation_error = wpcf7_get_validation_error( $tag->name );
    
	$class = wpcf7_form_controls_class( $tag->type );
    
    if ( $validation_error ) {
        $class .= ' wpcf7-not-valid';
    }

	$atts = array();
    
    if ( $tag->is_required() ) {
        $atts['aria-required'] = 'true';
    }

	//$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

//	$value = isset( $tag->values[0] ) ? $tag->values[0] : '';
//
//	if ( empty( $value ) ) {
//		$value = __( 'Submit', 'contact-form-7' );
//	}

	$atts['name'] = isset( $tag->name ) ? $tag->name . '-number' : '';
    if ($tag->values && $tag->values[0]) {
        if ($tag->has_option( 'placeholder' )) {
            $atts['placeholder'] = $tag->values[0];
        } else {
            $atts['value'] = $tag->values[0];
        }
    }

	$atts = wpcf7_format_atts( $atts );
    
    $options = '';
    
    foreach($countryCodes as $code) {
        $options .= '<option>'.$code.'</option>';
    }

	//$html = sprintf( '<input type="tel" %1$s />%2$s', $atts, $value );
	$html = sprintf( '<span class="d-flex phone-input-group m-0 %1$s"><select  class="form-select" type="text" name="%2$s">%3$s</select><input type="tel" %4$s /></span>', $tag->get_class_option( $class ), $tag->name . '-code', $options, $atts );

	return $html;
}

/* Tag generator */

add_action( 'wpcf7_admin_init', 'mos_add_tag_generator_phone', 55, 0 );

function mos_add_tag_generator_phone() {
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add( 'phone', __( 'phone', 'contact-form-7' ),
		'mos_tag_generator_phone', array( 'nameless' => 1 ) );
}

function mos_tag_generator_phone( $contact_form, $args = '' ) {
	$args = wp_parse_args( $args, array() );

	$description = __( "Generate a form-tag for a button tag button. For more details, see %s.", 'contact-form-7' );

	$desc_link = wpcf7_link( __( 'https://contactform7.com/submit-button/', 'contact-form-7' ), __( 'Submit button', 'contact-form-7' ) );

?>
<div class="control-box">
<fieldset>
<legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>

<table class="form-table">
<tbody>
	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-required' ); ?>"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></label></th>
	<td><input type="checkbox" name="required" id="<?php echo esc_attr( $args['content'] . '-required' ); ?>" /> Required field</td>
	</tr>
	
	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="name" class="oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
	</tr>
	
	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Default value', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>" /><br/><label><input type="checkbox" name="placeholder" class="option"> Use this text as the placeholder of the field</label></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
	</tr>

	<tr>

</tbody>
</table>
</fieldset>
</div>

<div class="insert-box">
	<input type="text" name="phone" class="tag code" readonly="readonly" onfocus="this.select()" />
	
	<div class="submitbox">
	<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
	</div>
	<br class="clear">
	<p class="description mail-tag"><label for="tag-generator-panel-text-mailtag">To use the value input through this field in a mail field, you need to insert the corresponding mail-tag nto the field on the Mail tab.</label></p>
</div>
<?php
}