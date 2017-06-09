<?php

	$description = HPN_Theme::get_archive_description();

	get_header();

?>

	<main class="layout-a">

		<section class="layout-a__featured mb-3">
			<?php echo HPN_Theme::get_back_link(); ?>

			<h1 class="h1">
				<?php echo HPN_Theme::get_archive_icon(); ?>
				<?php echo HPN_Theme::get_archive_title(); ?>
			</h1>

			<?php if($description) { ?><p class="lead mt-1"><em><?php echo $description; ?></em></p><?php } ?>
		</section>

		<section class="layout-a__content">

			<div class="layout-a__body">

				<?php if ( is_404() ) { ?>

					<div class="wysiwyg">
						<p><?php _e('We couldn&#8217;t find the page you&#8217;re looking for. Please try using the site search field or contact us for further assistance.'); ?></p>
					</div>

				<?php } else if ( have_posts() ) : ?>
				
					<ul class="feed" id="feedList"
						data-category-id="<?php echo HPN_Theme::get_archive_category_id(); ?>"
						data-posts-per-page="<?php echo get_option('posts_per_page'); ?>"
						data-post-count="<?php echo HPN_Theme::get_post_count(); ?>"
						data-search-terms="<?php esc_attr_e(get_search_query()); ?>">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part('parts/feed-item')?>
						<?php endwhile; ?>
					</ul>
				
				<?php else : ?>
				
					<div class="wysiwyg"><p><?php echo HPN_Theme::get_no_results_phrase(); ?></p></div>
				
				<?php endif; ?>

				<?php if ( is_archive() || is_category() || is_search() || is_home() ) { ?>
					<div class="text-center" id="loadMoreMessage">
						<a class="btn" href="#" id="loadMore"><?php _e('Load More', HPN_NAMESPACE); ?></a>
					</div>
				<?php } ?>

			</div>

			<aside class="layout-a__sidebar">
				<?php get_sidebar(); ?>
			</aside>

		</section>


	</main>

<?php get_footer(); ?>