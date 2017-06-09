<?php $also_see = HPN_Theme::get_also_see_articles(); ?>

<?php if ($also_see->have_posts()) : ?>
	<h3 class="h3 mt-3 mb-2"><?php _e('Also See...',HPN_NAMESPACE); ?></h3>
	<ul class="feed">
		<?php while ( $also_see->have_posts() ) : $also_see->the_post(); ?>
			<?php get_template_part('parts/feed-item')?>
		<?php endwhile; ?>
	</ul>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>