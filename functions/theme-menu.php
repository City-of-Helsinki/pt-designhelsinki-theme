<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function designhelsinki_main_menu_name(): string {
	return 'primary';
}

function designhelsinki_register_nav_menus(): void {
	register_nav_menus( array(
		designhelsinki_main_menu_name() => esc_html__( 'Primary', 'designhelsinki' ),
	) );
}

function designhelsinki_main_menu(): void {
	wp_nav_menu( array(
		'theme_location' => designhelsinki_main_menu_name(),
		'container' => false,
		'fallback_cb' => false,
	) );
}

function designhelsinki_main_menu_dropdown_arrow( $output, $item, $depth, $args ) {
	if (
		designhelsinki_main_menu_name() == $args->theme_location
		&& 0 === $depth
		&& in_array( "menu-item-has-children", $item->classes )
	) {
		$output .='<button class="menu-toggle" aria-expanded="false" aria-label="Avaa alavalikko" tabindex="0"><div class="inner-button hds-icon hds-icon--size-m hds-icon--angle-down closed"></div></button>';
	}
	return $output;
}
