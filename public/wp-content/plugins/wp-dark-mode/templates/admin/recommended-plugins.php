<style>
    a.hide-recommended-btn {
        background: #1da1f4;
        display: block;
        float: right;
        color: #fff;
        text-decoration: none;
        padding: 5px 20px;
        font-size: 18px;
        /* font-weight: bold; */
        border-radius: 4px;
    }
    .ui-dialog-titlebar {
        background: none !important;
    }
    .ui-dialog {
        z-index: 999999;
        text-align: center;
    }
    .ui-dialog-buttonpane {
        border: none;
        background: transparent;
        padding-top: 0;
    }
    .ui-dialog .ui-dialog-buttonset{
        float:none;
        text-align: center;
    }
    .ui-dialog .ui-dialog-buttonpane .ui-button {
        margin: 0 10px;
    }
    .ui-dialog-buttonpane .ui-dialog-buttonset .red-btn,
    .ui-dialog-buttonpane .ui-dialog-buttonset .purple-btn,
    .ui-dialog-buttonpane .ui-dialog-buttonset .gray-btn {
        background-color: #ffffff;
        color: #fff;
        border-color: #1da1f4;
        line-height: 1.4;
        padding: 5px 0;
        height: auto;
        display: inline-block;
        vertical-align: top;
        font-size: 16px;
        min-width: 150px;
        color: #1da1f4;
    }
    .ui-dialog-buttonpane .ui-dialog-buttonset .red-btn {
        background-color: #1da1f4;
        border-color: #1da1f4;
        color: #ffffff;
    }
</style>
<?php

wp_enqueue_style( 'wp-jquery-ui-dialog' );
wp_enqueue_script( 'jquery-ui-dialog' );

// You may comment this out IF you're sure the function exists.
require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
remove_all_filters('plugins_api');

$plugins_allowedtags = array(
    'a'       => array(
        'href'   => array(),
        'title'  => array(),
        'target' => array(),
    ),
    'abbr'    => array( 'title' => array() ),
    'acronym' => array( 'title' => array() ),
    'code'    => array(),
    'pre'     => array(),
    'em'      => array(),
    'strong'  => array(),
    'ul'      => array(),
    'ol'      => array(),
    'li'      => array(),
    'p'       => array(),
    'br'      => array(),
);

$recommended_plugins = array();

/* dark-mode Plugin */
$args = [
    'slug' => 'dark-mode',
    'fields' => [
        'short_description' => true,
        'icons' => true,
        'reviews'  => false, // excludes all reviews
    ],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
    $recommended_plugins['dark-mode'] = $data;
    $recommended_plugins['dark-mode']->name = __('WP Markdown Editor (Formerly Dark Mode)', 'wp-dark-mode');
    $recommended_plugins['dark-mode']->short_description = __('Quickly edit content in WordPress by getting an immersive, peaceful and natural writing experience with the coolest editor.', 'wp-dark-mode');
}



/* jitsi meet Plugin */
$args = [
	'slug' => 'sheets-to-wp-table-live-sync',
	'fields' => [
		'short_description' => true,
		'icons' => true,
		'reviews'  => false, // excludes all reviews
	],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
	$recommended_plugins['sheets-to-wp-table-live-sync'] = $data;
	$recommended_plugins['sheets-to-wp-table-live-sync']->name = __('Sheets To WP Table Live Sync', 'wp-dark-mode');
	$recommended_plugins['sheets-to-wp-table-live-sync']->short_description = __('Google Sheets allows you to input data on your Google sheet and show the same data on WordPress as a table effortlessly.', 'wp-dark-mode');
}

/* jitsi meet Plugin */
$args = [
	'slug' => 'webinar-and-video-conference-with-jitsi-meet',
	'fields' => [
		'short_description' => true,
		'icons' => true,
		'reviews'  => false, // excludes all reviews
	],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
	$recommended_plugins['webinar-and-video-conference-with-jitsi-meet'] = $data;
	$recommended_plugins['webinar-and-video-conference-with-jitsi-meet']->name = __('Webinar and Video Conference with Jitsi Meet', 'wp-dark-mode');
	$recommended_plugins['webinar-and-video-conference-with-jitsi-meet']->short_description = __('Webinar and Video Conference with Jitsi Meet.', 'wp-dark-mode');
}


