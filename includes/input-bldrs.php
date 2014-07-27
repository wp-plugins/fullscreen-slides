<?php
/*
 *TODO:
 */
//==Messages===========================================================
function abcffs_msgs_error($id, $suffix='') { echo '<div class="wrap"><div class="error" id="error"><p>' . abcffs_txtbldr($id, $suffix) . '</p></div></div>'; }

function abcffs_msgs_info($id, $suffix='') { echo '<div class="wrap"><div class="updated fade" id="message"><p>' . abcffs_txtbldr($id, $suffix) . '</p></div></div>' . "\n"; }

function abcffs_msgs_ok() {
    echo '<div class="wrap"><div id="abcffsOK" class="updated" style="line-height: 1px;"><img src="'  . ABCFIC_PLUGIN_URL .  'images/msgok_32x32.png"></div></div>';
}
//===DIV Builders=======================================================================
function abcffs_inputbldr_hdivider() { return "<div class=\"abcffsHDivider\">&nbsp;</div>"; }
function abcffs_inputbldr_hdivider2() { return "<div class=\"abcffsHDivider2\">&nbsp;</div>"; }
function abcffs_inputbldr_hdivider501() { return "<div class=\"abcffsHDivider501\">&nbsp;</div>"; }
function abcffs_inputbldr_hdivider502() { return "<div class=\"abcffsHDivider502\">&nbsp;</div>"; }

//function abcffs_iputbldr_floats_cntr_s(){ return '<div class="abcffsFloatsCntr">'; }
//function abcffs_iputbldr_floats_cntr1_s(){ return '<div class="abcffsFloatsCntr1">'; }
//function abcffs_iputbldr_floats_cntr_e(){ return '<div class="abcffsClr"></div></div>'; }
//function abcffs_iputbldr_clr(){ return '<div class="abcffsClr"></div>'; }

