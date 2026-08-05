<?php
# Silence is golden.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$structureData = [
    "@context"      => "https://schema.org/",
    "@type"         => "Book",
    "name"          => get_the_title(),
    "description"   => get_the_content(),
    "url"           => get_permalink(),
    "image"         => esc_url( $wbg_img ),
];
?>
<script type="application/ld+json">
<?php echo json_encode( $structureData, JSON_PRETTY_PRINT ); ?>
</script>