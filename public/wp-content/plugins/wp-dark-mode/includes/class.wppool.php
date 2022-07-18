<?php

/**
 * @WPPOOL Product
 * @Contact Sync
 * @Offer Sync
 */

namespace WPPOOL;

# check ABSPATH
defined('ABSPATH') or die('No script kiddies please!');

# WPPOOL Product Class 
if (!class_exists('\WPPOOL\Product')) :

    final class Product
    {
        # product name 
        protected $product = 'wp_dark_mode';

        # Fluent API URL
        protected $fluent_api_url = 'https://fluent.wppool.dev/wp-json/contact/sync';
        protected $fluent_api_key = '66E6D9A59A5A948B';

        # Promotional offer sheet URL
        protected $offer_sheet_url = 'https://docs.google.com/spreadsheets/export?format=csv&id=1D9ULWJj0f1mnXAE2rCwbVsDcKBTBpohPv9CarLOMJbo&gid=0';

        # products tags and lists 
        protected $products =  [
            'wp_dark_mode' => [
                'name' => 'WP Dark Mode',
                'list' => 20,
                'tag' => [
                    'pro' => 12,
                    'free' => 11,
                    'cancelled' => 23
                ],
            ],
            'easy_video_reviews' => [
                'name' => 'Easy Video Reviews',
                'list' => 22,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'sheets_to_wp_table_live_sync' => [
                'name' => 'Sheets to WP Table Live Sync',
                'list' => 21,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'chat_widgets_for_multivendor_marketplaces' => [
                'name' => 'Chat Widgets for Multivendor Marketplaces',
                'list' => 26,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'jitsi_meet' => [
                'name' => 'Jitsi Meet',
                'list' => 23,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'zero_bs_accounting' => [
                'name' => 'Zero BS Accounting',
                'list' => 24,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'stock_sync_with_google_sheet_for_woocommerce' => [
                'name' => 'Stock Sync with Google Sheet for WooCommerce',
                'list' => 46,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'stock_notifier_for_woocommerce' => [
                'name' => 'Stock Notifier for WooCommerce',
                'list' => 47,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
            'whats_plus_contact_form' => [
                'name' => 'Whats+ Contact Form',
                'list' => 12,
                'tag' => [
                    'pro' => 12,
                    'free' => 12,
                ],
            ],
        ];

        # Custom product
        protected $product_data = false;


        # Forced tags and lists

        protected function sanitize_product_name($product = 'WP Dark Mode')
        {
            $product = strtolower($product);
            $product = sanitize_title($product);
            $product = str_replace('-', '_', $product);
            return $product;
        }

        # init
        public function __construct($product = 'wp_dark_mode')
        {
            $product = $this->sanitize_product_name($product);
            $this->product = $product;
        }

        # set custom list
        public function set_product($product = [])
        {
            $this->product_data = $product;
        }

        # get product tags and lists
        public function get_product()
        {

            if ($this->product_data !== false) {
                return [
                    'name' => $this->product_data['name'] ?? '',
                    'list' => $this->product_data['list'] ?? '',
                    'tag' => $this->product_data['tag'] ?? '',
                ];
            }

            if (isset($this->products[$this->product])) {
                return $this->products[$this->product];
            }

            return false;
        }

        # sync contact
        public function sync_contact($data = [])
        {

            if (!$data || !is_array($data)) {
                return false;
            }

            $response = wp_remote_post($this->fluent_api_url, [
                'method' => 'POST',
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->fluent_api_key,
                ],
                'body' => $data,
            ]);

            if (is_wp_error($response)) {
                return false;
            }

            $response_body = json_decode(wp_remote_retrieve_body($response), true);

            return $response_body;
        }

        # subscribe to the list
        public function subscribe($data, $tag = 'free', $force = false)
        {
            $product = $this->get_product();

            if (!isset($data['tags'])) {
                $addTag = $tag === 'free' ? 'free' : 'pro';
                $data['tags'] = [$product['tag'][$addTag]];
            }

            if (!isset($data['lists'])) {
                $data['lists'] = [$product['list']];
            }


            if ($force === true) {
                $data['status'] = 'subscribed';

                if (!isset($data['remove_tags'])) {
                    $removeTag = $tag === 'free' ? 'pro' : 'free';
                    $data['remove_tags'] = [$product['tag'][$removeTag]];
                }
            }



            $response = $this->sync_contact($data);

            return $response;
        }

        # subscribe free to list
        public function subscribe_free($data)
        {
            return $this->subscribe($data, 'free');
        }

        # subscribe pro to list
        public function subscribe_pro($data)
        {
            return $this->subscribe($data, 'pro');
        }

        # force subscribe to list free
        public function force_subscribe_free($data)
        {
            return $this->subscribe($data, 'free', true);
        }

        # force subscribe to list pro
        public function force_subscribe_pro($data)
        {
            return $this->subscribe($data, 'pro', true);
        }

        # unsubscribe from database
        public function unsubscribe_system($data)
        {
            $data['status'] = 'unsubscribed';
            return $this->sync_contact($data);
        }

        # unsubscribe from list
        public function unsubscribe($data)
        {
            $product = $this->get_product();
            $data['remove_lists'] = is_array($product['list']) ? $product['list'] : [$product['list']];
            return $this->sync_contact($data);
        }

        # Get promotional offers
        public function offer()
        {
            # Get transient data if available
            $data = get_transient('wppool_offer_data');
            $product = $this->product;


            # get data from sheet 
            if (!$data) {

                $response = wp_remote_get($this->offer_sheet_url);

                if (!is_wp_error($response)) {

                    $response = wp_remote_retrieve_body($response);

                    if (!empty($response)) {

                        $csv = array_map('str_getcsv', explode("\n", $response));
                        $data = [];
                        for ($i = 1; $i < count($csv); $i++) {
                            if (!empty($csv[$i][0])) {
                                $data[$i] = array_combine($csv[0], $csv[$i]);
                            }
                        }

                        # updates every hour
                        set_transient('wppool_offer_data', $data, HOUR_IN_SECONDS);
                    }
                } else {
                    $data = false;
                }
            } 
            
            # return only the data for the current product
            if ($data && $product) {
                $data = array_filter($data, function ($item) use ($product) {
                    return $this->sanitize_product_name($item['plugin']) == $product;
                });

                if (!empty($data)) {
                    $data = array_values($data)[0];
                } else {
                    $data = false;
                }
            }

            return $data;
        }
    }

endif;
