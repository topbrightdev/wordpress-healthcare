<?php
// TEMPLATE NAME: Locations List
get_header();

$locations = get_terms(array(
	'taxonomy' => 'location',
	'hide_empty' => false,
	'orderby' => 'name',
	'order' => 'ASC'
));

?>

	<main class="layout-a">

		<section class="layout-a__featured mb-3">
			<h1 class="h1"><?php the_title(); ?></h1>
		</section>

		<section class="layout-a__content">

			<div class="layout-a__body">
				<ul class="term-list">
					<?php foreach ($locations as $location) : ?>
						<li class="term-list__item">
							<a class="term-list__link" href="<?php echo get_term_link($location->term_id); ?>">
								<span class="term-list__icon">
									<svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/sprite.svg#icon-location-pin" /></svg>
								</span>
								<?php echo $location->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

			<aside class="layout-a__sidebar">
				<?php get_sidebar(); ?>
			</aside>

		</section>


	</main>

<?php get_footer(); ?>