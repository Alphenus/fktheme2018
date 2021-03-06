<?php
/**
 * FK Widgets
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'fk_slbd_count_widgets' ) ) {
	function fk_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( 4 == $widget_count ) :
				// If just four widgets, make square of them
        $widget_classes .= ' col-md-6';
      elseif ( $widget_count % 4 == 0 || 7 == $widget_count) :
        // Four widgets per row, if we get full rows that way, or if there are seven widgets, avoid row where there is only one widget
        $widget_classes .= ' col-md-3';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count || 1 == $widget_count ) :
				// If just one or two widgets are published, they take whole row
				$widget_classes .= ' col-md-12';
			endif; 
			return $widget_classes;
		endif;
	}
}

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */

add_action( 'widgets_init', 'fk_widgets_init' );

if ( ! function_exists( 'fk_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */

	function fk_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Partners', 'fk' ),
			'id'            => 'fk-partner-widgets',
			'description'   => __( 'Widget area for Partners', 'fk' ),
			'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s '. fk_slbd_count_widgets( 'fk-partner-widgets' ) .'">', 
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
    ) );
        
    register_sidebar( array(
			'name'          => __( 'Footer', 'fk' ),
			'id'            => 'fk-footer-widgets',
			'description'   => __( 'Widget area for Footer', 'fk' ),
			'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s '. fk_slbd_count_widgets( 'fk-footer-widgets' ) .'">', 
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
			'name'          => __( 'Notification', 'fk' ),
			'id'            => 'fk-notification-widgets',
			'description'   => __( 'Widget area e.g. for election notification', 'fk' ),
			'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s '. fk_slbd_count_widgets( 'fk-notification-widgets' ) .'">', 
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

	}
} // endif function_exists( 'understrap_widgets_init' ).
