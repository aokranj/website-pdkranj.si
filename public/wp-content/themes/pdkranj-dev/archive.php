<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pdkranj
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>

<?php if ( is_author() ): ?>
	<h1><?php echo get_the_author() ; ?></h1>
<?php elseif ( is_category() ): ?>
	<h1><?php echo __('Kategorija', 'pdkranj'); ?> <?php echo single_cat_title( '', false ); ?></h1>
<?php elseif ( is_tag() ) : ?>
	<h1><?php echo __('Tag', 'pdkranj'); ?> <?php echo single_tag_title( '', false ); ?></h1>
<?php elseif ( is_day() ) : ?>
	<h1><?php echo __('Arhiv', 'pdkranj'); ?> <?php echo get_the_date( 'D M Y' ); ?></h1>
<?php elseif ( is_month() ) : ?>
	<h1><?php echo __('Arhiv', 'pdkranj'); ?> <?php echo get_the_date( 'M Y' ); ?></h1>
<?php elseif ( is_year() ) : ?>
	<h1><?php echo __('Arhiv', 'pdkranj'); ?> <?php echo get_the_date( 'Y' ); ?></h1>
<?php else : ?>
	<h1><?php echo __('Arhiv', 'pdkranj'); ?></h1>
<?php endif; ?>

<div class="row">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-12 d-flex">
			<?php require 'tpl/post.php'; ?>
		</div>
	<?php endwhile; ?>
</div>

<?php else: ?>
	<h1><?php echo __('Ni objav', 'pdkranj'); ?></h1>
<?php endif; ?>

<?php get_footer(); ?>