/* Flexiaddons Plugin */
$args = [
    'slug' => 'flexiaddons',
    'fields' => [
        'short_description' => true,
        'icons' => true,
        'reviews'  => false, // excludes all reviews
    ],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
    $recommended_plugins['flexiaddons'] = $data;
    $recommended_plugins['flexiaddons']->name = __('Flexi Addons for Elementor', 'wp-dark-mode');
    $recommended_plugins['flexiaddons']->short_description = __('A collection of premium quality & highly customizable addons or modules for use in Elementor page builder.', 'wp-dark-mode');
}

/* zero-bs-accounting */
$args = [
    'slug' => 'zero-bs-accounting',
    'fields' => [
        'short_description' => true,
        'icons' => true,
        'reviews'  => false, // excludes all reviews
    ],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
    $recommended_plugins['zero-bs-accounting'] = $data;
    $recommended_plugins['zero-bs-accounting']->name = __('Zero BS Accounting', 'wp-dark-mode');
    $recommended_plugins['zero-bs-accounting']->short_description = __('Get the painless, trouble-free, and swift calculation plugin. For non-accountants, it is the most flexible accounting plugin.', 'wp-dark-mode');
}

/* call-to-action-block-wppool Plugin */
$args = [
    'slug' => 'call-to-action-block-wppool',
    'fields' => [
        'short_description' => true,
        'icons' => true,
        'reviews'  => false, // excludes all reviews
    ],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
    $recommended_plugins['call-to-action-block-wppool'] = $data;
    $recommended_plugins['call-to-action-block-wppool']->name = __('Call to Action Block – WPPOOL', 'wp-dark-mode');
    $recommended_plugins['call-to-action-block-wppool']->short_description = __('Call to Action Gutenberg Block.', 'wp-dark-mode');
}

/* flash-social-share Plugin */
$args = [
    'slug' => 'flash-social-share',
    'fields' => [
        'short_description' => true,
        'icons' => true,
        'reviews'  => false, // excludes all reviews
    ],
];
$data = plugins_api( 'plugin_information', $args );
if ( $data && ! is_wp_error( $data ) ) {
    $recommended_plugins['flash-social-share'] = $data;
    $recommended_plugins['flash-social-share']->name = __('Flash Social Share', 'wp-dark-mode');
    $recommended_plugins['flash-social-share']->short_description = __('Make way for the fastest social sharing plugin alive! The FLASH Social Share! 🔥', 'wp-dark-mode');
}


?>

<div class="wrap mystickyelement-wrap recommended-plugins">
    <h2>
        <?php esc_html_e('Try out our recommended plugins', 'wp-dark-mode'); ?>
        <a class="hide-recommended-btn" href="#"><?php esc_html_e('Hide From Menu', 'wp-dark-mode'); ?></a>
    </h2>
</div>

