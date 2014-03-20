<?php
/*
 */

//--METABOXES---------------------------------------------
function abcffs_optns_is_post_light ( $postType ){

    if($postType == ABCFFS_POST_LIGHT){
        return true;
    }
    else {return false;}
}

function abcffs_optns_post_template($post){

    $postType = get_post_type( $post );
    $out = '';

    switch ($postType) {
        case ABCFFS_POST_LIGHT:
            $out = 'light';
            break;
        default:
            break;
    }
    return $out;
}