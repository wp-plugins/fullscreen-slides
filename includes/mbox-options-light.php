<?php
/**
 * Meta box: Post Options
 *
 */

add_action( 'add_meta_boxes', 'abcffs_add_mbox_optns_light', 10, 2 );
add_action( 'save_post', 'abcffs_save_mbox_optns_light', 10, 2 );

//Add meta box
function abcffs_add_mbox_optns_light($post_type) {
    if( abcffs_optns_is_post_light ( $post_type ) ) {
        remove_post_type_support( 'page', 'editor' );
        add_meta_box(
            'abcffs-mbox-optns',
            abcffs_txtbldr(3),
            'abcffs_get_data_mbox_optns_light',
            $post_type,
            'normal',
            'high'
            );
    }
}

//Render meta box.
function abcffs_get_data_mbox_optns_light( $post) {

    $optns = get_post_custom( $post->ID );
    $url = isset( $optns['_abcffs_return_url'] ) ? esc_attr( $optns['_abcffs_return_url'][0] ) : '';
    echo abcffs_inputbldr_input_txt('abffsUrl', '', $url, 37, 38, '90%');

    wp_nonce_field( basename( __FILE__ ), 'abcffs_mbox_nounce_optns_light' );
}

//Save meta box data.
function abcffs_save_mbox_optns_light( $post_id, $post ) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( !isset( $_POST['abcffs_mbox_nounce_optns_light'] ) || !wp_verify_nonce( $_POST['abcffs_mbox_nounce_optns_light'], basename( __FILE__ ) ) ) { return $post_id; }

    $oPpost = get_post_type_object( $post->post_type );
    if ( !current_user_can( $oPpost->cap->edit_post, $post_id ) ){return $post_id;}
    abcffs_mbsave_save_urlraw( $post_id, 'abffsUrl', '_abcffs_return_url');
}