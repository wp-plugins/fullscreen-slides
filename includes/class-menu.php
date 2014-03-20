<?php
/**
 * Admin menu
*/
if (!class_exists("ABCFFS_Admin_Menu")) {

    class ABCFFS_Admin_Menu {

    function __construct() {
        add_action( 'admin_menu', array (&$this, 'add_menu') );
    }

    function add_menu() {
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );dashicons-format-gallery
        add_menu_page('Fullscreen Slides', 'Fullscreen Slides', 'edit_pages', ABCFFS_MENU_SLUG, '', 'dashicons-editor-distractionfree');

        //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page( ABCFFS_MENU_SLUG, abcffs_txtbldr(101), abcffs_txtbldr(1), 'edit_pages', 'abcffs-help', array(&$this, 'load_page'));
    }

    function load_page() {

        //$abcfic = ABCFIC_Main();
        switch ($_GET['page']){
            case 'abcffs-help' :
                $this->help_page();
                break;
        }
    }

//Add submenu page
function help_page() {
?>
<div class="wrap">
    <h2>
        Fullscreen Slides Light - <?php echo(abcffs_txtbldr(101)) ?>
    </h2>
    <div class="ggclDocs"><?php echo(abcffs_txtbldr(101)) ?></a>
        <p><a href="http://abcfolio.com/help/fullscreen-slides/">http://abcfolio.com/help/fullscreen-slides/</a><p>
    </div>
</div>
<?php
        }
    }
}

$abcfggclpm = new ABCFFS_Admin_Menu();