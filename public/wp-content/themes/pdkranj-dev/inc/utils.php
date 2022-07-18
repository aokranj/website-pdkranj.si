<?php

// dump variable
function dump($var) {
	echo '<pre>'.print_r($var).'</pre>';
}

// get post image id
function get_post_image_id($post) {
	$imageId = get_post_thumbnail_id($post->ID);
	if (empty($imageId)) {
		$images = get_posts([
			'fields' => 'ids',
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'posts_per_page' => 1,
		]);
		if ( !is_array( $images ) || empty( $images ) ) {
			return null;
		}
		$imageId = current($images);
	}
	return $imageId;
}

// get post image source array
function get_post_image_src($post, $size = 'large', $attr = '') {
	$imageId = get_post_image_id($post);
	return wp_get_attachment_image_src($imageId, $size, $attr);
}

// get post image html
function get_post_image($post, $size = 'large', $attr = '') {
	$imageId = get_post_image_id($post);
	return wp_get_attachment_image($imageId, $size, false, $attr);
}

// bootstrap comment
function bootstrap_comment( $comment, $args, $depth ) {
	if ( $comment->comment_approved == '1'): ?>
	<li class="row">
		<div class="col-4 col-md-2">
			<?php echo get_avatar( $comment ); ?>
		</div>
		<div class="col-8 col-md-10">
			<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
			<h4><?php comment_author_link() ?></h4>
			<?php comment_text() ?>
		</div>
	<?php endif;
}
