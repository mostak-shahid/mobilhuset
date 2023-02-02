<?php 
function mos_post_details_metabox () {
	//add_meta_box( $id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null );

	add_meta_box( 
		'_mos_post_details_metabox', 
		'Post Details', 
		'mos_post_details_metabox_html', 
		array('post', 'page'),
		'normal', //advanced, normal, side
		$priority = 'default' //high, core, low
		/*$callback_args = null */
	);
}
add_action( 'add_meta_boxes', 'mos_post_details_metabox' );

function mos_post_details_metabox_html ($post) { 
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'mos_save_post_details_metabox', 'mos_post_details_metabox_nonce' );
	//$basic_field = get_post_meta( $post->id, '_mos_post_email', true )
	$mos_post_email = (get_post_meta( $post->ID, '_mos_post_email', true )) ? get_post_meta( $post->ID, '_mos_post_email', true ) : '';
	$mos_post_phone = (get_post_meta( $post->ID, '_mos_post_phone', true )) ? get_post_meta( $post->ID, '_mos_post_phone', true ) : '';
	$mos_post_address = (get_post_meta( $post->ID, '_mos_post_address', true )) ? get_post_meta( $post->ID, '_mos_post_address', true ) : '';
	?>	
    <div class="meta-unit">
        <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="mos_post_email">Email</label></p>
        <input class="widefat" type="text" id="mos_post_email" name="_mos_post_email" placeholder="Email" value="<?php echo $mos_post_email; ?>">
    </div>
    <div class="meta-unit">
        <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="mos_post_phone">Phone</label></p>
        <input class="widefat" type="text" id="mos_post_phone" name="_mos_post_phone" placeholder="Phone" value="<?php echo $mos_post_phone; ?>">
    </div>
    <div class="meta-unit">
        <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="mos_post_address">Address</label></p>
        <textarea class="widefat" type="text" id="mos_post_address" name="_mos_post_address" placeholder="Address"><?php echo $mos_post_address; ?></textarea>
    </div>

	<?php
}
function mos_post_details_metabox_update ($post_ID) {

	if ( ! isset( $_POST['mos_post_details_metabox_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['mos_post_details_metabox_nonce'], 'mos_save_post_details_metabox' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$mos_post_email = sanitize_text_field( $_POST['_mos_post_email'] );
	$mos_post_phone = sanitize_text_field( $_POST['_mos_post_phone'] );
	$mos_post_address = sanitize_text_field( $_POST['_mos_post_address'] );
	update_post_meta( $post_ID, '_mos_post_email', $mos_post_email );
	update_post_meta( $post_ID, '_mos_post_phone', $mos_post_phone );
	update_post_meta( $post_ID, '_mos_post_address', $mos_post_address );
}
add_action( 'save_post', 'mos_post_details_metabox_update' );