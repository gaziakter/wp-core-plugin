<?php 

add_filter( 'template_include', 'portfolios_template_include' );

function portfolios_template_include($single_template){
    if( is_singular('harry-portfolio')){
        $single_template = __DIR__.'/template/single-portfolio.php';
    }    
    return $single_template;
}

function wpdocs_kantbtrue_init() {
    $labels = array(
        'name'                  => _x( 'Portfolios', 'Post type general name', 'recipe' ),
        'singular_name'         => _x( 'Portfolio', 'Post type singular name', 'recipe' ),
        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'recipe' ),
        'name_admin_bar'        => _x( 'Portfolios', 'Add New on Toolbar', 'recipe' ),
        'add_new'               => __( 'Add New', 'recipe' ),
        'add_new_item'          => __( 'Add New Portfolio', 'recipe' ),
        'new_item'              => __( 'New Portfolios', 'recipe' ),
        'edit_item'             => __( 'Edit portfolio', 'recipe' ),
        'view_item'             => __( 'View portfolios', 'recipe' ),
        'all_items'             => __( 'All Portfolios', 'recipe' ),
        'search_items'          => __( 'Search portfolio', 'recipe' ),
        'parent_item_colon'     => __( 'Parent portfolio:', 'recipe' ),
        'not_found'             => __( 'No portfolios found.', 'recipe' ),
        'not_found_in_trash'    => __( 'No portfolios found in Trash.', 'recipe' ),
        'featured_image'        => _x( 'Rortfolios Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'recipe' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'archives'              => _x( 'Portfolios archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'recipe' ),
        'insert_into_item'      => _x( 'Insert into portfolio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'recipe' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolios', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'recipe' ),
        'filter_items_list'     => _x( 'Filter portfolios list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'recipe' ),
        'items_list_navigation' => _x( 'Portfolios list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'recipe' ),
        'items_list'            => _x( 'Portfolios list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'recipe' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Portfolios custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        // 'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );
     
    register_post_type( 'harry-portfolio', $args );

	$labels = array(
		'name'              => _x( 'Portfolio Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Portfolio', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'view_item'         => __( 'View Genre', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'not_found'         => __( 'No Genres Found', 'textdomain' ),
		'back_to_items'     => __( 'Back to Genres', 'textdomain' ),
		'menu_name'         => __( 'Portfolio Category', 'textdomain' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-cat' ),
		'show_in_rest'      => true,
	);


	register_taxonomy( 'portfolio-cat', 'harry-portfolio', $args );

}


add_action( 'init', 'wpdocs_kantbtrue_init' );