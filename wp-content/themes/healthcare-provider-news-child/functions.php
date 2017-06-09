<?php

$hpn_child_theme = wp_get_theme();
define("HPN_CHILD_THEME_VERSION", $hpn_child_theme->get('Version'));

add_action('wp_enqueue_scripts', 'hpn_child_theme_enqueue_styles');
function hpn_child_theme_enqueue_styles() {
  wp_enqueue_style( 'hpn-child-theme-styles', get_template_directory_uri() . '/style.css', HPN_CHILD_THEME_VERSION );
}