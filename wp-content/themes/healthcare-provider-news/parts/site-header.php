<?php $feedback_url = HPN_Theme::get_feedback_url(); ?>

<header class="header search-visible">

	<div class="header__search" id="search-form">
		<form class="search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>

			<input class="search-form__text-input" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search..." />
			
			<label class="search-form__submit-label">
				<svg class="search-form__icon">
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-search" />
				</svg>
				<input class="search-form__button" type="submit" value="Submit" />
			</label>
		</form>
	</div>

	<div class="header__utility-nav">
		<ul class="header-menu">

			<li class="header-menu__item" id="utility-nav-search">
				<a class="pill pill--icon-only" href="#filters" id="search-toggle-button">
					<svg class="pill__icon">
						<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-search" />
					</svg>
				</a>
			</li>

			<li class="header-menu__item" id="utility-nav-menu-toggle">
				<a class="pill pill--icon-right" href="#filters" id="mainMenuOpenButton">
					<span class="pill__label"><?php _e('Menu',HPN_NAMESPACE); ?></span>
					<svg class="pill__icon">
						<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-menu" />
					</svg>
				</a>
			</li>

			<?php if ($feedback_url) { ?>
				<li class="header-menu__item" id="utility-nav-feedback">
					<a class="pill pill--icon-left" href="#footer">
						<svg class="pill__icon">
							<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-megaphone" />
						</svg>
						<span class="pill__label"><?php _e('Leave Feedback',HPN_NAMESPACE); ?></span>
					</a>
				</li>
			<?php } ?>

			<li class="header-menu__item" id="utility-nav-logout">
				<a class="pill pill--icon-left" href="<?php echo wp_logout_url(); ?>">
					<svg class="pill__icon">
						<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-logout" />
					</svg>
					<span class="pill__label"><?php _e('Log Out',HPN_NAMESPACE); ?></span>
				</a>
			</li>

		</ul>
	</div>

	<div class="header__logo">
		<?php the_custom_logo(); ?>
	</div>

</header>