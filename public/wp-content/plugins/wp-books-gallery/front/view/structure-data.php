<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wbgAuthor  = get_post_meta( $post->ID, 'wbg_author', true );
$wbgImgUrl  = get_post_meta( $post->ID, 'wbgp_img_url', true );
$wbgIsbn    = get_post_meta( $post->ID, 'wbg_isbn', true );

if ( has_post_thumbnail( $post->ID ) ) {
    $wbg_img = get_the_post_thumbnail_url($post->ID,'full');
} else {
    if ( $wbgImgUrl ) {
        $wbg_img = $wbgImgUrl;
    }
}

$wbgReviews = get_posts( array(
    'post_type'   => 'wpcr3_review',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'meta_query'  => array(
        array(
            'key'     => 'wpcr3_review_post',
            'value'   => $post->ID,
            'compare' => '='
        ),
    ),
));

if ( ! empty( $wbgReviews ) ) {
    $star_sum = 0;
    $star_count = 0;
    foreach( $wbgReviews as $p ) {
        $star_sum = $star_sum + get_post_meta( $p, "wpcr3_review_rating", true);
        $star_count++;
    }

    if ( $star_sum > 0 ) {
        $hmt_star = number_format( ( $star_sum / $star_count ), 1);
    }
}
?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Book",
    "name": "<?php echo get_the_title(); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php echo ( ! empty( $wbgAuthor ) ) ? $wbgAuthor : ''; ?>"
    },
    "image": "<?php esc_html_e( $wbg_img ); ?>"
    <?php
    if ( ! empty( $wbgReviews ) ) {
        ?>,
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "<?php esc_html_e( $hmt_star ); ?>",
            "reviewCount": "<?php esc_html_e( $star_count ); ?>"
        }
        <?php
    }
    if ( ! empty( $wbgIsbn ) ) {
        ?>,
        "isbn": "<?php esc_html_e( $wbgIsbn ); ?>"
        <?php
    }
    ?>
}
</script>