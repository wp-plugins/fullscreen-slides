<?php
/**
 * Process shortcode
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

//Add shortcode
function abcffs_scodes_add( $args ) {

    $args = shortcode_atts( array( 'id' => '0', 'template' => '', 'pversion' => '103' ), $args );
    $jsTheme = 'abcffs-' . $args['template'] . '-js';

    wp_enqueue_script( 'abcffs-galleria-js' );
    wp_enqueue_script( $jsTheme );

    return abcffs_cntbldrsl_build_fs($args);
}
add_shortcode( 'abcf-fullscreen-slides', 'abcffs_scodes_add' );

//Sortcode builder
function abcffs_scodes_build_scode( $args ) {

    $postID = intval($args['id']);
    if($postID == 0) { return '';}

    $scode = '[abcf-fullscreen-slides' . ' id="' . $postID . '" template="' . $args['template'] . '"]';
    return esc_attr( $scode );
}
