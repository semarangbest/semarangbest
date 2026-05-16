<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package Hellomadxartwork
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$is_madxartwork_theme_exist = function_exists( 'madxartwork_theme_do_location' );

if ( is_singular() ) {
	if ( ! $is_madxartwork_theme_exist || ! madxartwork_theme_do_location( 'single' ) ) {
		get_template_part( 'template-parts/single' );
	}
} elseif ( is_archive() || is_home() ) {
	if ( ! $is_madxartwork_theme_exist || ! madxartwork_theme_do_location( 'archive' ) ) {
		get_template_part( 'template-parts/archive' );
	}
} elseif ( is_search() ) {
	if ( ! $is_madxartwork_theme_exist || ! madxartwork_theme_do_location( 'archive' ) ) {
		get_template_part( 'template-parts/search' );
	}
} else {
	if ( ! $is_madxartwork_theme_exist || ! madxartwork_theme_do_location( 'single' ) ) {
		get_template_part( 'template-parts/404' );
	}
}

get_footer();
