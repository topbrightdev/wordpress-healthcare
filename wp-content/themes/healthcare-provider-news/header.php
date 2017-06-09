<?php HPN_Admin::require_login(); ?><!doctype html>
<html lang="en" class="no-js">
<head>
	<meta http-equiv="x-ua-compatible" content="IE=Edge"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title(); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
  <?php wp_head(); ?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/dist/js/html5shiv.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/dist/js/respond.min.js"></script>
	<![endif]-->
</head>

<body <?php body_class(); ?>>

	<?php HPN_Theme::get_header_analytics_script(); ?>

	<div class="lrp-container pb-4" id="masterWrap">

		<?php get_template_part('parts/site-header'); ?>