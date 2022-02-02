<?php
$data_transient_key = 'wp_dark_mode_promo_data';
$data               = get_transient( $data_transient_key );

if ( ! empty( $data['offer_text'] ) ) {
	echo $data['offer_text'];
}


?>


<script>
    (function ($) {
        $(document).on('click', '.offer_notice .notice-dismiss', function () {
            wp.ajax.send('hide_offer_notice', {
                success: function (res) {
                    console.log(res);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        })
    })(jQuery)
</script>