<?php

	$feedback_url = HPN_Theme::get_feedback_url();
	$filters 		  = HPN_Theme::get_sidebar_menu('filter_menu');
	$categories   = HPN_Theme::get_sidebar_menu('category_menu');
	$caption 		  = get_the_post_thumbnail_caption();
	
?>

<?php if ( is_singular('post') && has_post_thumbnail() ) : ?>
	<div class="sidebar-thumb">
		<?php the_post_thumbnail('medium')?>
		<?php if ($caption) { ?><div class="sidebar-thumb__caption"><?php esc_html_e($caption); ?></div><?php } ?>
	</div>
<?php endif; ?>

<div class="catmenu-mobile-background" id="mobileNav">

	<nav class="catmenu-mobile-wrap">

		<div class="catmenu-mobile-mobile-top">
			<button class="btn btn--sm btn--icon-right btn--lt" id="mainMenuCloseButton">
				<?php _e('Close',HPN_NAMESPACE); ?>
				<svg class="btn__icon">
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-close" />
				</svg>
			</button>
		</div>

		<?php if (!$filters && !$categories) { ?>
			<div class="wysiwyg">
				<p><?php _e('Menus not yet configured.',HPN_NAMESPACE); ?></p>
			</div>
		<?php } ?>

		<?php if ($filters) : ?>
			<h4 class="h4 mb-0-5"><?php echo HPN_Theme::get_sidebar_menu_title('filter_menu'); ?></h4>
			<ul class="catmenu">
				<?php foreach ( $filters as $item ) : ?>
					<li class="catmenu__item">
						<a class="catmenu__link" href="<?php esc_attr_e($item['url']); ?>">
							<svg class="catmenu__icon">
								<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#<?php esc_attr_e($item['icon']); ?>" />
							</svg>
							<span class="catmenu__label"><?php esc_html_e($item['title']); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ($categories) : ?>
			<h4 class="h4 mb-0-5"><?php echo HPN_Theme::get_sidebar_menu_title('category_menu'); ?></h4>
			<ul class="catmenu">
				<?php foreach ( $categories as $item ) : ?>
					<li class="catmenu__item">
						<a class="catmenu__link" href="<?php esc_attr_e($item['url']); ?>">
							<svg class="catmenu__icon">
								<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#<?php esc_attr_e($item['icon']); ?>" />
							</svg>
							<span class="catmenu__label"><?php esc_html_e($item['title']); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	
		<ul class="catmenu-base">
			<?php if ($feedback_url) { ?>
				<li><a href="/#feedback">
					<svg class="">
						<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-megaphone" />
					</svg>
					<span><?php _e('Feedback',HPN_NAMESPACE); ?></span></a>
				</li>
			<?php } ?>
			<li><a href="<?php echo wp_logout_url(); ?>">
				<svg class="">
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-logout" />
				</svg>
				<span><?php _e('Log Out',HPN_NAMESPACE); ?></span></a></li>
		</ul>
		
	</nav>

</div>