<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
* Trait: Slide Settings
*/
trait Wbg_Core_Settings
{
    protected $fields, $settings, $options;
    
    protected function wbg_set_core_settings( $post ) {

        $this->fields   = $this->wbg_core_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_core_settings', $this->options, $post );

        return update_option( 'wbg_core_settings', $this->settings );

    }

    public function wbg_get_core_settings() {

        $this->fields   = $this->wbg_core_option_fileds();
		$this->settings = get_option('wbg_core_settings');
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_core_option_fileds() {

        return [
            [
                'name'      => 'wbg_gallery_page_slug',
                'type'      => 'text',
                'default'   => 'books',
            ],
            [
                'name'      => 'wbg_prefered_author',
                'type'      => 'string',
                'default'   => 'single',
            ],
            [
                'name'      => 'wbg_download_when_logged_in',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_affiliate_code',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_affiliate_code_apply',
                'type'      => 'string',
                'default'   => 'buy',
            ],
            [
                'name'      => 'wbg_book_cover_priority',
                'type'      => 'string',
                'default'   => 'f',
            ],
            [
                'name'      => 'wbg_default_book_cover_url',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_no_book_message',
                'type'      => 'text',
                'default'   => 'No books found. Please add one.',
            ],
            [
                'name'      => 'wbg_dwnld_btn_url_same_tab',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_hide_book_cover',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_enable_rtl',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_mss_alt_txt_alibris',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_amazon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_amazon_kindle',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_apple_books',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_barnes_&_noble',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_bookshop_org',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_google_play',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_kobo',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_lifeway',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_mardel',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_smashwords',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_sony_reader',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alt_txt_waterstones',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_alibris_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_amazon_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_amazon_kindle_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_apple_books_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_barnes_&_noble_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_bookshop_org_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_google_play_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_kobo_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_lifeway_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_mardel_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_smashwords_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_sony_reader_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_waterstones_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_download_btn_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_buy_btn_icon',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_price_format',
                'type'      => 'string',
                'default'   => 'default',
            ],
            [
                'name'      => 'wbg_display_free_as_price',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_free_as_price_lbl',
                'type'      => 'text',
                'default'   => 'Free',
            ],
            [
                'name'      => 'wbg_mss_alibris_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_amazon_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_amazon_kindle_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_apple_books_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_barnes_&_noble_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_bookshop_org_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_google_play_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_kobo_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_lifeway_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_mardel_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_smashwords_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_sony_reader_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_mss_waterstones_color',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_sub_title_prefix',
                'type'      => 'text',
                'default'   => '-',
            ],
        ];
    }
}