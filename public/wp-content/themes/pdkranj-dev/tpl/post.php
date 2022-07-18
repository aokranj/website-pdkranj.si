<article class="card flex-grow-1">
  <a href="<?php esc_url( the_permalink() ); ?>">
    <?php echo get_post_image($post, 'large', ['class' => 'card-img-top']); ?>
  </a>
  <div class="card-body">
    <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
      <?php the_date(); ?>
    </time>
    <h3 class="card-title">
      <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_title(); ?>
      </a>
    </h3>
    <div class="card-text">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>