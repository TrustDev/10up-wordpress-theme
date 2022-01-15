<?php
/**
 * General helper functions.
 *
 * @package ExerciseTheme
 */

namespace ExerciseTheme\Helpers;

/**
 * SVG Icons
 *
 * Example:
 * <?php ExerciseTheme\Helpers\svg_icon( 'angle-left', ['height' => '20', 'width' => '20'] ); ?>
 *
 * @param  string $name The name to use.
 * @param  array  $opts Options for the SVG.
 * @param  bool   $echo Whether to echo the results. Defaults to true.
 * @return string
 */
function svg_icon(
	string $name = '',
	array $opts = [],
	bool $echo = true
) : string {
	$args = wp_parse_args(
		$opts,
		[
			'role'   => 'img',
			'height' => '25',
			'width'  => '25',
			'class'  => 'icon-' . $name,
			'label'  => $name,
		]
	);

	$href           = ET_TEMPLATE_URL . '/dist/icons/icons.svg#icon-' . $name;
	$args['class'] .= ' icon';
	$label          = ! empty( $opts['label'] ) ? 'aria-label="' . $opts['label'] . '"' : $args['label'];
	$label          = 'presentation' === $args['role'] ? '' : $args['label'];

	$svg = sprintf(
		'<svg role="%s" height="%s" width="%s" class="%s" aria-label="%s"><use xlink:href="%s"/></svg>',
		esc_attr( $args['role'] ),
		esc_attr( $args['height'] ),
		esc_attr( $args['width'] ),
		esc_attr( $args['class'] ),
		esc_attr( $label ),
		esc_url( $href )
	);
	if ( $echo ) {
		echo $svg; // WPCS: XSS okay.
	}
	return $svg;
}

/**
 * Check if an array is associative.
 *
 * @param array $array Array to check.
 * @return bool
 */
function array_is_associative( $array ) {
	return array_keys( $array ) != range( 0, count( $array ) - 1 );
}
