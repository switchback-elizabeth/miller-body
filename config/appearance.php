<?php
/**
 * Genesis Sample appearance settings.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$miller_body_default_colors = [
	'link'   => '#1ca2c3',
	'accent' => '#1ca2c3',
];

$miller_body_link_color = get_theme_mod(
	'miller_body_link_color',
	$miller_body_default_colors['link']
);

$miller_body_accent_color = get_theme_mod(
	'miller_body_accent_color',
	$miller_body_default_colors['accent']
);

$miller_body_link_color_contrast   = miller_body_color_contrast( $miller_body_link_color );
$miller_body_link_color_brightness = miller_body_color_brightness( $miller_body_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=WindSong&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $miller_body_link_color,
	'button-color'         => $miller_body_link_color_contrast,
	'button-outline-hover' => $miller_body_link_color_brightness,
	'link-color'           => $miller_body_link_color,
	'default-colors'       => $miller_body_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'miller-body' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $miller_body_link_color,
		],
		[
			'name'  => __( 'Accent color', 'miller-body' ),
			'slug'  => 'theme-secondary',
			'color' => $miller_body_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'miller-body' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'miller-body' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'miller-body' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'miller-body' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
