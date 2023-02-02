<?php
function mos_custom_post_types() {
	/**
	 * Post Type: Layouts.
	 */
	$labels = [
		"name" => esc_html__( "Layouts", "mosgutenberg" ),
		"singular_name" => esc_html__( "Layout", "mosgutenberg" ),
	];
	$args = [
		"label" => esc_html__( "Layouts", "mosgutenberg" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "layout", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
        "menu_icon" => "dashicons-editor-kitchensink",
        "menu_position" => 4,
	];
	register_post_type( "layout", $args );
}
add_action( 'init', 'mos_custom_post_types' );


function mos_custom_taxonomy() {
	/**
	 * Taxonomy: Categories.
	 */
	$labels = [
		"name" => esc_html__( "Categories", "mosgutenberg" ),
		"singular_name" => esc_html__( "Category", "mosgutenberg" ),
	];	
	$args = [
		"label" => esc_html__( "Categories", "mosgutenberg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'layout_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "layout_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "layout_category", [ "layout" ], $args );
	/**
	 * Taxonomy: Tags.
	 */
	$labels = [
		"name" => esc_html__( "Tags", "mosgutenberg" ),
		"singular_name" => esc_html__( "Tag", "mosgutenberg" ),
	];	
	$args = [
		"label" => esc_html__( "Tags", "mosgutenberg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'layout_tag', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "layout_tag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "layout_tag", [ "layout" ], $args );
}
add_action( 'init', 'mos_custom_taxonomy' );
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
