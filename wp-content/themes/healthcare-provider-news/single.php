<?php

	$category = HPN_Theme::get_the_first_category();

	get_header();
	the_post();

?>

	<article class="layout-a">

		<div class="layout-a__featured mb-2">

			<div class="p mb-1 title-meta"> <?php // @see theme/assets/src/sass/layouts/_layout-a.scss ?>
				<span class="title-meta__date"><?php the_time('M j, Y'); ?></span>
				<a class="title-meta__category" href="<?php echo get_category_link($category->term_id); ?>">
					<?php echo HPN_Theme::get_archive_icon($category->term_id); ?>
					<?php echo $category->name; ?>
				</a>
			</div>

			<h1 class="h1 h1--single"><?php the_title(); ?></h1>

			<?php if ( get_field('post_byline') ) { ?>
				<div class="meta-byline wysiwyg"><p><?php the_field('post_byline'); ?></p></div>
			<?php } ?>
			
		</div>

		<div class="layout-a__content">

			<div class="layout-a__body">
				
				<div class="wysiwyg">

					<?php if ( have_rows('takeaway_bullets') ) : ?>
						<aside class="well">
							<h4><?php _e('Key Takeaways...', HPN_NAMESPACE); ?></h4>
							<ul>
								<?php while( have_rows('takeaway_bullets') ) : the_row(); ?>
									<li><?php the_sub_field('takeaway'); ?></li>
								<?php endwhile; ?>
							</ul>
						</aside>
					<?php endif; ?>

					<?php the_content(); ?>
					
				</div>

				<?php get_template_part('parts/article-contact'); ?>
				
				<?php get_template_part('parts/also-see'); ?>

			</div>

			<nav class="layout-a__sidebar">
				<?php get_sidebar(); ?>
			</nav>

		</div>

	</article>

<?php get_footer(); ?>