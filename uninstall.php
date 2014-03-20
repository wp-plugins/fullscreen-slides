<?php
/**
 * Fired when the plugin is uninstalled.
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )  { exit; }

// Leave no trail
if ( !is_multisite() ) {
    abcffs_uninstall_single();
}

function abcffs_uninstall_single() {
    //delete_option( 'abcffs_options' );
}

