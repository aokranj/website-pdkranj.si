<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style type="text/css">
.wbg_personal_wrap {
    width: 72%; float: left;
}
.wbg_personal_wrap h3 {
    font-size: 24px;
}
.wbg_personal_wrap ul {
    list-style: number;
    margin-left: 30px;
}
.wbg_personal_wrap h4 {
    font-size: 16px;
}
.wbg_personal_wrap span {
    display: block;
}
</style>
<div class="wbg-wrap" style="padding-top:20px;">
    <div class="wbg_personal_wrap wbg_personal_help">
        <br>
        <h3>1. Add Your First Books to the Gallery</h3>
        <ul>
            <li>Go to WBG Books → Add New Book</li>
            <li>Fill in the book title, author, description, genre, ISBN, and publish date</li>
            <li>Upload or paste the book cover image URL</li>
            <li>Click Publish to save the book</li>
        </ul>
        <br>
        <img class="alignnone wp-image-1513 size-full" src="https://books-gallery.com/wp-content/uploads/2021/11/books-gallery-add-new-books-menu.jpg" alt="Books Gallery add new books menu" width="auto" height="435" />
        <br><br><br>
        <h3>2. Create and Publish Your Book Store Page</h3>
        <ul>
            <li>Go to Pages → Add New</li>
            <li>Give the page a title - e.g. "Book Store" or "Best Books" don't use "Books"</li>
            <li>In the page editor, add the Books Gallery shortcode: [<code>wp_books_gallery</code>]</li>
            <li>For a category-specific gallery, use: [<code>wp_books_gallery category="your-category"</code>]</li>
            <li>Click Publish</li>
        </ul>
        <br>
        <img class="alignnone wp-image-5191 size-full" src="https://books-gallery.com/wp-content/uploads/2026/05/books-gallery-add-page.webp" alt="Create and Publish Your Book Store Page" width="760" height="236" />
        <br>
        <h3>Book details page shows a 404 error </h3>
        <p>
            Go to WordPress Settings → Permalinks and click Save Changes. This refreshes your permalink structure and resolves the 404 error immediately.
        </p>
        <br>
        <h3>Pagination second page shows a 404 error</h3>
        <p>
            Don't use your gallery page name as "Books". It will create conflict.
            Give the page title - e.g. "Book Store" or "Library" or anything else.
        </p>
        <br>
        <h3>Shortcode Options</h3>
        <h4>Showing Books From a Category</h4>
        <code>[wp_books_gallery category="Category Name"]</code>
        &nbsp;
        <h4>Showing Books From Multiple Categories</h4>
        <code>[wp_books_gallery category="Category Name1, Category Name2, Category Name3"]</code>
        &nbsp;
        <h4>To Hide Search Bar (Pro)</h4>
        <code>[wp_books_gallery search=0]</code>
        &nbsp;
        <h4>Showing Books of a Author (Pro)</h4>
        <code>[wp_books_gallery author="Author Name"]</code>
        &nbsp;
        <h4>Showing Books of a Language (Pro)</h4>
        <code>[wp_books_gallery language="Language Name"]</code>
        &nbsp;
        <h4>Showing Books of a Format (Pro)</h4>
        <code>[wp_books_gallery format="Format Name"]</code>
        &nbsp;
        <h4>Showing Books of a Series (Pro)</h4>
        <code>[wp_books_gallery series="Series Name"]</code>
        &nbsp;
        <h4>Showing Books of a Tag (Pro)</h4>
        <code>[wp_books_gallery tag="Tag Name"]</code>
        &nbsp;
        <h4>Display Only Free Books</h4>
        <code>[wp_books_gallery price_type="free"]</code>
        &nbsp;
        <h4>Display Only Premium Books</h4>
        <code>[wp_books_gallery price_type="premium"]</code>
        &nbsp;
        <h4>To Hide Display Total (Pro)</h4>
        <code>[wp_books_gallery display-total=0]</code>
        &nbsp;
        <h4>Filter By Reading Age (Pro)</h4>
        <code>[wp_books_gallery reading_age="10 - 15 Years"]</code>
        &nbsp;
        <h4>Order Books (Pro)</h4>
        <code>[wp_books_gallery order_by="title" order="ASC/DESC"]</code>
        &nbsp;
        <h4>Other order by options</h4>
        <span>date = Order by Date</span>
        <span>wbg_author = Order by Author</span>
        <span>wbg_publisher = Order by Publisher</span>
        <span>wbg_published_on = Order by Published Date</span>
        <span>wbg_language = Order by Language</span>
        <span>wbg_country = Order by Country</span>
    </div>
    
    <?php include_once('sidebar.php'); ?>
    
</div>