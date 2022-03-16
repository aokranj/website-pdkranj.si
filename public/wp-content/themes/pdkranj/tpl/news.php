<div class="pd-home-news row">
	<?php
	$news = new WP_Query(['category_name' => 'novice','posts_per_page' => 5]);
	$news_category = get_category_by_slug('novice');
	$news_category_link = get_category_link($news_category->cat_ID);
	?>
	<div class="col-12 col-md-6 d-flex">
		<div class="card flex-grow-1">
			<div class="card-body d-flex flex-column align-items-start">
				<h3 class="card-title"><?php echo __('Novice', 'pdkranj'); ?></h3>
				<div class="card-text flex-grow-1">
					<ul class="list-unstyled flex-grow-1">
						<?php while ($news->have_posts()): $news->the_post();?>
							<li>
								<time datetime="<?php the_time('Y-m-d'); ?>" pubdate>
									<?php the_time('d.m.Y') ?>
								</time>
								<h6>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h6>
							</li>
						<?php endwhile; ?>
					</ul>	
				</div>
				<a href="<?php echo esc_url($news_category_link); ?>" class="btn btn-lg btn-secondary btn-outline btn-sharp">
					<?php echo __('Več novic', 'pdkranj'); ?>
				</a>
			</div>
		</div>
	</div>

	<?php
	$izleti = new WP_Query(['category_name' => 'izleti', 'posts_per_page' => 5]);
	$izleti_category = get_category_by_slug('izleti');
	$izleti_category_link = get_category_link($izleti_category->cat_ID);
	?>
	<div class="col-12 col-md-6 d-flex">
		<div class="card flex-grow-1">
			<div class="card-body d-flex flex-column align-items-start">
				<h3 class="card-title"><?php echo __('Izleti', 'pdkranj'); ?></h3>
				<div class="card-text flex-grow-1">
					<ul class="list-unstyled flex-grow-1">
						<?php while ($izleti->have_posts()): $izleti->the_post(); ?>
							<li>
								<time datetime="<?php the_time('Y-m-d'); ?>" pubdate>
									<?php the_time('d.m.Y') ?>
								</time>
								<h6>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h6>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				<a href="<?php echo esc_url($izleti_category_link); ?>" class="btn btn-lg btn-secondary btn-outline btn-sharp">
					<?php echo __('Več izletov', 'pdkranj'); ?>
				</a>
			</div>
		</div>
	</div>
</div>
