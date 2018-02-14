<?php
/**
 * Hestia Moments functions and definitions.
 *
 * @package hestia-moments
 * @since 1.0.0
 */
define( 'HESTIA_MOMENTS_VERSION', '1.0.');

if ( !function_exists( 'hestia_moments_parent_css' ) ):
	/**
	 * Enqueue parent CSS.
	 */
	function hestia_moments_parent_css() {
		wp_enqueue_style( 'hestia_moments_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap' ) );
		if( is_rtl() ) {
			wp_enqueue_style( 'hestia_moments_parent_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css', array( 'bootstrap' ) );
		}
	}
endif;

add_action( 'wp_enqueue_scripts', 'hestia_moments_parent_css', 10 );

/**
 * Enqueue style of parent theme and styles from current child theme.
 *
 * @since 1.0.0
 */
function hestia_moments_scripts() {
	wp_enqueue_style( 'hestia-moments-style', get_stylesheet_uri(), array(), HESTIA_MOMENTS_VERSION );
}
add_action( 'wp_enqueue_scripts', 'hestia_moments_scripts',9);

/**
 * Change default accent color.
 *
 * @return string
 */
function hestia_moments_filter_accent_color() {
	return '#009ee8';
}

add_filter( 'hestia_accent_color_default', 'hestia_moments_filter_accent_color' );

/**
 * Change default fonts.
 *
 * @since 1.0.0
 */
function hestia_moments_customize_register( $wp_customize ) {
	$hestia_headings_font = $wp_customize->get_setting( 'hestia_headings_font' );
	if ( ! empty( $hestia_headings_font ) ) {
		$hestia_headings_font->default = 'Raleway';
	}
	$hestia_body_font = $wp_customize->get_setting( 'hestia_body_font' );
	if ( ! empty( $hestia_body_font ) ) {
		$hestia_body_font->default = 'Open Sans';
	}
}
add_action( 'customize_register', 'hestia_moments_customize_register', 99 );

/**
 * Change default parameter for heading font.
 *
 * @since 1.0.0
 */
function hestia_moments_default_heading_fonts(){
	return 'Raleway';
}

/**
 * Change default parameter for body font.
 *
 * @since 1.0.0
 */
function hestia_moments_default_body_fonts(){
	return 'Open Sans';
}
add_filter( 'hestia_headings_default', 'hestia_moments_default_heading_fonts' );
add_filter( 'hestia_body_font_default', 'hestia_moments_default_body_fonts' );

/**
 * Change default parameter for big title background.
 *
 * @since 1.0.0
 */
function hestia_moments_big_title_background_default() {
	return get_stylesheet_directory_uri() . '/assets/img/big_title.jpg';
}
add_filter( 'hestia_big_title_background_default', 'hestia_moments_big_title_background_default' );

/**
 * Change features defaults.
 *
 * @since 1.0.0
 */
function hestia_moments_features_defaults() {
	return json_encode(
		array(
			array(
				'icon_value' => 'fa-calendar',
				'title'      => esc_html__( 'Events', 'hestia-moments' ),
				'text'       => esc_html__( 'Display information about the events you are going to host!', 'hestia-moments' ),
				'link'       => '',
				'color'      => '#e91e63',
			),
			array(
				'icon_value' => 'fa-film',
				'title'      => esc_html__( 'Shows', 'hestia-moments' ),
				'text'       => esc_html__( 'Any shows, or theatre plays coming up?', 'hestia-moments' ),
				'link'       => '',
				'color'      => '#00bcd4',
			),
			array(
				'icon_value' => 'fa-id-card',
				'title'      => esc_html__( 'Conferences', 'hestia-moments' ),
				'text'       => esc_html__( 'The best learning experience is yet to come, what are you waiting for?', 'hestia-moments' ),
				'link'       => '',
				'color'      => '#4caf50',
			),
		)
	);
}
add_filter( 'hestia_features_default_content', 'hestia_moments_features_defaults' );

/**
 * Change contact background image.
 *
 * @return string
 * @since 1.0.0
 */
function hestia_moments_contact_background() {
	return get_stylesheet_directory_uri() . '/assets/img/contact.jpg';
}
add_filter( 'hestia_contact_background_default', 'hestia_moments_contact_background' );

/**
 * Change contact dummy content.
 *
 * @return string
 * @since 1.0.0
 */
function hestia_moments_contact_content() {
	$html = '<div class="hestia-info info info-horizontal">
			<div class="icon icon-primary">
				<i class="fa fa-envelope"></i>
			</div>
			<div class="description">
				<h3 class="info-title">' . __( 'Where\'s the event?', 'hestia-moments' ) . '</h3>
				<p>'. __( 'Arctic Circle, 96930 Arctic Circle, Finland Lapland', 'hestia-moments') . '</p>
			</div>
		</div>
		<div class="hestia-info info info-horizontal">
			<div class="icon icon-primary">
				<i class="fa fa-heart"></i>
			</div>
			<div class="description">
				<h3 class="info-title">' . __( 'Contact Us?', 'hestia-moments' ) . '</h3>
				<p>' . __( 'John Cena', 'hestia-moments' ) .' <br> +12 345 678 90<br> ' . __( 'Mon - Fri', 'hestia-moments' ) . ', 8:00-22:00</p>
			</div>
		</div>';

	return $html;
}
add_filter( 'hestia_contact_content_default', 'hestia_moments_contact_content' );

add_action( 'after_switch_theme', 'hestia_moments_get_lite_options' );

/**
 * Import options from Hestia
 */
function hestia_moments_get_lite_options() {
    $hestia_mods = get_option( 'theme_mods_hestia' );
    if ( ! empty( $hestia_mods ) ) {

        foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {

            set_theme_mod( $hestia_mod_k, $hestia_mod_v );
        }

    }
}
