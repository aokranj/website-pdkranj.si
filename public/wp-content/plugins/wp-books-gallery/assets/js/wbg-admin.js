(function($) {

    // USE STRICT
    "use strict";

    function initColorPicker(widget) {
        widget.find('.wbg-color-picker').not('[id*="__i__"]').wpColorPicker({
            change: _.throttle(function() {
                $(this).trigger('change');
            }, 3000)
        });
    }

    function onFormUpdate(event, widget) {
        initColorPicker(widget);
    }

    $(document).on('widget-added widget-updated', onFormUpdate);

    $(document).ready(function() {
        $('.widget-inside:has(.wbg-color-picker)').each(function() {
            initColorPicker($(this));
        });
    });

    var wbgColorPicker = [
        '#wbg_container_border_color',
        '#wbg_container_bg_color',
        '#wbg_btn_color',
        '#wbg_btn_font_color',
        '#wbg_btn_border_color',
        '#wbg_search_reset_bg_color',
        '#wbg_search_reset_border_color',
        '#wbg_search_reset_font_color',
        '#wbg_search_panel_bg_color',
        '#wbg_search_panel_border_color',
        '#wbg_search_panel_input_bg_color',
        '#wbg_download_btn_color',
        '#wbg_download_btn_font_color',
        '#wbg_download_btn_color_hvr',
        '#wbg_download_btn_font_color_hvr',
        '#wbg_title_color',
        '#wbg_title_hover_color',
        '#wbg_description_color',
        '#wbg_loop_book_border_color',
        '#wbg_loop_book_bg_color',
        '#wbg_search_btn_bg_color_hover',
        '#wbg_search_font_color_hover',
        '#wbg_single_title_font_color',
        '#wbg_single_subtitle_font_color',
        '#wbg_single_label_font_color',
        '#wbg_single_info_font_color',
        '#wbg_pagination_bg_color',
        '#wbg_pagination_font_color',
        '#wbg_pagination_hover_bg_color',
        '#wbg_pagination_hover_font_color',
        '#wbg_pagination_active_bg_color',
        '#wbg_pagination_active_font_color',
        '#wbg_single_modal_bg_color',
        '#wbg_single_modal_border_color',
        '#wbg_rprice_font_color',
        '#wbg_dprice_font_color',
        '#wbg_loop_format_font_color',
        '#wbg_loop_cat_font_color',
        '#wbg_loop_author_font_color',
        '#wbg_search_input_font_color',
        '#wbg_search_reset_bg_color_hvr',
        '#wbg_search_reset_font_color_hvr',
        '#wbg_search_reset_border_color_hvr',
        '#wbg_single_container_bg_color',
        '#wbg_single_anchor_hv_color',
        '#wbg_single_rprice_font_color',
        '#wbg_single_dprice_font_color',
        '#wbg_mss_alibris_color',
        '#wbg_mss_amazon_color',
        '#wbg_mss_amazon_kindle_color',
        '#wbg_mss_apple_books_color',
        '#wbg_mss_bookshop_org_color',
        '#wbg_mss_google_play_color',
        '#wbg_mss_kobo_color',
        '#wbg_mss_lifeway_color',
        '#wbg_mss_mardel_color',
        '#wbg_mss_smashwords_color',
        '#wbg_mss_sony_reader_color',
        '#wbg_mss_waterstones_color',
        '#wbg_mss_barnes_and_noble_color',
        '#wbg_back_btn_bg_color',
        '#wbg_back_btn_font_color',
        '#wbg_back_btn_bg_color_hvr',
        '#wbg_back_btn_font_color_hvr'
    ];

    $.each(wbgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $("#wbg_published_on").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('.wbg-search-settings-table').sortable({
        items: '.wbg_list_item',
        opacity: 0.6,
        cursor: 'move',
        axis: 'y',
        update: function() {
            var order = $(this).sortable('serialize') + '&action=search_item_order';
            $.post(ajaxurl, order, function() {
                //alert('test');
            });
        }
    });

    $('.icp').iconpicker();

    $('.wbg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

    // Download button operation
    var aw_uploader = '';
    $("#books_download_media_button_remove").hide();

    $('body').on('click', '#books_download_media_button_add', function(e) {
        //alert($('#wbg_download_link').val());
        e.preventDefault();
        aw_uploader = wp.media({
                title: 'Books Gallery Download File',
                button: {
                    text: 'Use this file'
                },
                multiple: false
            }).on('select', function() {
                var attachment = aw_uploader.state().get('selection').first().toJSON();
                $('#wbg_download_link').val(attachment.url);
                $("#books_download_media_button_add").hide();
                $("#books_download_media_button_remove").show();
            })
            .open();
    });

    $("#books_download_media_button_remove").click(function() {
        $('#wbg_download_link').val('');
        $(this).hide();
        $("#books_download_media_button_add").show();
    });

    // Buynow button operation
    //$("#wbg-wc-product-list").hide();

    $(document).ready(function() {
        $("#wbg-wc-product-type").change(function(event) {
            if ($(this).val() == 'int') {
                $('#buy-from-url-lbl').html('');
                $('#buy-from-url-lbl').html('Select Internal Product');
                $('#wbgp_buy_link_id').attr('type', 'hidden');
                $("#wbg-wc-product-list").show();
            }

            if ($(this).val() == 'ext') {
                $('#buy-from-url-lbl').html('');
                $('#buy-from-url-lbl').html('Buy From URL');
                $("#wbg-wc-product-list").hide();
                $('#wbgp_buy_link_id').attr('type', 'text');
            }
        });

        $("#wbg-wc-product-list").change(function(event) {
            $('#wbgp_buy_link_id').val('?add-to-cart=' + $(this).val());
        });
    });

})(jQuery);