<div class="wrap recommended-plugins">
    <div class="wp-list-table widefat plugin-install">
        <div class="the-list">
            <?php
            foreach ( (array) $recommended_plugins as $plugin ) {
                if ( is_object( $plugin ) ) {
                    $plugin = (array) $plugin;
                }

                // Display the group heading if there is one.
                if ( isset( $plugin['group'] ) && $plugin['group'] != $group ) {
                    if ( isset( $this->groups[ $plugin['group'] ] ) ) {
                        $group_name = $this->groups[ $plugin['group'] ];
                        if ( isset( $plugins_group_titles[ $group_name ] ) ) {
                            $group_name = $plugins_group_titles[ $group_name ];
                        }
                    } else {
                        $group_name = $plugin['group'];
                    }

                    // Starting a new group, close off the divs of the last one.
                    if ( ! empty( $group ) ) {
                        echo '</div></div>';
                    }

                    echo '<div class="plugin-group"><h3>' . esc_html( $group_name ) . '</h3>';
                    // Needs an extra wrapping div for nth-child selectors to work.
                    echo '<div class="plugin-items">';

                    $group = $plugin['group'];
                }
                $title = wp_kses( $plugin['name'], $plugins_allowedtags );

                // Remove any HTML from the description.
                $description = strip_tags( $plugin['short_description'] );
                $version     = wp_kses( $plugin['version'], $plugins_allowedtags );

                $name = strip_tags( $title . ' ' . $version );

                $author = wp_kses( $plugin['author'], $plugins_allowedtags );
                if ( ! empty( $author ) ) {
                    /* translators: %s: Plugin author. */
                    $author = ' <cite>' . sprintf( __( 'By %s', 'wp-dark-mode' ), $author ) . '</cite>';
                }

                $requires_php = isset( $plugin['requires_php'] ) ? $plugin['requires_php'] : null;
                $requires_wp  = isset( $plugin['requires'] ) ? $plugin['requires'] : null;

                $compatible_php = is_php_version_compatible( $requires_php );
                $compatible_wp  = is_wp_version_compatible( $requires_wp );
                $tested_wp      = ( empty( $plugin['tested'] ) || version_compare( get_bloginfo( 'version' ), $plugin['tested'], '<=' ) );

                $action_links = array();

                if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
                    $status = install_plugin_install_status( $plugin );

                    switch ( $status['status'] ) {
                        case 'install':
                            if ( $status['url'] ) {
                                if ( $compatible_php && $compatible_wp ) {
                                    $action_links[] = sprintf(
                                        '<a class="install-now button" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
                                        esc_attr( $plugin['slug'] ),
                                        esc_url( $status['url'] ),
                                        /* translators: %s: Plugin name and version. */
                                        esc_attr( sprintf( _x( 'Install %s now', 'plugin', 'wp-dark-mode' ), $name ) ),
                                        esc_attr( $name ),
                                        __( 'Install Now', 'wp-dark-mode' )
                                    );
                                } else {
                                    $action_links[] = sprintf(
                                        '<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
                                        _x( 'Cannot Install', 'plugin', 'wp-dark-mode' )
                                    );
                                }
                            }
                            break;

                        case 'update_available':
                            if ( $status['url'] ) {
                                if ( $compatible_php && $compatible_wp ) {
                                    $action_links[] = sprintf(
                                        '<a class="update-now button aria-button-if-js" data-plugin="%s" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
                                        esc_attr( $status['file'] ),
                                        esc_attr( $plugin['slug'] ),
                                        esc_url( $status['url'] ),
                                        /* translators: %s: Plugin name and version. */
                                        esc_attr( sprintf( _x( 'Update %s now', 'plugin', 'wp-dark-mode' ), $name ) ),
                                        esc_attr( $name ),
                                        __( 'Update Now', 'wp-dark-mode' )
                                    );
                                } else {
                                    $action_links[] = sprintf(
                                        '<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
                                        _x( 'Cannot Update', 'plugin', 'wp-dark-mode' )
                                    );
                                }
                            }
                            break;

                        case 'latest_installed':
                        case 'newer_installed':
                            if ( is_plugin_active( $status['file'] ) ) {
                                $action_links[] = sprintf(
                                    '<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
                                    _x( 'Active', 'plugin', 'wp-dark-mode' )
                                );
                            } elseif ( current_user_can( 'activate_plugin', $status['file'] ) ) {
                                $button_text = __( 'Activate', 'wp-dark-mode' );
                                /* translators: %s: Plugin name. */
                                $button_label = _x( 'Activate %s', 'plugin', 'wp-dark-mode' );
                                $activate_url = add_query_arg(
                                    array(
                                        '_wpnonce' => wp_create_nonce( 'activate-plugin_' . $status['file'] ),
                                        'action'   => 'activate',
                                        'plugin'   => $status['file'],
                                    ),
                                    network_admin_url( 'plugins.php' )
                                );

                                if ( is_network_admin() ) {
                                    $button_text = __( 'Network Activate', 'wp-dark-mode' );
                                    /* translators: %s: Plugin name. */
                                    $button_label = _x( 'Network Activate %s', 'plugin', 'wp-dark-mode' );
                                    $activate_url = add_query_arg( array( 'networkwide' => 1 ), $activate_url );
                                }

                                $action_links[] = sprintf(
                                    '<a href="%1$s" class="button activate-now" aria-label="%2$s">%3$s</a>',
                                    esc_url( $activate_url ),
                                    esc_attr( sprintf( $button_label, $plugin['name'] ) ),
                                    $button_text
                                );
                            } else {
                                $action_links[] = sprintf(
                                    '<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
                                    _x( 'Installed', 'plugin', 'wp-dark-mode' )
                                );
                            }
                            break;
                    }
                }

                $details_link = self_admin_url(
                    'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
                    '&amp;TB_iframe=true&amp;width=600&amp;height=550'
                );

                $action_links[] = sprintf(
                    '<a href="%s" class="thickbox open-plugin-details-modal" aria-label="%s" data-title="%s">%s</a>',
                    esc_url( $details_link ),
                    /* translators: %s: Plugin name and version. */
                    esc_attr( sprintf( __( 'More information about %s', 'wp-dark-mode' ), $name ) ),
                    esc_attr( $name ),
                    __( 'More Details', 'wp-dark-mode' )
                );

                if ( ! empty( $plugin['icons']['svg'] ) ) {
                    $plugin_icon_url = $plugin['icons']['svg'];
                } elseif ( ! empty( $plugin['icons']['2x'] ) ) {
                    $plugin_icon_url = $plugin['icons']['2x'];
                } elseif ( ! empty( $plugin['icons']['1x'] ) ) {
                    $plugin_icon_url = $plugin['icons']['1x'];
                } else {
                    $plugin_icon_url = $plugin['icons']['default'];
                }

                /**
                 * Filters the install action links for a plugin.
                 *
                 * @since 2.7.0
                 *
                 * @param string[] $action_links An array of plugin action links. Defaults are links to Details and Install Now.
                 * @param array    $plugin       The plugin currently being listed.
                 */
                $action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );

                $last_updated_timestamp = strtotime( $plugin['last_updated'] );
                ?>
                <div class="plugin-card plugin-card-<?php echo sanitize_html_class( $plugin['slug'] ); ?>">
                    <?php
                    if ( ! $compatible_php || ! $compatible_wp ) {
                        echo '<div class="notice inline notice-error notice-alt"><p>';
                        if ( ! $compatible_php && ! $compatible_wp ) {
                            _e( 'This plugin doesn&#8217;t work with your versions of WordPress and PHP.' , 'wp-dark-mode');
                            if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
                                printf(
                                /* translators: 1: URL to WordPress Updates screen, 2: URL to Update PHP page. */
                                    ' ' . __( '<a href="%1$s">Please update WordPress</a>, and then <a href="%2$s">learn more about updating PHP</a>.', 'wp-dark-mode' ),
                                    self_admin_url( 'update-core.php' ),
                                    esc_url( wp_get_update_php_url() )
                                );
                                wp_update_php_annotation( '</p><p><em>', '</em>' );
                            } elseif ( current_user_can( 'update_core' ) ) {
                                printf(
                                /* translators: %s: URL to WordPress Updates screen. */
                                    ' ' . __( '<a href="%s">Please update WordPress</a>.', 'wp-dark-mode' ),
                                    self_admin_url( 'update-core.php' )
                                );
                            } elseif ( current_user_can( 'update_php' ) ) {
                                printf(
                                /* translators: %s: URL to Update PHP page. */
                                    ' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'wp-dark-mode' ),
                                    esc_url( wp_get_update_php_url() )
                                );
                                wp_update_php_annotation( '</p><p><em>', '</em>' );
                            }
                        } elseif ( ! $compatible_wp ) {
                            _e( 'This plugin doesn&#8217;t work with your version of WordPress.', 'wp-dark-mode' );
                            if ( current_user_can( 'update_core' ) ) {
                                printf(
                                /* translators: %s: URL to WordPress Updates screen. */
                                    ' ' . __( '<a href="%s">Please update WordPress</a>.', 'wp-dark-mode' ),
                                    self_admin_url( 'update-core.php' )
                                );
                            }
                        } elseif ( ! $compatible_php ) {
                            _e( 'This plugin doesn&#8217;t work with your version of PHP.', 'wp-dark-mode' );
                            if ( current_user_can( 'update_php' ) ) {
                                printf(
                                /* translators: %s: URL to Update PHP page. */
                                    ' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'wp-dark-mode' ),
                                    esc_url( wp_get_update_php_url() )
                                );
                                wp_update_php_annotation( '</p><p><em>', '</em>' );
                            }
                        }
                        echo '</p></div>';
                    }
                    ?>
                    <div class="plugin-card-top">
                        <div class="name column-name">
                            <h3>
                                <a href="<?php echo esc_url( $details_link ); ?>" class="thickbox open-plugin-details-modal">
                                    <?php echo $title; ?>
                                    <img src="<?php echo esc_attr( $plugin_icon_url ); ?>" class="plugin-icon" alt="" />
                                </a>
                            </h3>
                        </div>
                        <div class="action-links">
                            <?php
                            if ( $action_links ) {
                                echo '<ul class="plugin-action-buttons"><li>' . implode( '</li><li>', $action_links ) . '</li></ul>';
                            }
                            ?>
                        </div>
                        <div class="desc column-description">
                            <p><?php echo $description; ?></p>
                            <p class="authors"><?php echo $author; ?></p>
                        </div>
                    </div>
                    <div class="plugin-card-bottom">
                        <div class="vers column-rating">
                            <?php
                            wp_star_rating(
                                array(
                                    'rating' => $plugin['rating'],
                                    'type'   => 'percent',
                                    'number' => $plugin['num_ratings'],
                                )
                            );
                            ?>
                            <span class="num-ratings" aria-hidden="true">(<?php echo number_format_i18n( $plugin['num_ratings'] ); ?>)</span>
                        </div>
                        <div class="column-updated">
                            <strong><?php _e( 'Last Updated:', 'wp-dark-mode' ); ?></strong>
                            <?php
                            /* translators: %s: Human-readable time difference. */
                            printf( __( '%s ago' , 'wp-dark-mode'), human_time_diff( $last_updated_timestamp ) );
                            ?>
                        </div>
                        <div class="column-downloaded">
                            <?php
                            if ( $plugin['active_installs'] >= 1000000 ) {
                                $active_installs_millions = floor( $plugin['active_installs'] / 1000000 );
                                $active_installs_text     = sprintf(
                                /* translators: %s: Number of millions. */
                                    _nx( '%s+ Million', '%s+ Million', $active_installs_millions, 'Active plugin installations', 'wp-dark-mode' ),
                                    number_format_i18n( $active_installs_millions )
                                );
                            } elseif ( 0 == $plugin['active_installs'] ) {
                                $active_installs_text = _x( 'Less Than 10', 'Active plugin installations', 'wp-dark-mode' );
                            } else {
                                $active_installs_text = number_format_i18n( $plugin['active_installs'] ) . '+';
                            }
                            /* translators: %s: Number of installations. */
                            printf( __( '%s Active Installations', 'wp-dark-mode' ), $active_installs_text );
                            ?>
                        </div>
                        <div class="column-compatibility">
                            <?php
                            if ( ! $tested_wp ) {
                                echo '<span class="compatibility-untested">' . __( 'Untested with your version of WordPress', 'wp-dark-mode' ) . '</span>';
                            } elseif ( ! $compatible_wp ) {
                                echo '<span class="compatibility-incompatible">' . __( '<strong>Incompatible</strong> with your version of WordPress', 'wp-dark-mode' ) . '</span>';
                            } else {
                                echo '<span class="compatibility-compatible">' . __( '<strong>Compatible</strong> with your version of WordPress' , 'wp-dark-mode') . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <div id="hide-recommeded-plugins" style="display:none;" title="<?php _e('Are you sure?','wp-dark-mode');?>">
        <p><?php _e( "If you hide the recommended plugins page from your menu, it won't appear there again. Are you sure you'd like to do it?", 'wp-dark-mode');?></p>
    </div>
</div>

<script>
    ( function( $ ) {
        "use strict";
        $(document).ready(function(){

            $('a.hide-recommended-btn').on('click',function(event){
                event.preventDefault();
                $( "#hide-recommeded-plugins" ).dialog({
                    resizable: false,
                    modal: true,
                    draggable: false,
                    height: 'auto',
                    width: 400,
                    open: function (event, ui) {
                        $(".ui-widget-overlay").click(function () {
                            $('#hide-recommeded-plugins').dialog('close');
                        });
                    },
                    buttons: {
                        "Hide it": {
                            click: function () {
                                window.location = "<?php echo admin_url('admin.php?page=wp-dark-mode&hide_wp_dark_mode_recommended_plugin=1&nonce='.wp_create_nonce("wp_dark_mode_recommended_plugin"));?>";
                            },
                            text: 'Hide it',
                            class: 'btn red-btn'
                        },
                        "Keep it": {
                            click: function () {
                                $(this).dialog('close');
                            },
                            text: 'Keep it',
                            class: 'btn alt gray-btn'
                        },
                    }
                });
            });
        });
    })( jQuery );
</script>
