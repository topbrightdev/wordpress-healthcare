<?php

	$categories = HPN_Theme::get_all_categories();
	$sticky_posts = HPN_Theme::get_stickied_posts();
	get_header();

?>

	<main class="layout-a">

		<?php if ($sticky_posts) : ?>
			<section class="layout-a__featured mb-2 featured">
				<ul class="feed">
					<?php while ( $sticky_posts->have_posts() ) : $sticky_posts->the_post(); ?>
						<?php get_template_part('parts/feed-item')?>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			</section>
		<?php endif; ?>

		<section class="layout-a__content">

			<div class="layout-a__body">

				<?php foreach ($categories as $category) : ?>

					<div class="catbar mb-2">
						<h2 class="catbar__head h4"><?php echo $category->name; ?></h2>
						<a class="catbar__more h4" href="<?php esc_attr_e(get_category_link($category->term_id)); ?>">More &#187;</a>
					</div>
					
					<?php $posts = HPN_Theme::get_posts_in_category($category->term_id); ?>

					<?php if ($posts->have_posts()) : ?>
						<ul class="feed">
							<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
								<?php get_template_part('parts/feed-item')?>
							<?php endwhile; ?>
						</ul>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

				<?php endforeach; ?>
				
			</div>

			<div class="layout-a__sidebar">
				<?php get_sidebar(); ?>
			</div>

		</section>

	</main>

<?php get_footer(); ?>