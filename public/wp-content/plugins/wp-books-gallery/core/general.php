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
                'default'   => '',
            ],
            [
                'name'      => 'wbg_prefered_author',
                'type'      => 'string',
                'default'   => 'single',
            ],
        ];
    }
}