(function($) {

    // USE STRICT
    "use strict";

    var wbgColorPicker = ['#wbg_btn_color', '#wbg_btn_font_color', '#wbg_btn_border_color', '#wbg_download_btn_color', '#wbg_download_btn_font_color', '#wbg_title_color',
        '#wbg_title_hover_color', '#wbg_description_color', '#wbg_loop_book_border_color', '#wbg_loop_book_bg_color',
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

    $('.wbg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);