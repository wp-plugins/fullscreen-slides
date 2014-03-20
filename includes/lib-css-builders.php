<?php
/**
 * CSS builders
 *
*/
//====WxH============================================
function abcffs_lib_css_wh($w, $h, $maxW=false, $percentW=false, $maxH=false, $percentH=false){
    return abcffs_lib_css_w($w, $maxW, $percentW) . abcffs_lib_css_h($h, $maxH, $percentH);
}

function abcffs_lib_css_w($in, $max, $percent){
    if(abcffs_lib_isblank($in)) { return''; }
    $property = 'width:';
    if($max){ $property = 'max-width:'; }
    $units = 'px;';
    if($percent){ $units = '%;'; }
    return $property . $in . $units;
}

function abcffs_lib_css_h($in, $max, $percent){
    if(abcffs_lib_isblank($in)) { return''; }
    $property = 'height:';
    if($max){ $property = 'max-height:'; }
    $units = 'px;';
    if($percent){ $units = '%;'; }
    return $property . $in . $units;
}


//=======MARGINS============================================
function abcffs_lib_css_mtl($t, $l){ return abcffs_lib_css_mt($t) . abcffs_lib_css_ml($l); }

function abcffs_lib_css_ml($in){
    if(abcffs_lib_isblank($in)) { return''; }
    return 'margin-left:'. $in . abcffs_lib_css_px($in) . ';';;
}

function abcffs_lib_css_mt($in){
    if(abcffs_lib_isblank($in)) { return''; }
    return 'margin-top:'. $in . abcffs_lib_css_px($in) . ';';
}
//=======PADDING============================================
function abcffs_lib_css_ptl($t, $l){ return abcffs_lib_css_pt($t) . abcffs_lib_css_pl($l); }

function abcffs_lib_css_pl($in){
    if(abcffs_lib_isblank($in)) { return''; }
    $s = 'padding-left:';
    if(substr($in,0,1) == '-'){ $s = 'margin-left:'; }

    return $s . $in . abcffs_lib_css_px($in) . ';';
}

function abcffs_lib_css_pt($in){
    if(abcffs_lib_isblank($in)) { return''; }
    $s = 'padding-top:';
    if(substr($in,0,1) == '-'){ $s = 'margin-top:'; }

    return $s . $in . abcffs_lib_css_px($in) . ';';
}
//===STYLE================================================
function abcffs_lib_css_style_wh($w, $h, $maxW=false, $percentW=false, $maxH=false, $percentH=false ) {

    return abcffs_lib_css_style_tag(abcffs_lib_css_wh($w, $h, $maxW, $percentW, $maxH, $percentH));

}

function abcffs_lib_cssbldr_style_margin_tl($t, $l) { return abcffs_lib_css_style_tag(abcffs_lib_css_mtl($t, $l));}

//===HELPERS================================================
function abcffs_lib_css_class_tag( $cls ){
    if(abcffs_lib_isblank($cls)) {return '';}
    return ' class="' . $cls . '"';
}

 function abcffs_lib_css_style_tag($style) {
    if(abcffs_lib_isblank($style)) {return '';}
    return ' style="' . $style . '" ';
}

function abcffs_lib_css_px($in){
    $px = 'px';
    if($in == '0'){ $px = '';}
    return $px;
}
