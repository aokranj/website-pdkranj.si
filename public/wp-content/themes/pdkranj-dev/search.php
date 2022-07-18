<?php
/**
 * Search results page
 *
 * @package pdkranj
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>

<h1><?php echo __('Rezultati iskanja za', 'pdkranj'); ?> '<?php echo get_search_query(); ?>'</h1>

<div class="row">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-12 d-flex">
			<?php require 'tpl/post.php'; ?>
		</div>
	<?php endwhile; ?>
</div>

<?php else: ?>
	<h1><?php echo __('Ni rezultatov iskanja za', 'pdkranj'); ?> '<?php echo get_search_query(); ?>'</h1>
<?php endif; ?>

<?php get_footer(); ?>