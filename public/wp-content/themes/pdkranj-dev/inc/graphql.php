<?php


add_action('graphql_register_types', function() {

	register_graphql_connection([
		'fromType' => 'ContentNode',
		'toType' => 'MediaItem',
		'fromFieldName' => 'attachedMedia',
		'connectionArgs' => \WPGraphQL\Connection\PostObjects::get_connection_args(),
		'resolve' => function( \WPGraphQL\Model\Post $source, $args, $context, $info ) {
			$resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver( $source, $args, $context, $info, 'attachment' );
			$resolver->set_query_arg( 'post_parent', $source->ID );
			return $resolver->get_connection();
		}
	]);
  
  // override featured image
  deregister_graphql_field('NodeWithFeaturedImage', 'featuredImage');
  register_graphql_connection([
    'fromType'      => 'NodeWithFeaturedImage',
    'toType'        => 'MediaItem',
    'fromFieldName' => 'featuredImage',
    'oneToOne'      => true,
    'resolve'       => function( \WPGraphQL\Model\Post $post, $args, $context, $info ) {
      $attachmentId = $post->featuredImageDatabaseId;
      
      if ( empty( $post->featuredImageDatabaseId ) ) {
        $attachments = get_posts([
          'fields' => 'ids',
          'post_parent' => $post->ID,
          'post_type' => 'attachment',
          'posts_per_page' => 1,
        ]);
        if ( !is_array( $attachments ) || empty( $attachments ) ) {
          return null;
        }
        $attachmentId = current($attachments);
      }
      
      $resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver( $post, $args, $context, $info, 'attachment' );
      $resolver->set_query_arg( 'p', absint( $attachmentId ) );
      return $resolver->one_to_one()->get_connection();
    },
  ]);

});