<?php
/**
 * Meta box: Shortcode
 *
*/
add_action( 'add_meta_boxes', 'abcffs_add_mbox_scode', 10, 2 );

function abcffs_add_mbox_scode($post_type) {
    if( abcffs_optns_is_post_light ( $post_type ) ) {
        add_meta_box(
            'abcffs-mbox-scode',
            abcffs_txtbldr(10),
            'abcffs_mbox_scode_get_data',
            $post_type,
            'normal',
            'high'
            );
    }
}

//Dispaly shortcode
function abcffs_mbox_scode_get_data( $post ) {

    $args = array(
        'id' => $post->ID,
        'template'  => abcffs_optns_post_template($post)
     );

    $scode = abcffs_scodes_build_scode( $args );
    echo abcffs_inputbldr_input_txt_readonly('abcffsScode', '', $scode, 0,39, '100%', 'abcffsInputB');
}


