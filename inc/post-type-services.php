<?php

/**
 * Register a custom post type called "Service".
 *
 * @see get_post_type_labels() for label keys.
 */



 function harry_services_template_include($single_template){
	 if( is_singular('harry-services')){
		 $single_template = __DIR__.'/template/service-single.php';
	 }    
	 return $single_template;
 }
 add_filter( 'template_include', 'harry_services_template_include' );


function harry_service_post_type() {
	$labels = array(
		'name'                  => _x( 'Services', 'Post type general name', 'harry-core' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'harry-core' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'harry-core' ),
		'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'harry-core' ),
		'add_new'               => __( 'Add New', 'harry-core' ),
		'add_new_item'          => __( 'Add New Service', 'harry-core' ),
		'new_item'              => __( 'New Service', 'harry-core' ),
		'edit_item'             => __( 'Edit Service', 'harry-core' ),
		'view_item'             => __( 'View Service', 'harry-core' ),
		'all_items'             => __( 'All Services', 'harry-core' ),
		'search_items'          => __( 'Search Services', 'harry-core' ),
		'parent_item_colon'     => __( 'Parent Services:', 'harry-core' ),
		'not_found'             => __( 'No Services found.', 'harry-core' ),
		'not_found_in_trash'    => __( 'No Services found in Trash.', 'harry-core' ),
		'featured_image'        => _x( 'Service Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'harry-core' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'harry-core' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'harry-core' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'harry-core' ),
		'archives'              => _x( 'Service archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'harry-core' ),
		'insert_into_item'      => _x( 'Insert into Service', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'harry-core' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Service', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'harry-core' ),
		'filter_items_list'     => _x( 'Filter Services list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'harry-core' ),
		'items_list_navigation' => _x( 'Services list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'harry-core' ),
		'items_list'            => _x( 'Services list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'harry-core' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'service' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'harry-services', $args );


    $labels = array(
		'name'              => _x( 'Services Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Service', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Services', 'textdomain' ),
		'all_items'         => __( 'All Services', 'textdomain' ),
		'view_item'         => __( 'View Service', 'textdomain' ),
		'parent_item'       => __( 'Parent Service', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Service:', 'textdomain' ),
		'edit_item'         => __( 'Edit Service', 'textdomain' ),
		'update_item'       => __( 'Update Service', 'textdomain' ),
		'add_new_item'      => __( 'Add New Service', 'textdomain' ),
		'new_item_name'     => __( 'New Service Name', 'textdomain' ),
		'not_found'         => __( 'No Services Found', 'textdomain' ),
		'back_to_items'     => __( 'Back to Services', 'textdomain' ),
		'menu_name'         => __( 'Service Categories', 'textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'service' ),
		'show_in_rest'      => true,
	);


	register_taxonomy( 'service-cat', 'harry-services', $args );


}

add_action( 'init', 'harry_service_post_type' );