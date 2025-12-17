<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
*	Master Class: Admin
*/
class WBG_Admin {
    use 
        Wbg_Core,
        Wbg_Core_Settings,
        Wbg_Gallery_Settings_Content,
        Wbg_Gallery_Settings_Styles,
        Wbg_Search_Content_Settings,
        Wbg_Search_Styles_Settings,
        Wbg_Single_Content_Settings,
        Wbg_Single_Styles_Settings
    ;
    private $wbg_version;

    private $wbg_assets_prefix;

    function __construct( $version ) {
        $this->wbg_version = $version;
        $this->wbg_assets_prefix = substr( WBG_PRFX, 0, -1 ) . '-';
    }

    /**
     *	Loading admin menu
     */
    function wbg_admin_menu() {
        $wbg_cpt_menu = 'edit.php?post_type=books';
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'General Settings', 'wp-books-gallery' ),
            __( 'General Settings', 'wp-books-gallery' ),
            'manage_options',
            'wbg-core-settings',
            array($this, WBG_PRFX . 'general_settings'),
            9
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Gallery Settings', 'wp-books-gallery' ),
            __( 'Gallery Settings', 'wp-books-gallery' ),
            'manage_options',
            'wbg-general-settings',
            array($this, 'wbg_gallery_settings'),
            10
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Search Panel Settings', 'wp-books-gallery' ),
            __( 'Search Panel Settings', 'wp-books-gallery' ),
            'manage_options',
            'wbg-search-panel-settings',
            array($this, WBG_PRFX . 'search_panel_settings'),
            11
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Book Detail Settings', 'wp-books-gallery' ),
            __( 'Book Detail Settings', 'wp-books-gallery' ),
            'manage_options',
            'wbg-details-settings',
            array($this, WBG_PRFX . 'details_settings'),
            12
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'API Import', 'wp-books-gallery' ),
            __( 'API Import', 'wp-books-gallery' ),
            'manage_options',
            'wbg-api-import',
            array($this, WBG_PRFX . 'api_import'),
            13
        );
        add_submenu_page(
            $wbg_cpt_menu,
            __( 'Usage & Tutorial', 'wp-books-gallery' ),
            __( 'Usage & Tutorial', 'wp-books-gallery' ),
            'manage_options',
            'wbg-get-help',
            array($this, WBG_PRFX . 'get_help'),
            14
        );
    }

    /**
     *	Loading admin panel assets
     */
    function wbg_enqueue_assets() {
        // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
        wp_register_style( 'jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style(
            $this->wbg_assets_prefix . 'font-awesome',
            WBG_ASSETS . 'css/fontawesome/css/all.min.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        wp_enqueue_style(
            $this->wbg_assets_prefix . 'fontawesome-iconpicker',
            WBG_ASSETS . 'css/fontawesome-iconpicker.min.css',
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
        if ( !did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script(
            $this->wbg_assets_prefix . 'fontawesome-iconpicker',
            WBG_ASSETS . 'js/fontawesome-iconpicker.min.js',
            array('jquery'),
            $this->wbg_version,
            TRUE
        );
        wp_enqueue_script(
            $this->wbg_assets_prefix . 'admin',
            WBG_ASSETS . 'js/' . $this->wbg_assets_prefix . 'admin.js',
            array('jquery'),
            $this->wbg_version,
            TRUE
        );
    }

    function wbg_custom_post_type() {
        $labels = array(
            'name'               => __( 'Books', 'wp-books-gallery' ),
            'singular_name'      => __( 'Book', 'wp-books-gallery' ),
            'menu_name'          => __( 'WBG Books', 'wp-books-gallery' ),
            'parent_item_colon'  => __( 'Parent Book', 'wp-books-gallery' ),
            'all_items'          => __( 'All Books', 'wp-books-gallery' ),
            'view_item'          => __( 'View Book', 'wp-books-gallery' ),
            'add_new_item'       => __( 'Add New Book', 'wp-books-gallery' ),
            'add_new'            => __( 'Add New', 'wp-books-gallery' ),
            'edit_item'          => __( 'Edit Book', 'wp-books-gallery' ),
            'update_item'        => __( 'Update Book', 'wp-books-gallery' ),
            'search_items'       => __( 'Search Book', 'wp-books-gallery' ),
            'not_found'          => __( 'Not Found', 'wp-books-gallery' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'wp-books-gallery' ),
        );
        $args = array(
            'label'               => __( 'books', 'wp-books-gallery' ),
            'description'         => __( 'Description For Books', 'wp-books-gallery' ),
            'labels'              => $labels,
            'supports'            => array(
                'title',
                'editor',
                'thumbnail',
                'comments',
                'author'
            ),
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
            'taxonomies'          => array('category', 'post_tag'),
            'rewrite'             => array(
                'slug' => 'books',
            ),
        );
        register_post_type( 'books', $args );
    }

    function wbg_taxonomy_for_books() {
        $labels = array(
            'name'              => __( 'Book Categories', 'wp-books-gallery' ),
            'singular_name'     => __( 'Book Category', 'wp-books-gallery' ),
            'search_items'      => __( 'Search Book Categories', 'wp-books-gallery' ),
            'all_items'         => __( 'All Book Categories', 'wp-books-gallery' ),
            'parent_item'       => __( 'Parent Book Category', 'wp-books-gallery' ),
            'parent_item_colon' => __( 'Parent Book Category:', 'wp-books-gallery' ),
            'edit_item'         => __( 'Edit Book Category', 'wp-books-gallery' ),
            'update_item'       => __( 'Update Book Category', 'wp-books-gallery' ),
            'add_new_item'      => __( 'Add New Book Category', 'wp-books-gallery' ),
            'new_item_name'     => __( 'New Book Category Name', 'wp-books-gallery' ),
            'menu_name'         => __( 'Book Categories', 'wp-books-gallery' ),
        );
        register_taxonomy( 'book_category', array('books'), array(
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

    function wbg_book_details_metaboxes() {
        add_meta_box(
            'wbg_book_details_link',
            __( 'Book Information', 'wp-books-gallery' ),
            array($this, WBG_PRFX . 'book_details_content'),
            'books',
            'normal',
            'high'
        );
        // Changing Featured Image Text
        remove_meta_box( 'postimagediv', 'books', 'side' );
        add_meta_box(
            'postimagediv',
            __( 'Book Cover Image', 'wp-books-gallery' ),
            'post_thumbnail_meta_box',
            'books',
            'side',
            'default'
        );
        do_action( 'wbg_add_metaboxes' );
    }

    function wbg_book_details_content() {
        wp_nonce_field( basename( __FILE__ ), 'wbg_books_fields' );
        require_once WBG_PATH . 'admin/view/partial/book-information.php';
    }

    function wbg_api_import() {
        require_once WBG_PATH . 'admin/view/wbg-api-import.php';
    }

    /**
     * Save books information meta data
     */
    function wbg_save_book_meta( $post_id ) {
        global $post;
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
        if ( !isset( $_POST['wbg_author'] ) || !wp_verify_nonce( $_POST['wbg_books_fields'], basename( __FILE__ ) ) ) {
            return $post_id;
        }
        $wbg_books_meta_posts = $_POST;
        $wbg_books_meta_params = array(
            'wbg_sub_title'         => ( isset( $_POST['wbg_sub_title'] ) ? sanitize_text_field( $_POST['wbg_sub_title'] ) : '' ),
            'wbg_author'            => ( isset( $_POST['wbg_author'] ) ? sanitize_text_field( $_POST['wbg_author'] ) : '' ),
            'wbg_download_link'     => ( isset( $_POST['wbg_download_link'] ) ? sanitize_url( $_POST['wbg_download_link'] ) : '' ),
            'wbgp_buy_link'         => ( isset( $_POST['wbgp_buy_link'] ) ? sanitize_url( $_POST['wbgp_buy_link'] ) : '' ),
            'wbg_publisher'         => ( isset( $_POST['wbg_publisher'] ) ? sanitize_text_field( $_POST['wbg_publisher'] ) : '' ),
            'wbg_co_publisher'      => ( isset( $_POST['wbg_co_publisher'] ) ? sanitize_text_field( $_POST['wbg_co_publisher'] ) : '' ),
            'wbg_published_on'      => ( isset( $_POST['wbg_published_on'] ) ? sanitize_text_field( $_POST['wbg_published_on'] ) : '' ),
            'wbg_isbn'              => ( isset( $_POST['wbg_isbn'] ) ? sanitize_text_field( $_POST['wbg_isbn'] ) : '' ),
            'wbg_isbn_13'           => ( isset( $_POST['wbg_isbn_13'] ) ? sanitize_text_field( $_POST['wbg_isbn_13'] ) : '' ),
            'wbg_asin'              => ( isset( $_POST['wbg_asin'] ) ? sanitize_text_field( $_POST['wbg_asin'] ) : '' ),
            'wbg_pages'             => ( isset( $_POST['wbg_pages'] ) ? sanitize_text_field( $_POST['wbg_pages'] ) : '' ),
            'wbg_country'           => ( isset( $_POST['wbg_country'] ) ? sanitize_text_field( $_POST['wbg_country'] ) : '' ),
            'wbg_language'          => ( isset( $_POST['wbg_language'] ) ? sanitize_text_field( $_POST['wbg_language'] ) : '' ),
            'wbg_dimension'         => ( isset( $_POST['wbg_dimension'] ) ? sanitize_text_field( $_POST['wbg_dimension'] ) : '' ),
            'wbg_filesize'          => ( isset( $_POST['wbg_filesize'] ) ? sanitize_text_field( $_POST['wbg_filesize'] ) : '' ),
            'wbg_status'            => ( isset( $_POST['wbg_status'] ) ? sanitize_text_field( $_POST['wbg_status'] ) : 'active' ),
            'wbgp_img_url'          => ( isset( $_POST['wbgp_img_url'] ) ? sanitize_url( $_POST['wbgp_img_url'] ) : '' ),
            'wbgp_regular_price'    => ( isset( $_POST['wbgp_regular_price'] ) && filter_var( $_POST['wbgp_regular_price'], FILTER_SANITIZE_NUMBER_INT ) ? $_POST['wbgp_regular_price'] : 0 ),
            'wbgp_sale_price'       => ( isset( $_POST['wbgp_sale_price'] ) && filter_var( $_POST['wbgp_sale_price'], FILTER_SANITIZE_NUMBER_INT ) ? $_POST['wbgp_sale_price'] : '' ),
            'wbg_cost_type'         => ( isset( $_POST['wbg_cost_type'] ) && filter_var( $_POST['wbg_cost_type'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_cost_type'] : '' ),
            'wbg_is_featured'       => ( isset( $_POST['wbg_is_featured'] ) && filter_var( $_POST['wbg_is_featured'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_is_featured'] : '' ),
            'wbg_item_weight'       => ( isset( $_POST['wbg_item_weight'] ) ? sanitize_text_field( $_POST['wbg_item_weight'] ) : '' ),
            'wbg_edition'           => ( isset( $_POST['wbg_edition'] ) ? sanitize_text_field( $_POST['wbg_edition'] ) : '' ),
            'wbg_illustrator'       => ( isset( $_POST['wbg_illustrator'] ) ? sanitize_text_field( $_POST['wbg_illustrator'] ) : '' ),
            'wbg_translator'        => ( isset( $_POST['wbg_translator'] ) ? sanitize_text_field( $_POST['wbg_translator'] ) : '' ),
            'wbg_editorial_reviews' => ( isset( $_POST['wbg_editorial_reviews'] ) ? wp_kses_post( $_POST['wbg_editorial_reviews'] ) : null ),
            'wbg_wc_product_type'   => ( isset( $_POST['wbg_wc_product_type'] ) ? sanitize_text_field( $_POST['wbg_wc_product_type'] ) : 'ext' ),
            'wbg_narrator'          => ( isset( $_POST['wbg_narrator'] ) ? sanitize_text_field( $_POST['wbg_narrator'] ) : '' ),
            'wbg_listening_length'  => ( isset( $_POST['wbg_listening_length'] ) ? sanitize_text_field( $_POST['wbg_listening_length'] ) : '' ),
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

    function wbg_general_settings() {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $wbgShowCoreMessage = false;
        if ( isset( $_POST['updateCoreSettings'] ) ) {
            if ( !isset( $_POST['wbg_general_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_general_nonce_field'], 'wbg_general_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowCoreMessage = $this->wbg_set_core_settings( $_POST );
            }
        }
        $wbgCoreSettings = $this->wbg_get_core_settings();
        require_once WBG_PATH . 'admin/view/general-settings.php';
    }

    /** 
     * Gallery Settings
     */
    function wbg_gallery_settings() {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowGeneralMessage = false;
        if ( isset( $_POST['updateGalleryContentSettings'] ) ) {
            if ( !isset( $_POST['wbg_gallery_c_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_gallery_c_nonce_field'], 'wbg_gallery_c_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowGeneralMessage = $this->wbg_set_gallery_settings_content( $_POST );
            }
        }
        $wpsdGallerySettingsContent = $this->wbg_get_gallery_settings_content();
        if ( isset( $_POST['updateGalleryStylesSettings'] ) ) {
            if ( !isset( $_POST['wbg_gallery_s_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_gallery_s_nonce_field'], 'wbg_gallery_s_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowGeneralMessage = $this->wbg_set_gallery_styles_settings( $_POST );
            }
        }
        $wpsdGallerySettingsStyles = $this->wbg_get_gallery_styles_settings();
        require_once WBG_PATH . 'admin/view/gallery-settings.php';
    }

    function wbg_search_panel_settings() {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowMessage = false;
        // Content
        if ( isset( $_POST['updateSearchContent'] ) ) {
            if ( !isset( $_POST['wbg_search_content_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_search_content_nonce_field'], 'wbg_search_content_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowMessage = $this->wbg_set_search_content_settings( $_POST );
            }
        }
        $wbgSearchContent = $this->wbg_get_search_content_settings();
        // Style
        if ( isset( $_POST['updateSearchStyles'] ) ) {
            if ( !isset( $_POST['wbg_search_style_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_search_style_nonce_field'], 'wbg_search_style_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowMessage = $this->wbg_set_search_styles_settings( $_POST );
            }
        }
        $wbgSearchStyles = $this->wbg_get_search_styles_settings();
        require_once WBG_PATH . 'admin/view/search-settings.php';
    }

    function wbg_details_settings() {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        $tab = ( isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null );
        $wbgShowMessage = false;
        // Content
        if ( isset( $_POST['updateDetailsContent'] ) ) {
            if ( !isset( $_POST['wbg_detail_content_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_detail_content_nonce_field'], 'wbg_detail_content_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowMessage = $this->wbg_set_single_content_settings( $_POST );
            }
        }
        $wbgDetailsContent = $this->wbg_get_single_content_settings();
        // Style
        if ( isset( $_POST['updateSingleStyles'] ) ) {
            if ( !isset( $_POST['wbg_detail_style_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_detail_style_nonce_field'], 'wbg_detail_style_action' ) ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                $wbgShowMessage = $this->wbg_set_single_styles_settings( $_POST );
            }
        }
        $wbgSingleStyles = $this->wbg_get_single_styles_settings();
        require_once WBG_PATH . 'admin/view/single-settings.php';
    }

    public static function wbg_display_notification( $type, $msg ) {
        ?>
		<div class="wbg-alert <?php 
        printf( '%s', $type );
        ?>">
			<span class="wbg-closebtn">&times;</span>
			<strong><?php 
        esc_html_e( ucfirst( $type ), 'wp-books-gallery' );
        ?>!</strong>
			<?php 
        esc_html_e( $msg, 'wp-books-gallery' );
        ?>
		</div>
		<?php 
    }

    function wbg_change_featured_image_link_text( $content ) {
        if ( 'books' === get_post_type() ) {
            $content = str_replace( 'Set featured image', __( 'Set Book Cover Here', 'wp-books-gallery' ), $content );
            $content = str_replace( 'Remove featured image', __( 'Remove Book Cover Here', 'wp-books-gallery' ), $content );
        }
        return $content;
    }

    function wbg_get_help() {
        require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'help-usage.php';
    }

    function wbgp_set_search_item_order() {
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

    function wbgp_image_url_content() {
        global $post;
        $wbgp_img_url = get_post_meta( $post->ID, 'wbgp_img_url', true );
        echo '<input type="text" name="wbgp_img_url" value="' . esc_attr( $wbgp_img_url ) . '" class="medium-text" style="width:100%;">';
    }

    function wbg_multiple_sale_sources() {
        require_once WBG_PATH . 'admin/view/partial/multiple-sale-sources.php';
    }

    function wbg_register_sidebar() {
        register_sidebar( array(
            'name'          => __( 'Books Gallery Sidebar', 'wp-books-gallery' ),
            'id'            => 'wbg-gallery-sidebar',
            'description'   => '',
            'class'         => 'sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s single-sidebar">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="title"><h3 class="wbg-sidebar">',
            'after_title'   => '</h3></div>',
        ) );
    }

    function wbg_editorial_reviews() {
        global $post;
        $wbg_editorial_reviews = get_post_meta( $post->ID, 'wbg_editorial_reviews', true );
        $settings = array(
            'media_buttons' => false,
            'editor_height' => 200,
        );
        $content = wp_kses_post( $wbg_editorial_reviews );
        $editor_id = 'wbg_editorial_reviews';
        wp_editor( $content, $editor_id, $settings );
    }

    function wbg_format_price_link() {
        require_once WBG_PATH . 'admin/view/partial/formats.php';
    }

    function wbg_best_sellers_rank() {
        global $post;
        $wbg_best_sellers_rank = get_post_meta( $post->ID, 'wbg_best_sellers_rank', true );
        $settings = array(
            'media_buttons' => false,
            'editor_height' => 200,
        );
        $content = wp_kses_post( $wbg_best_sellers_rank );
        $editor_id = 'wbg_best_sellers_rank';
        wp_editor( $content, $editor_id, $settings );
    }

}
