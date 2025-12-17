<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
h3.wbg-book-category {
    margin: 0;
    padding: 0;
    font-size: 20px;
    color: #222;
    font-weight: 600;
    border-top: 1px solid #DDD;
    padding-top: 20px;
}
.wbg-parent-wrapper {
    margin: 30px 0!important;
    border: 1px solid #000;
}
.wbg-description-content,
.loop-category,
.wbg-rating,
.loop-edition {
    display: none !important;
}
</style>
<?php
$booksCategories = get_terms( array( 'taxonomy' => 'book_category', 'hide_empty' => true ) );
                        
foreach( $booksCategories as $bc ) {
    ?>
    <h3 class="wbg-book-category"><?php esc_html_e( $bc->name ); ?> ::</h3>
    <?php
    echo do_shortcode('[wp_books_gallery category="' . $bc->name . '" search=0 display-total=0 no-book-message="Hide" isdisplay=100 layout="grid"]');

}
?>