<?php
/**
 * abcfMBColl
 */
add_action( 'add_meta_boxes', 'abcffs_add_mbox_coll', 10,2 );
add_action( 'save_post', 'abcffs_mbox_coll_save_data', 10, 2 );

function abcffs_add_mbox_coll($post_type) {
    if ( abcffs_optns_is_post_light ( $post_type ) ) {
        add_meta_box(
            'abcffs-mbox-coll',
            abcffs_txtbldr(2),
            'abcffs_mbox_coll_get_data',
            $post_type,
            'normal',
            'high'
        );
    }
}

function abcffs_mbox_coll_get_data( $post ) {

    $optns = get_post_custom( $post->ID );

    $collID = isset( $optns['_abcffs_coll_id'] ) ? esc_attr( $optns['_abcffs_coll_id'][0] ) : '0';

    $cboColls = array();
    if(function_exists('abcfic_dbu_cbo_collections')) {
        $cboColls = abcfic_dbu_cbo_collections();
    }
    else {
        abcffs_msgs_error(36);
        return;
    }
    echo abcffs_inputbldr_input_cbo('abcffsCollID', '',$cboColls, $collID, 0, 40);

    wp_nonce_field( basename( __FILE__ ), 'abcffs_mbox_coll_nc' );
}

function abcffs_mbox_coll_save_data( $post_id, $post ) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( !isset( $_POST['abcffs_mbox_coll_nc'] ) || !wp_verify_nonce( $_POST['abcffs_mbox_coll_nc'], basename( __FILE__ ) ) ) { return $post_id; }
    $oPpost = get_post_type_object( $post->post_type );
    if ( !current_user_can( $oPpost->cap->edit_post, $post_id ) ){return $post_id;}

    abcffs_mbsave_save_cbo( $post_id, 'abcffsCollID', '_abcffs_coll_id', '0');
}