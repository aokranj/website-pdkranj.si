<?php
/**
 * "Wrapped Image" Layout Template File
 * 
 * DO NOT MODIFY THIS FILE!
 * 
 * To override, copy the /fpw2_views/ folder to your active theme's folder.
 * Modify the file in the theme's folder and the plugin will use it.
 * See: http://wordpress.org/extend/plugins/feature-a-page-widget/faq/
 * 
 * Note: Feature a Page Widget provides a variety of filters and options that may alter the output of the_title, the_excerpt, and the_post_thumbnail in this template.
 */
?>

<article class="fpw-clearfix fpw-layout-wrapped">

	<a href="<?php the_permalink(); ?>" class="fpw-featured-link">
		<h3 class="fpw-page-title"><?php the_title(); ?></h3>
		<div class="fpw-featured-image">
			<?php the_post_thumbnail( 'fpw_square' ); ?>
		</div>
	</a>	

	<div class="fpw-excerpt">
		<?php the_excerpt(); ?>
	</div>

</article>