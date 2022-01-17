<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
*	Master Class: Admin
*/
class WBG_Admin
{
    use 
        Wbg_Core,
        Wbg_Core_Settings,
        Wbg_Gallery_Settings_Content,
        Wbg_Search_Content_Settings,
        Wbg_Search_Styles_Settings,
        Wbg_Single_Content_Settings
    ;
    private  $wbg_version ;
    private  $wbg_assets_prefix ;
    function __construct( $version )
    {
        $this->wbg_version = $version;
        $this->wbg_assets_prefix = substr( WBG_PRFX, 0, -1 ) . '-';
    }
    
    /**
     *	Loading admin menu
     */
    function wbg_admin_menu()
    {
        $wbg_cpt_menu = 'edit.php?post_type=books';
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'General Settings', WBG_TXT_DOMAIN ),
            __( 'General Settings', WBG_TXT_DOMAIN ),
            'manage_options',
            'wbg-core-settings',
            array( $this, WBG_PRFX . 'general_settings' ),
            9
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Gallery Settings', WBG_TXT_DOMAIN ),
            __( 'Gallery Settings', WBG_TXT_DOMAIN ),
            'manage_options',
            'wbg-general-settings',
            array( $this, 'wbg_gallery_settings' ),
            10
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Search Panel Settings', WBG_TXT_DOMAIN ),
            __( 'Search Panel Settings', WBG_TXT_DOMAIN ),
            'manage_options',
            'wbg-search-panel-settings',
            array( $this, WBG_PRFX . 'search_panel_settings' ),
            11
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Book Detail Settings', WBG_TXT_DOMAIN ),
            __( 'Book Detail Settings', WBG_TXT_DOMAIN ),
            'manage_options',
            'wbg-details-settings',
            array( $this, WBG_PRFX . 'details_settings' ),
            12
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Usage & Tutorial', WBG_TXT_DOMAIN ),
            __( 'Usage & Tutorial', WBG_TXT_DOMAIN ),
            'manage_options',
            'wbg-get-help',
            array( $this, WBG_PRFX . 'get_help' ),
            13
        );
    }
    
    /**
     *	Loading admin panel assets
     */
    function wbg_enqueue_assets()
    {
        // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
        wp_register_style( 'jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style(
            $this->wbg_assets_prefix . 'font-awesome',
            WBG_ASSETS . 'css/font-awesome/css/font-awesome.min.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        wp_enqueue_style(
            $this->wbg_assets_prefix . 'admin',
            WBG_ASSETS . 'css/' . $this->wbg_assets_prefix . 'admin.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        if ( !wp_script_is( 'jquery' ) ) {
            wp_enqueue_script( 'jquery' );
        }
        // Load the datepicker script (pre-registered in WordPress).
        wp_enqueue_script( 'jquery-ui-datepicker' );
        
        if ( is_admin() ) {
            wp_enqueue_script( 'jquery-ui-draggable' );
            wp_enqueue_script( 'jquery-ui-droppable' );
        }
        
        wp_enqueue_script(
            $this->wbg_assets_prefix . 'admin',
            WBG_ASSETS . 'js/' . $this->wbg_assets_prefix . 'admin.js',
            array( 'jquery' ),
            $this->wbg_version,
            TRUE
        );
    }
    
    function wbg_custom_post_type()
    {
        $labels = array(
            'name'               => __( 'Books', WBG_TXT_DOMAIN ),
            'singular_name'      => __( 'Book', WBG_TXT_DOMAIN ),
            'menu_name'          => __( 'WBG Books', WBG_TXT_DOMAIN ),
            'parent_item_colon'  => __( 'Parent Book', WBG_TXT_DOMAIN ),
            'all_items'          => __( 'All Books', WBG_TXT_DOMAIN ),
            'view_item'          => __( 'View Book', WBG_TXT_DOMAIN ),
            'add_new_item'       => __( 'Add New Book', WBG_TXT_DOMAIN ),
            'add_new'            => __( 'Add New', WBG_TXT_DOMAIN ),
            'edit_item'          => __( 'Edit Book', WBG_TXT_DOMAIN ),
            'update_item'        => __( 'Update Book', WBG_TXT_DOMAIN ),
            'search_items'       => __( 'Search Book', WBG_TXT_DOMAIN ),
            'not_found'          => __( 'Not Found', WBG_TXT_DOMAIN ),
            'not_found_in_trash' => __( 'Not found in Trash', WBG_TXT_DOMAIN ),
        );
        $args = array(
            'label'               => __( 'books', WBG_TXT_DOMAIN ),
            'description'         => __( 'Description For Books', WBG_TXT_DOMAIN ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'public'              => true,
            'hierarchical'        => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'has_archive'         => true,
            'has_category'        => true,
            'can_export'          => true,
            'exclude_from_search' => false,
            'yarpp_support'       => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'menu_icon'           => 'dashicons-book',
            'query_var'           => true,
            'taxonomies'          => array( 'category', 'post_tag' ),
            'rewrite'             => array(
            'slug' => 'books',
        ),
        );
        register_post_type( 'books', $args );
    }
    
    function wbg_taxonomy_for_books()
    {
        $labels = array(
            'name'              => __( 'Book Categories', WBG_TXT_DOMAIN ),
            'singular_name'     => __( 'Book Category', WBG_TXT_DOMAIN ),
            'search_items'      => __( 'Search Book Categories', WBG_TXT_DOMAIN ),
            'all_items'         => __( 'All Book Categories', WBG_TXT_DOMAIN ),
            'parent_item'       => __( 'Parent Book Category', WBG_TXT_DOMAIN ),
            'parent_item_colon' => __( 'Parent Book Category:', WBG_TXT_DOMAIN ),
            'edit_item'         => __( 'Edit Book Category', WBG_TXT_DOMAIN ),
            'update_item'       => __( 'Update Book Category', WBG_TXT_DOMAIN ),
            'add_new_item'      => __( 'Add New Book Category', WBG_TXT_DOMAIN ),
            'new_item_name'     => __( 'New Book Category Name', WBG_TXT_DOMAIN ),
            'menu_name'         => __( 'Book Categories', WBG_TXT_DOMAIN ),
        );
        register_taxonomy( 'book_category', array( 'books' ), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'sort'              => true,
            'rewrite'           => array(
            'slug' => 'book-category',
        ),
        ) );
        do_action( 'wbg_register_taxonomy' );
    }
    
    function wbg_book_details_metaboxes()
    {
        add_meta_box(
            'wbg_book_details_link',
            __( 'Book Information', WBG_TXT_DOMAIN ),
            array( $this, WBG_PRFX . 'book_details_content' ),
            'books',
            'normal',
            'high'
        );
        // Changing Featured Image Text
        remove_meta_box( 'postimagediv', 'books', 'side' );
        add_meta_box(
            'postimagediv',
            __( 'Book Cover Image', WBG_TXT_DOMAIN ),
            'post_thumbnail_meta_box',
            'books',
            'side',
            'default'
        );
        do_action( 'wbg_add_metaboxes' );
    }
    
    function wbg_book_details_content()
    {
        wp_nonce_field( basename( __FILE__ ), 'wbg_books_fields' );
        require_once WBG_PATH . 'admin/view/partial/book-information.php';
    }
    
    /**
     * Save books information meta data
     */
    function wbg_save_book_meta( $post_id )
    {
        global  $post ;
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
        if ( !isset( $_POST['wbg_author'] ) || !wp_verify_nonce( $_POST['wbg_books_fields'], basename( __FILE__ ) ) ) {
            return $post_id;
        }
        $wbg_books_meta_posts = $_POST;
        $wbg_books_meta_params = array(
            'wbg_author'         => ( isset( $_POST['wbg_author'] ) ? sanitize_text_field( $_POST['wbg_author'] ) : '' ),
            'wbg_download_link'  => ( isset( $_POST['wbg_download_link'] ) ? sanitize_text_field( $_POST['wbg_download_link'] ) : '' ),
            'wbgp_buy_link'      => ( isset( $_POST['wbgp_buy_link'] ) ? sanitize_text_field( $_POST['wbgp_buy_link'] ) : '' ),
            'wbg_publisher'      => ( isset( $_POST['wbg_publisher'] ) ? sanitize_text_field( $_POST['wbg_publisher'] ) : '' ),
            'wbg_co_publisher'   => ( isset( $_POST['wbg_co_publisher'] ) ? sanitize_text_field( $_POST['wbg_co_publisher'] ) : '' ),
            'wbg_published_on'   => ( isset( $_POST['wbg_published_on'] ) ? sanitize_text_field( $_POST['wbg_published_on'] ) : '' ),
            'wbg_isbn'           => ( isset( $_POST['wbg_isbn'] ) ? sanitize_text_field( $_POST['wbg_isbn'] ) : '' ),
            'wbg_isbn_13'        => ( isset( $_POST['wbg_isbn_13'] ) ? sanitize_text_field( $_POST['wbg_isbn_13'] ) : '' ),
            'wbg_pages'          => ( isset( $_POST['wbg_pages'] ) ? sanitize_text_field( $_POST['wbg_pages'] ) : '' ),
            'wbg_country'        => ( isset( $_POST['wbg_country'] ) ? sanitize_text_field( $_POST['wbg_country'] ) : '' ),
            'wbg_language'       => ( isset( $_POST['wbg_language'] ) ? sanitize_text_field( $_POST['wbg_language'] ) : '' ),
            'wbg_dimension'      => ( isset( $_POST['wbg_dimension'] ) ? sanitize_text_field( $_POST['wbg_dimension'] ) : '' ),
            'wbg_filesize'       => ( isset( $_POST['wbg_filesize'] ) ? sanitize_text_field( $_POST['wbg_filesize'] ) : '' ),
            'wbg_status'         => ( isset( $_POST['wbg_status'] ) ? sanitize_text_field( $_POST['wbg_status'] ) : '' ),
            'wbgp_img_url'       => ( isset( $_POST['wbgp_img_url'] ) ? sanitize_text_field( $_POST['wbgp_img_url'] ) : '' ),
            'wbgp_regular_price' => ( isset( $_POST['wbgp_regular_price'] ) && filter_var( $_POST['wbgp_regular_price'], FILTER_SANITIZE_NUMBER_INT ) ? $_POST['wbgp_regular_price'] : '' ),
            'wbgp_sale_price'    => ( isset( $_POST['wbgp_sale_price'] ) && filter_var( $_POST['wbgp_sale_price'], FILTER_SANITIZE_NUMBER_INT ) ? $_POST['wbgp_sale_price'] : '' ),
            'wbg_cost_type'      => ( isset( $_POST['wbg_cost_type'] ) && filter_var( $_POST['wbg_cost_type'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_cost_type'] : '' ),
            'wbg_is_featured'    => ( isset( $_POST['wbg_is_featured'] ) && filter_var( $_POST['wbg_is_featured'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_is_featured'] : '' ),
            'wbg_item_weight'    => ( isset( $_POST['wbg_item_weight'] ) ? sanitize_text_field( $_POST['wbg_item_weight'] ) : '' ),
        );
        $wbg_books_meta = apply_filters( 'wbg_books_meta', $wbg_books_meta_params, $wbg_books_meta_posts );
        foreach ( $wbg_books_meta as $key => $value ) {
            if ( 'revision' === $post->post_type ) {
                return;
            }
            
            if ( get_post_meta( $post_id, $key, false ) ) {
                update_post_meta( $post_id, $key, $value );
            } else {
                add_post_meta( $post_id, $key, $value );
            }
            
            if ( !$value ) {
                delete_post_meta( $post_id, $key );
            }
        }
    }
    
    function wbg_general_settings()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $wbgShowCoreMessage = false;
        if ( isset( $_POST['updateCoreSettings'] ) ) {
            $wbgShowCoreMessage = $this->wbg_set_core_settings( $_POST );
        }
        $wbgCoreSettings = $this->wbg_get_core_settings();
        require_once WBG_PATH . 'admin/view/general-settings.php';
    }
    
    function wbg_gallery_settings()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowGeneralMessage = false;
        if ( isset( $_POST['updateGeneralSettings'] ) ) {
            $wbgShowGeneralMessage = $this->wbg_set_gallery_settings_content( $_POST );
        }
        $wpsdGallerySettingsContent = $this->wbg_get_gallery_settings_content();
        require_once WBG_PATH . 'admin/view/gallery-settings.php';
    }
    
    function wbg_search_panel_settings()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowMessage = false;
        // Content
        if ( isset( $_POST['updateSearchContent'] ) ) {
            $wbgShowMessage = $this->wbg_set_search_content_settings( $_POST );
        }
        $wbgSearchContent = $this->wbg_get_search_content_settings();
        // Style
        if ( isset( $_POST['updateSearchStyles'] ) ) {
            $wbgShowMessage = $this->wbg_set_search_styles_settings( $_POST );
        }
        $wbgSearchStyles = $this->wbg_get_search_styles_settings();
        require_once WBG_PATH . 'admin/view/wbg-search-settings.php';
    }
    
    function wbg_details_settings()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowMessage = false;
        if ( isset( $_POST['updateDetailsContent'] ) ) {
            $wbgShowMessage = $this->wbg_set_single_content_settings( $_POST );
        }
        $wbgDetailsContent = $this->wbg_get_single_content_settings();
        require_once WBG_PATH . 'admin/view/single-settings.php';
    }
    
    public static function wbg_display_notification( $type, $msg )
    {
        ?>
		<div class="wbg-alert <?php 
        printf( '%s', $type );
        ?>">
			<span class="wbg-closebtn">&times;</span>
			<strong><?php 
        esc_html_e( ucfirst( $type ), WBG_TXT_DOMAIN );
        ?>!</strong>
			<?php 
        esc_html_e( $msg, WBG_TXT_DOMAIN );
        ?>
		</div>
		<?php 
    }
    
    function wbg_change_featured_image_link_text( $content )
    {
        
        if ( 'books' === get_post_type() ) {
            $content = str_replace( 'Set featured image', __( 'Set Book Cover Here', WBG_TXT_DOMAIN ), $content );
            $content = str_replace( 'Remove featured image', __( 'Remove Book Cover Here', WBG_TXT_DOMAIN ), $content );
        }
        
        return $content;
    }
    
    function wbg_get_help()
    {
        require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'help-usage.php';
    }
    
    function wbgp_set_search_item_order()
    {
        // Delete search item option
        delete_option( 'wbgp_search_dad_list' );
        $new_order = $_POST['wbg_search_sort_items'];
        $new_list = array();
        $i = 0;
        foreach ( $new_order as $order ) {
            if ( !isset( $new_list[$i] ) ) {
                $new_list[$i] = $order;
            }
            $i++;
        }
        update_option( 'wbgp_search_dad_list', $new_list );
        die;
    }
    
    function wbgp_image_url_content()
    {
        global  $post ;
        $wbgp_img_url = get_post_meta( $post->ID, 'wbgp_img_url', true );
        echo  '<input type="text" name="wbgp_img_url" value="' . esc_attr( $wbgp_img_url ) . '" class="medium-text" style="width:100%;">' ;
    }

}