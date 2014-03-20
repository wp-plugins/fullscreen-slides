<?php
function abcffs_db_fs_coll_max($collID) {

    global $wpdb;
    $dbRow = $wpdb->get_row( $wpdb->prepare(
    "SELECT c.colls_spath, c.colls_folder, c.coll_folder, d.maxWL, d.maxHL
    FROM $wpdb->abcficcolls c
    LEFT JOIN (SELECT coll_id, max(img_w) maxWL, max(img_h) maxHL
            FROM $wpdb->abcficimgs WHERE published = 1
            GROUP BY coll_id) d ON (c.coll_id  = d.coll_id)
    WHERE c.coll_id = %d", $collID ) ,ARRAY_N );


    //$dbRow Returns NULL if no result is found
    if(is_null($dbRow)) { return array(); }

    $collsSPath = $dbRow[0];
    $collsFolder = $dbRow[1];
    $collFolder = $dbRow[2];
    $maxWL = $dbRow[3];
    $maxHL = $dbRow[4];
    $collURL = abcffs_db_coll_url($collsSPath, $collsFolder, $collFolder);

    $optns = array(
    'collURL' => $collURL,
    'maxWL' => $maxWL,
    'maxHL' => $maxHL
    );
    return $optns;
}

function abcffs_db_fs_images_light($collID) {
    global $wpdb;
    if( is_numeric($collID) ){
        $dbRows = $wpdb->get_results( $wpdb->prepare(
        "SELECT i.img_id, i.filename, i.alt, i.img_title, i.img_w, i.img_h,
                i.sort_order
        FROM $wpdb->abcficimgs i
        WHERE i.coll_id = %d AND i.published = 1
        ORDER BY sort_order", $collID ), OBJECT_K );

        return $dbRows;
    }
}


function abcffs_db_count_published( $collID ) {

    global $wpdb;
    $all = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(1) FROM $wpdb->abcficimgs WHERE coll_id = %d", $collID ) );
    $published = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(1) FROM $wpdb->abcficimgs WHERE coll_id = %d AND published = 1", $collID ) );
    return array('all' => $all, 'published' => $published);
}

function abcffs_db_coll_url($collsSPath, $collsFolder, $collFolder) {

    if(!empty($collsSPath)){ $collsSPath = trailingslashit($collsSPath);}
    if(!empty($collsFolder)){ $collsFolder = trailingslashit($collsFolder);}
    if(!empty($collFolder)){ $collFolder = trailingslashit($collFolder);}

    return untrailingslashit(trailingslashit( site_url() ) . $collsSPath . $collsFolder . $collFolder );
}