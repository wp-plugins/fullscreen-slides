<?php
/**
 * Save metabox data.
*/
//Save text field
function abcffs_mbsave_save_txt( $post_id, $field_id, $meta_key) {

    $new_value = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
    abcffs_mbsave_save_field( $post_id, $meta_key, $new_value);
}

function abcffs_mbsave_save_urlraw( $post_id, $field_id, $meta_key) {

    $new_value = ( isset( $_POST[$field_id] ) ? esc_url_raw( $_POST[$field_id] ) : '' );
    abcffs_mbsave_save_field( $post_id, $meta_key, $new_value);
}

//Save CSS size. Remove px since it is an default unit.
function abcffs_mbsave_save_css_size( $post_id, $field_id, $meta_key) {

    $newValue = ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' );
    $newValueFixed = str_replace(array(' ', ';', 'px'), '', $newValue);
    abcffs_mbsave_save_field( $post_id, $meta_key, $newValueFixed);
}

//Save integer
function abcffs_mbsave_save_int( $post_id, $field_id, $meta_key) {

    $newValue = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
    $newValueInt = abcffs_mbsave_valid_int($newValue);
    abcffs_mbsave_save_field( $post_id, $meta_key, $newValueInt);
}

//Save drop-down selection
function abcffs_mbsave_save_cbo( $post_id,  $field_id, $meta_key, $default, $saveDefault = false) {

    $new_value = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : $default );
    if($new_value == $default && !$saveDefault) { $new_value = ''; }
    abcffs_mbsave_save_field( $post_id, $meta_key, $new_value);
}


//Save form field
function abcffs_mbsave_save_field( $post_id, $meta_key, $new_value){
        $new_value = trim($new_value);
	$old_value = get_post_meta( $post_id, $meta_key, true );
	if ( $new_value && '' == $old_value ) {	add_post_meta( $post_id, $meta_key, $new_value, true ); }
	elseif ( $new_value != '' && $new_value != $old_value ) { update_post_meta( $post_id, $meta_key, $new_value ); }
	elseif ( '' == $new_value && isset($old_value) ) { delete_post_meta( $post_id, $meta_key, $old_value );}
}

//Get integer or empty string
function abcffs_mbsave_valid_int( $in, $default='') {
    if(abcffs_lib_isblank($in)){ return $default; }
    if($in == '0'){return $in;}
    $in = intval($in);
    if($in == 0){return $default;}
    return intval($in);
}