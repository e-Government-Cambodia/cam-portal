<?php
/**
 * Fuctions for register Post Type Brand
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @package Cambodia_Portal
 */

function cam_portal_setup_organization_post(){
    $labels = array(
        'name'               => _x( 'Organization', 'post type general name', 'cam-portal' ),
		'singular_name'      => _x( 'Organization', 'post type singular name', 'cam-portal' ),
		'menu_name'          => _x( 'Organization', 'admin menu', 'cam-portal' ),
		'name_admin_bar'     => _x( 'Organization', 'add new on admin bar', 'cam-portal' ),
		'add_new'            => _x( 'Add New', 'Organization', 'cam-portal' ),
		'add_new_item'       => __( 'Add New Organization', 'cam-portal' ),
		'new_item'           => __( 'New Organization', 'cam-portal' ),
		'edit_item'          => __( 'Edit Organization', 'cam-portal' ),
		'view_item'          => __( 'View Organization', 'cam-portal' ),
		'all_items'          => __( 'All Organization', 'cam-portal' ),
		'search_items'       => __( 'Search Organization', 'cam-portal' ),
		'parent_item_colon'  => __( 'Parent Organization:', 'cam-portal' ),
		'not_found'          => __( 'No Organization found.', 'cam-portal' ),
		'not_found_in_trash' => __( 'No Organization found in Trash.', 'cam-portal' )
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'organization', 'with_front' => false),
        'menu_position' => 12,
        'menu_icon'     => 'dashicons-store',
        'supports'      => array('title')
    );
    register_post_type('cam_portal_organization', $args);
}
add_action ('init', 'cam_portal_setup_organization_post');