<?php
function remove_all_classes_from_widget_menu_in_footer( $classes, $item, $args ) {

	if ( isset( $args->menu->name ) && strpos( $args->menu->name, 'Footer' ) === 0 ) {
		return array();
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'remove_all_classes_from_widget_menu_in_footer', 10, 3 );
