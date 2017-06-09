<li class="feed-item <?php esc_attr_e(HPN_Feed_Item::get_item_class()); ?> mb-2">
	<div class="feed-item__media">
		<a class="feed-item__media-link" href="<?php the_permalink(); ?>"><?php HPN_Feed_Item::get_feed_item_thumbnail(); ?></a>
	</div>
	<div class="feed-item__content">
		<span class="feed-item__date p"><?php the_time('M j, Y'); ?></span>
		<h3 class="feed-item__title <?php esc_attr_e(HPN_Feed_Item::get_item_title_class()); ?> mb-0-5">
			<a class="feed-item__title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="wysiwyg feed-item__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</li>