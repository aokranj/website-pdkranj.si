<?php $slider = new WP_Query(['category_name' => 'fotogalerija', 'posts_per_page' => 10]); ?>
<div class="pd-home-slider">
  <div class="carousel slide" id="homeSlider" data-bs-ride="carousel">
    <?php /*
    <div class="carousel-indicators">
      <?php $i = 0; while (have_posts()) : the_post(); ?>
        <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="<?php echo $i; ?>" class="active" aria-current="true" aria-label="Slide 1"></button>
      <?php $i++; endwhile; ?>
      <?php rewind_posts(); ?>  
    </div>
    */ ?>
    <div class="carousel-inner">
      <?php $i = 0; while ($slider->have_posts()): $slider->the_post();?>
        <?php $image = get_post_image($post, 'large', ['class' => 'carousel-image']); ?>
        <?php if ($image): ?>
          <div class="carousel-item<?php echo $i === 0 ? ' active' : ''; ?>">
            <?php echo $image; ?>
            <div class="carousel-content d-flex align-items-center justify-content-center">
              <div class="carousel-div d-flex flex-column align-items-center justify-content-center">
                <h4><?php the_title(); ?></h4>
                <div class="carousel-excerpt">
                  <?php the_excerpt(); ?>
                </div>
                <a class="btn btn-secondary" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                  <?php echo __('Preberi več', 'pdkranj'); ?>
                </a>
              </div>
             </div>
            <?php /*
            <div class="carousel-caption">
              <h6><?php the_title(); ?></h6>
              <?php the_excerpt(); ?>
            </div>
            */ ?>
          </div>
        <?php $i++; endif; ?>
      <?php endwhile; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>