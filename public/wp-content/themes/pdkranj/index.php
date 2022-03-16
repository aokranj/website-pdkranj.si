<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * @package pdkranj
 */
?>
<?php get_header(); ?>

<?php if($_SERVER['REQUEST_URI'] == '/') require_once 'tpl/news.php'; ?>

<?php if ( have_posts() ): ?>

<div class="row">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-12 d-flex">
			<?php require 'tpl/post.php'; ?>
		</div>
	<?php endwhile; ?>
</div>

<?php echo bootstrap_pagination(); ?>

<?php endif; ?>

<?php get_footer(); ?>