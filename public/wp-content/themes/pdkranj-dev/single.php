<?php
/**
 * The Template for displaying all single posts
 *
 * @package pdkranj
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article>
	<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
		<?php the_date(); ?>
	</time>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
	
	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
		<h3><?php echo __('Avtor', 'pdkranj'); ?> <?php echo get_the_author() ; ?></h3>
		<?php the_author_meta( 'description' ); ?>
	<?php endif; ?>
</article>
		
<?php endwhile; ?>

<?php get_footer(); ?>