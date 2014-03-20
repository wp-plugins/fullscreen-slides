<?php
function abcffs_cntbldrsl_build_fs($args){

    $postID = $args['id'];
    $pversion = $args['pversion'];
    $template = $args['template'];

    $optns = get_post_custom( $postID );
    $collID = isset( $optns['_abcffs_coll_id'] ) ? esc_attr( $optns['_abcffs_coll_id'][0] ) : '0';
    $url = isset( $optns['_abcffs_return_url'] ) ? esc_attr( $optns['_abcffs_return_url'][0] ) : '';
    $maxWM = 900;

    //Error: No collection selected
    if( $collID == 0 ){
        $msgL1 = 'Error: Images Collection not selected!.';
        $msgL2 = 'Open Fullscreen Slides, ' . strtoupper($template) . ' template and select a Collection.';
        return abcffs_cntbldrsl_err($msgL1, $msgL2);
    }

    $data = abcffs_cntbldrsl_get_data( $collID, $template );
    $maxWL = $data['maxWL'];
    $maxHL = $data['maxHL'];

    $style = abcffs_lib_css_style_wh($maxWM, '', true, false );

    $divFSCntr = '<div id="fsGalleria_' . $postID . '" class="fsGalleria abcffsCntr abcffsCntr_' . $postID . ' abcffs' . $pversion . '"' . $style . '></div>';

    //$w, $h, $url, $data
    $js = abcffs_cntbldrsl_js( $maxWL, $maxHL, $url, $data['data'] );

    $out = $divFSCntr . $js;
    return $out;
}


function abcffs_cntbldrsl_err($msgL1, $msgL2=''){

    if(!abcffs_lib_isblank($msgL1)){ $msgL1 = '<p>' . $msgL1 . '</p>'; }
    if(!abcffs_lib_isblank($msgL2)){ $msgL2 = '<p>' . $msgL2 . '</p>'; }

    $msg = $msgL1 . $msgL2;
    if(abcffs_lib_isblank($msg)){ return; }

    echo ('<div class="abcffsErrMsg">' . $msg . '</div>');

}

function abcffs_cntbldrsl_get_data($collID, $template ){

    $optns = abcffs_db_fs_coll_max($collID);
    $collURL = $optns['collURL'];
    $maxWL = $optns['maxWL'];
    $maxHL = $optns['maxHL'];

    $arrayData = '';
    $dbRows = abcffs_db_fs_images_light($collID);

    if ($dbRows) {
       foreach ( $dbRows as $dbRow ) {
           $arrayData[] = abcffs_cntbldrsl_data_item($collURL, $dbRow->filename, $dbRow->alt, '', $template);
       }
    }
    else{
        //Count images
        $imgQty = abcffs_db_count_published($collID);
        if(empty($imgQty)){ return abcffs_cntbldrsl_err('Error: Count published images function failed.');}

        $all = $imgQty['all'];
        $published = $imgQty['published'];

        if($all == 0){
            //Collection is empty.
            $msgL1 = 'Error: There are no images to display!. <p>Collection ID ' . $collID . '  has no images.</p>';
            $msgL2 = 'Open collection and upload images. ';
            return abcffs_cntbldrsl_err($msgL1, $msgL2);
        }

        if($published == 0){
            //All images have status: Unpublished.
            $msgL1 = 'Error: There are no images to display!. <p>Collection ID ' . $collID . '  has ' . $all . ' images but all of them have status: Unpublished.</p>';
            $msgL2 = 'See Image Collections FAQ:  <a href="http://abcfolio.com/help/wordpress-image-collections-faq/#publish_images">How to Publish images.</a>';
            return abcffs_cntbldrsl_err($msgL1, $msgL2);
        }

    }

//print_r($arrayData); die;

    $jsonData = '';

    if (version_compare(PHP_VERSION, '5.4.0', '<')) {
        //PHP 5.3
        $jsonData = json_encode($arrayData);
    }
    else{
        //PHP 5.4
        $jsonData = json_encode($arrayData, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT );
        //$jsonData = json_encode($arrayData, JSON_UNESCAPED_SLASHES );
    }

   return array(
        'data' => $jsonData,
        'maxWL' => $maxWL,
        'maxHL' => $maxHL + 45
   );
 }

function abcffs_cntbldrsl_data_item($collURL, $filename, $alt, $title, $template) {

    if (empty($filename)) { array(); }

    $imgL = abcffs_cntbldrsl_file_url($collURL, '', $filename);
    //$imgT = abcffs_cntbldrsl_file_url($collURL, 'thumbs', $filename);

    //$data['thumb'] = $imgT;
    $data['big'] = $imgL;
    if (!empty($alt)) { $data['alt'] = esc_attr( strip_tags( $alt ) ); }

    return $data;
 }





 function abcffs_cntbldrsl_js( $w, $h, $url, $data ){

    if($w == 0 || $h == 0) { return ''; }
    //------------------------------------------
     $wh = 'height:' . round(floatval($h/$w), 5) . ',';
    //------------------------------------------
    $dataSource = '';
    if(!empty($data)) {
        $data = 'var data = ' . $data . ';';
        $dataSource = 'dataSource:data';
    }
    //------------------------------------------
    $returnURL = '';
    if(!empty($url)) {
        $returnURL = 'returnURL:"' . $url . '",';
    }
    //------------------------------------------------------
    $out = '<script type="text/javascript">jQuery(document).ready(function($) {' . "\n";
    $out .= $data .  "\n";
    $out .= 'Galleria.run(".fsGalleria", {';
    $out .= $wh;
    $out .= $returnURL;
    $out .= $dataSource;
    $out .= '});' . "\n";
    $out .= '});<';
    $out .= '/script>';

    return $out;
}

function abcffs_cntbldrsl_file_url($collURL, $subFolder='', $file='') {

    if(empty($collURL)){ return '';}
    if(!empty($subFolder)){ $subFolder = trailingslashit($subFolder);}
    return untrailingslashit( trailingslashit($collURL) . $subFolder . $file );
}




