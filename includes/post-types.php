<?php
/**
 * Custom post types setup
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {exit;}

function abcffs_setup_post_types() {


    //--Light---------------------------------------------------------------
    $lblsLight = array(
            'name'               => __( 'Light Template', 'abcffs-td' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Fullscreen Slides - Light Template', 'abcffs-td' ),
            'edit_item'          => __( 'Fullscreen Slides - Light Template', 'abcffs-td' ),
            'new_item'           => __( 'New'),
            'all_items'          => __( 'Light Template', 'abcffs-td' ),
            'search_items'       => __( 'Search', 'abcffs-td' ),
            'not_found'          => __( 'No records found', 'abcffs-td' ),
            'not_found_in_trash' => __( 'No records found in the Trash', 'abcffs-td' )
    );
    $argsLight = array(
            'labels'        => $lblsLight,
            'description'   => '',
            'public'        => true,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'menu_position' => 100,
            'show_ui'       => true,
            'show_in_menu'  => ABCFFS_MENU_SLUG
    );

    register_post_type( ABCFFS_POST_LIGHT, $argsLight );
}

add_action( 'init', 'abcffs_setup_post_types', 100 );

