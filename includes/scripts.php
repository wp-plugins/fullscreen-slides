<?php
/**
 * Add scripts, styles and icons
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

//Register equal heights java script
function abcffs_reg_scripts() {
    wp_register_script( 'abcffs-galleria-js', ABCFFS_PLUGIN_URL . 'templates/abcf-galleria-135-min.js', array( 'jquery' ), ABCFFS_VERSION, true );
    wp_register_script( 'abcffs-light-js', ABCFFS_PLUGIN_URL . 'templates/abcf-light-02-min.js', array( 'jquery' ), ABCFFS_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'abcffs_reg_scripts' );

function abcffs_enq_styles() {

    wp_register_style('abcffs-css-slides', ABCFFS_PLUGIN_URL . 'templates/abcf-slides-02-min.css', array(), ABCFFS_VERSION, 'all');
    wp_enqueue_style('abcffs-css-slides');

}
add_action( 'wp_enqueue_scripts', 'abcffs_enq_styles', 10000 );

//Add admin CSS
function abcffs_enq_admin_style() {
    wp_register_style('abcffs-admin', ABCFFS_PLUGIN_URL . 'css/abcffs-admin.css', ABCFFS_VERSION, 'all');
    wp_enqueue_style('abcffs-admin');
}
add_action( 'admin_enqueue_scripts', 'abcffs_enq_admin_style', 100 );