//function abcffs_inputbldr_hdivider994() { return "<div class=\"abcffsHDivider4\">&nbsp;</div>"; }
function abcffs_inputbldr_hlp_wrap($in) { return '<div class="abcffsMboxHlp">' . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap12($in) { return '<div class="abcffsMboxHlp12">' . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_b($in) { return '<div class="abcffsMboxHlpB">' . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_b12($in) { return '<div class="abcffsMboxHlpB12">' . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_mt($in) { return '<div class="abcffsMboxHlpMT">'  . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_mt12($in) { return '<div class="abcffsMboxHlpMT12">'  . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_mtb($in) { return '<div class="abcffsMboxHlpMTB">'  . $in . '</div>'; }
function abcffs_inputbldr_hlp_wrap_mtb12($in) { return '<div class="abcffsMboxHlpMTB12">'  . $in . '</div>'; }

//===INPUTS=======================================================================
function abcffs_inputbldr_input_cbo($fldID, $fldName, $values, $selected, $lblID=0, $hlpID=0, $size='', $isInt=true, $cls='', $style='',  $clsCntr='', $clsLbl='', $lblSuffix = '', $clsHlpUnder='') {

    $optns = abcffs_inputbldr_input_options( $fldID, $fldName, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $lblSuffix, $clsHlpUnder='', $values, $selected );
    extract( $optns );

    return  $fldCntrDivS . $fldLblDiv . '<select id="' . $fldID . '" type="text"' . $cls .
            $style . ' name="' . $fldName . '" >' . $options . '</select>' . $hlpUnder . '</div>';
}

function abcffs_inputbldr_input_txt($fldID, $fldName, $fldValue, $lblID=0, $hlpID=0, $size='', $cls='', $style='', $clsCntr='', $clsLbl='', $lblSuffix = ''){

    $optns = abcffs_inputbldr_input_options( $fldID, $fldName, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $lblSuffix );
    extract( $optns );
    return  $fldCntrDivS . $fldLblDiv . '<input id="' . $fldID . '" type="text"' . $cls .
            $style . 'name="' . $fldName . '" value="' . $fldValue . '" />' . $hlpUnder . '</div>';
}

function abcffs_inputbldr_input_txt_readonly($fldID, $fldName, $fldValue, $lblID=0, $hlpID=0, $size='', $cls='', $style='', $clsCntr='', $clsLbl='', $lblSuffix = ''){

    $divs = '';
    $optns = abcffs_inputbldr_input_options( $fldID, $fldName, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $lblSuffix );
    extract( $optns );
    return  $fldCntrDivS . $fldLblDiv . '<input id="' . $fldID . '" type="text"' . $cls .
            $style . 'name="' . $fldName . '" value="' . $fldValue . '" readonly />' . $hlpUnder . '</div>';

    //return $divs . $lbl . '</div><input id="' .$fldID . '" type="text" ' . $cls . $style . 'name="' . $fldName . '" value="' . $fldValue . '" readonly />' . $hlp . '</div>';
}

function abcffs_inputbldr_input_button( $fldID, $fldName, $type, $lblID, $cls='', $onClick='' ){

    if(!empty($onClick)) {$onClick = 'onclick="' . $onClick . '"'; }
    $fldID = abcfic_inputbldr_id($fldID);
    $fldName = abcfic_inputbldr_name($fldName);
    $lblID = abcfic_txtbldr($lblID);

    return '<input type="' . $type . '" class="' . $cls . '"' . $fldID . $fldName .' value="' . $lblID . '"' . $onClick . ' />';

}
//===LABELS=======================================================================
function abcffs_inputbldr_lbl($fldID, $lblTxtID, $lblSuffix) {
    $out = '';
    $lblTxt = abcffs_inputbldr_lbl_txt($lblTxtID, $lblSuffix);
    if( !abcffs_lib_isblank($fldID)){$fldID = ' for="' . $fldID . '" ';}
    if( !abcffs_lib_isblank($lblTxt)) { $out = '<label' . $fldID . '>' . $lblTxt . '</label>';}
    //if($lblID > 0) { $out = '<label for="' . $fldID . '">' . abcffs_inputbldr_lbl_txt($lbl, $lblSuffix) . '</label>';}
    return $out;
}
function abcffs_inputbldr_hlp_top( $hlpID ) {
    $out = '';
    if($hlpID > 0) { $out = '<div class="abcffsHlpTop">' . abcffs_txtbldr($hlpID) . '</div>';}
    return $out;
}

function abcffs_inputbldr_hlp_under( $hlpID, $clsHlpUnder='' ) {
    $out = '';
    $clsSpan = !empty($clsHlpUnder) ? $clsHlpUnder : 'abcffsFldHlpUnder';

    if($hlpID > 0) { $out = '<span class="' . $clsSpan .'">' . abcffs_txtbldr($hlpID) . '</span>';}
    return $out;
}

function abcffs_inputbldr_section_header( $hlpID, $noHlp = false ) {
    $out = '';
    $suffix = '';
    if($noHlp) { $suffix = 'NoHlp'; }
    if($hlpID > 0) { $out = '<div class="abcffsSecHdr' . $suffix . '">' . abcffs_txtbldr($hlpID) . '</div>';}
    return $out;
}

function abcffs_inputbldr_hlp_data( $hlpID, $data, $fontSize = '11' ) {
    $out = '';
    if($hlpID > 0) { $out = '<span class="abcffsFldHlpData' . $fontSize . '">' . abcffs_txtbldr($hlpID) . $data .'</span>';}
    return $out;
}

//===HELPERS=====================================================================
function abcffs_inputbldr_id( $fldID ){

    if(!abcffs_lib_isblank($fldID)){ return ' id="' . $fldID . '"'; }
    return '';
}

function abcffs_inputbldr_name( $fldName ){

    if(!abcffs_lib_isblank($fldName)){ return ' name="' . $fldName . '"'; }
    return '';
}

function abcffs_inputbldr_input_options( $fldID, $fldName, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $lblSuffix, $clsHlpUnder='', $values='', $selected='') {

    list($w, $units) = abcffs_inputbldr_input_size($size);
    $w = abcffs_lib_htmlbldr_css_w($w, $units);
    $style = abcffs_lib_htmlbldr_css_style( $w . $style );

    if(empty($fldName)) { $fldName = $fldID; }
    $hlpUnder = abcffs_inputbldr_hlp_under($hlpID, $clsHlpUnder);
    $cls = abcffs_lib_htmlbldr_css_class($cls);
    $lbl = abcffs_inputbldr_lbl($fldID, $lblID, $lblSuffix );
    $fldCntrDivS = abcffs_inputbldr_fld_cntr_div($clsCntr);
    $fldLblDiv = abcffs_inputbldr_fld_lbl_div($clsLbl, $lbl);
    $cboOptions = abcffs_inputbldr_cbo_get_options($values, $selected);

    $out = array(
        'cls'       => $cls,
        'style'     => $style,
        'fldCntrDivS'      => $fldCntrDivS,
        'fldLblDiv'       => $fldLblDiv,
        'hlpUnder'       => $hlpUnder,
        'fldName'   => $fldName,
        'options'   => $cboOptions
    );
    return $out;
}
function abcffs_inputbldr_lbl_txt( $lblID, $lblSuffix ){

    $lbl = '';
    if(is_int($lblID)){ $lbl = abcffs_txtbldr($lblID, $lblSuffix); }
    return $lbl;
}

function abcffs_inputbldr_input_size( $size ) {

    $defaultW='30';
    $defaultUnits='%';
    if(empty($size)) { return array($defaultW, $defaultUnits); }

    $w = '';
    $units = substr($size, -1, 1);
    if( $units == '%' ) { $w = rtrim($size, '%'); }
    if( $units == 'x' ) {
        $w = rtrim($size, 'px');
        $units = 'px';
     }

    if(empty($w)) {return array($defaultW, $defaultUnits);}
    return array($w, $units);
}

function abcffs_inputbldr_fld_lbl_div($clsLbl, $lbl) {

    $divLbl = '';
    if(!empty($lbl)){
        $clsLbl = !empty($clsLbl) ? $clsLbl : 'abcffsFldLbl';
        $divLbl = '<div class="' . $clsLbl .'">' . $lbl . '</div>';
    }
    return $divLbl;
}

function abcffs_inputbldr_fld_cntr_div($clsCntr) {

    $clsCntr = !empty($clsCntr) ? $clsCntr : 'abcffsFldCntr';
    return '<div class="' . $clsCntr . '">';
}


function abcffs_inputbldr_cbo_get_options($values, $selected_value) {
    $out = '';
    if(empty($values)){return $out;}
    $selected = "";
    foreach($values as $key => $fldValue){
        //return ('key= ' . $key . ' sw= ' . $selected_value);
        $selected = abcffs_inputbldr_cbo_set_selected($key, $selected_value);
        $out .= "<option $selected value=\"$key\">$fldValue</option>\n";
    }
    return $out;
}

function abcffs_inputbldr_cbo_set_selected($key, $selected_value) {
    $out = "";
    if(!abcffs_lib_isblank($selected_value)) { if($key == $selected_value) {$out = " selected=\"selected\" "; } }
    return $out;
}