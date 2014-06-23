<?php
/*
 *TODO:
 */
function abcffs_txtbldr($id, $suffix='') {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = __('Help', 'abcffs-td');
            break;
        case 2:
            $out = __('Collection', 'abcffs-td');
            break;
        case 3:
            $out = __('Slideshow Options', 'abcffs-td');
            break;
        case 10:
            $out = __('Shortcode', 'abcffs-td');
            break;
        case 36:
            $out = __('Image Collections plugin is missing. Please install Image Collections Pro.', 'abcffs-td');
            break;
        case 37:
            $out = __('Exit Fullscreen Button - URL', 'abcffs-td');
            break;
        case 38:
            $out = __('What page to open when the Exit Fullscreen button is clicked.');
            break;
        case 39:
            $out = __('Copy this code and paste it into your post, page or text widget content.', 'abcffs-td');
            break;
        case 40:
            $out = __(' Image Collection. Source of images for your gallery.', 'abcffs-td');
            break;
        case 101:
            $out = __('Help', 'abcffs-td');
            break;
        case 104:
            $out = __('OK', 'abcftl-td');
            break;
        case 105:
            $out = __('You have no permision.', 'abcfic-td');
            break;
        case 108:
            $out = __('Collection', 'abcffs-td');
            break;
        case 109:
            $out = __('Cheatin&#8217; uh?', 'abcffs-td');
            break;
        case 110:
            $out = __('Uninstall', 'abcffs-td');
            break;
        default:
            $out = '';
            break;
    }
    return $out . $suffix;

}