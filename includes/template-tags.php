<?php
/**
 * Custom template tags for this theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with ExerciseTheme in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 * Example: `tenup_function()`
 *
 * @package ExerciseTheme\Template_Tags
 */

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists( $dir . $path ) ) {
		$css_vars = file_get_contents( $dir . $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		preg_match_all( ' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;

}

/**
 * Returns a selector class to apply illustrations to the main page element.
 *
 * @return string
 */
function get_illustration_class() {
	$class = '';

	if ( true === is_front_page() ) {
		$class = 'main--home';
	}

	return $class;
}

/**
 * Gets all slides from slides CPT.
 *
 * @param string $tax_slug The slug of the taxonomy for desired slides.
 * @return array
 */
function get_slides( $tax_slug = 'all' ) {
	$slides = [];

	if ( 'all' === $tax_slug ) {
		$args = array(
			'post_type'      => array( 'slides' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => '100',
			'order'          => '',
			'cat'            => '',
			'tag'            => '',
		);
	} else {
		$args = array(
			'post_type'      => array( 'slides' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => '100',
			'order'          => '',
			'cat'            => '',
			'tag'            => '',
			'tax_query'      => array(
				array(
					'taxonomy' => 'page_assignment',
					'field'    => 'slug',
					'terms'    => $tax_slug,
				),
			),
		);
	}

	$slides_query = new \WP_Query( $args );
	$slides       = $slides_query->posts;

	return $slides;
}

/**
 * Gets the query for the slides CPT.
 *
 * @param string $tax_slug The slug of the taxonomy for desired slides.
 *
 * @return WP_Query
 */
function get_slides_query( $tax_slug = 'all' ) {
	$slides           = [];
	$slides_reference = [];

	if ( 'all' === $tax_slug ) {
		$args = array(
			'post_type'      => array( 'slides' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => '100',
			'orderby'        => 'menu_order',
		);
	} else {
		$args = array(
			'post_type'      => array( 'slides' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => '100',
			'orderby'        => 'menu_order',
			'tax_query'      => array(
				array(
					'taxonomy' => 'page_assignment',
					'field'    => 'slug',
					'terms'    => $tax_slug,
				),
			),
		);
	}

	$slides_query = new \WP_Query( $args );

	return $slides_query;
}

/**
 * Displays an individual slide based on a specified Post Slug.
 *
 * @param string $slug The slide slug to be displayed
 * @param array  $slides An array of slides from the slides CPT.
 */
function display_slide( $slug, $slides ) {
	$post = null;

	foreach ( $slides as $struct ) {
		if ( $slug === $struct->post_name ) {
			$post = $struct;
			break;
		}
	}

	if ( ! empty( $post ) ) {
		$post_id = $post->ID;
	} else {
		return;
	}

	if ( 'slides' !== $post->post_type ) {
		return;
	}

	$slide_type = get_post_meta( $post_id, 'slidesType', true );

	if ( 'two-thirds' === $slide_type ) {
		slide_two_thirds( $post );
	} elseif ( 'two-column' === $slide_type ) {
		slide_two_column( $post );
	} elseif ( 'three-column' === $slide_type || 'three-column-numbered' === $slide_type ) {
		slide_three_column( $post, $slide_type );
	}
}

/**
 * Displays the slides passed to it based on a WP Post Object.
 *
 * @param object $post A WP_Post object.
 */
function display_slides( $post ) {

	if ( ! empty( $post ) ) {
		$post_id = $post->ID;
	} else {
		return;
	}

	if ( 'slides' !== $post->post_type ) {
		return;
	}

	$slide_type = get_post_meta( $post_id, 'slidesType', true );


	if ( 'two-thirds' === $slide_type ) {
		slide_two_thirds( $post );
	} elseif ( 'two-column' === $slide_type ) {
		slide_two_column( $post );
	} elseif ( 'three-column' === $slide_type || 'three-column-numbered' === $slide_type ) {
		slide_three_column( $post, $slide_type );
	}
}

/**
 * Displays the home page specific slide.
 *
 * @param string $slug The slide slug to be displayed
 * @param array  $slides An array of slides from the slides CPT.
 */
function display_home_slide( $slug, $slides ) {
	$post = null;

	foreach ( $slides as $struct ) {
		if ( $slug === $struct->post_name ) {
			$post = $struct;
			break;
		}
	}

	if ( ! empty( $post ) ) {
		$post_id = $post->ID;
	} else {
		return;
	}

	if ( 'slides' !== $post->post_type ) {
		return;
	}

	home_slide( $post );
}

/**
 * Display the two thrids slide.
 *
 * @param object $post A WP_Post object.
 */
function slide_two_thirds( $post ) {
	$title                    = $post->post_title;
	$text_content             = $post->post_content;
	$post_image               = get_the_post_thumbnail( $post );
	$svg_name                 = get_post_meta( $post->ID, 'svgIncludePath', true);
	$cta_text                 = get_post_meta( $post->ID, 'ctaLinkText', true );
	$cta_url                  = get_post_meta( $post->ID, 'ctaLinkURL', true );
	$slide_alignment          = get_post_meta( $post->ID, 'slidesAlignment', true );
	$slide_background         = get_post_meta( $post->ID, 'slidesBackground', true );
	$slide_image_options      = get_post_meta( $post->ID, 'slidesImageOptions', true );
	$slide_container_classes  = '';
	$slide_classes            = [ 'c-two-thirds--spacey' ];
	$display_hr               = get_post_meta( $post->ID, 'slideSeparator', true );
	$slide_width              = get_post_meta( $post->ID, 'slidesWidth', true );
	$slide_image_classes      = 'c-two-thirds__image--small';

	if ( 'extra-thin' === $slide_width ) {
		$slide_container_classes = 'grid-container--xthin';
	} elseif ( 'thin' === $slide_width ) {
		$slide_container_classes = 'grid-container--thin';
	} elseif ( 'medium' === $slide_width ) {
		$slide_container_classes = 'grid-container--medium';
	}

	$image_tag_whitelist = [
		'img' => [
			'src'      => [],
			'alt'      => [],
			'class'    => [],
			'width'    => [],
			'height'   => [],
			'srcset'   => [],
			'itemprop' => [],
		],
	];

	if ( 'text-align-left' === $slide_alignment ) {
		$slide_classes[] = 'c-two-thirds--text-left';
	}

	if ( 'text-align-right' === $slide_alignment ) {
		$slide_classes[] = 'c-two-thirds--text-right';
	}

	if ( 'image-large' === $slide_image_options ) {
		$slide_image_classes = 'c-two-thirds__image--large';
	}

	if ( 'orb-one' === $slide_background ) {
		$slide_classes[] = 'c-two-thirds--bg-orb';
	} elseif ( 'orb-two' === $slide_background ) {
		$slide_classes[] = 'c-two-thirds--bg-orb-two';
	} elseif ( 'orb-three' === $slide_background ) {
		$slide_classes[] = 'c-two-thirds--bg-orb-three';
	} elseif ( 'orb-four' === $slide_background ) {
		$slide_classes[] = 'c-two-thirds--bg-orb-four';
	}
	?>

	<div class="c-two-thirds <?php echo esc_attr( implode( ' ', $slide_classes ) ); ?>">
		<div class="grid-container <?php echo esc_attr( $slide_container_classes ); ?>">

			<div class="c-two-thirds__image-container column small-12 medium-5">
				<?php if ( ! empty( $svg_name ) && $svg_name !== 'none' ) { ?>
					<div class="c-two-thirds__image <?php echo esc_attr( $slide_image_classes ); ?>">
						<?php get_template_part( esc_html( 'partials/illustrations/' . $svg_name ) ); ?>
					</div>
				<?php } else { ?>
					<div class="c-two-thirds__image <?php echo esc_attr( $slide_image_classes ); ?>">
						<?php echo wp_kses( $post_image, $image_tag_whitelist ); ?>
					</div>
				<?php } ?>
			</div>

			<div class="c-two-thirds__content-container column small-12 medium-7">
				<div class="c-two-thirds__content">
					<?php if ( ! empty( $title ) ) : ?>
						<h4 class="c-two-thirds__title">
							<?php echo esc_html( $title ); ?>
						</h4>
					<?php endif; ?>

					<p><?php echo esc_html( $text_content ); ?></p>

					<?php if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) : ?>
						<a class="button-secondary" href="<?php echo esc_url( $cta_url ); ?>">
							<?php echo esc_html( $cta_text ); ?>
							<?php
							ExerciseTheme\Helpers\svg_icon(
								'arrow-right-heavy',
								[
									'height' => '14',
									'width'  => '12',
								]
							);
							?>
						</a>
					<?php endif; ?>

				</div>
			</div>

		</div>
	</div>
	<?php
	if ( 'bottom-hr' === $display_hr ) {
		display_hr();
	}
}

/**
 * Display the horizontal rule separator.
 */
function display_hr() {
	?>
	<div class="container container--thin">
		<div class="c-hr"></div>
	</div>
	<?php
}

/**
 * Display the home page specific slide
 *
 * @param object $post A WP_Post object.
 */
function home_slide( $post ) {
	$title                    = $post->post_title;
	$text_content             = $post->post_content;
	$post_image               = get_the_post_thumbnail( $post );
	$cta_text                 = get_post_meta( $post->ID, 'ctaLinkText', true );
	$cta_url                  = get_post_meta( $post->ID, 'ctaLinkURL', true );
	$slide_alignment          = get_post_meta( $post->ID, 'slidesAlignment', true );
	$slide_spacing            = get_post_meta( $post->ID, 'slidesSpacing', true );
	$slide_background         = get_post_meta( $post->ID, 'slidesBackground', true );
	$slide_image_options      = get_post_meta( $post->ID, 'slidesImageOptions', true );
	$slide_x_spacing          = true;
	$slide_classes            = [];
	$slide_image_classes      = [];

	$image_tag_whitelist = [
		'img' => [
			'src'      => [],
			'alt'      => [],
			'class'    => [],
			'width'    => [],
			'height'   => [],
			'srcset'   => [],
			'itemprop' => [],
		],
	];

	if ( 'text-align-left' === $slide_alignment ) {
		$slide_classes[] = 'c-two-thirds--text-left';
	}

	if ( 'text-align-right' === $slide_alignment ) {
		$slide_classes[] = 'c-two-thirds--text-right';
	}

	if ( 'spacing-y' === $slide_spacing ) {
		$slide_classes[] = 'c-two-thirds--spacey';
	}

	if ( 'image-large' === $slide_image_options ) {
		$slide_image_classes[] = 'c-two-thirds__image--large';
	}

	if ( 'orb-one' === $slide_background ) {
		$slide_classes[] = 'c-two-thirds--bg-orb';
	}
	?>

	<div class="c-two-thirds c-two-thirds--text-right c-two-thirds--spacey c-two-thirds--bg-orb">
		<div class="grid-container grid-container--thin">

				<div class="column small-12 medium-4">
					<?php if ( ! empty( $post_image ) ) : ?>
						<div class="c-two-thirds__image c-two-thirds__image--large">
							<?php echo wp_kses( $post_image, $image_tag_whitelist ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="column small-12 medium-8">
					<div class="c-two-thirds__content c-two-thirds__content--home">
						<div class="c-two-thirds__content-inner">

							<?php if ( ! empty( $title ) ) : ?>
								<h2 class="c-two-thirds__title">
									<?php echo esc_html( $title ); ?>
								</h2>
							<?php endif; ?>

							<p><?php echo esc_html( $text_content ); ?></p>

							<?php if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) : ?>
								<a class="button-secondary" href="<?php echo esc_url( $cta_url ); ?>">
									<?php echo esc_html( $cta_text ); ?>
									<?php
									ExerciseTheme\Helpers\svg_icon(
										'arrow-right-heavy',
										[
											'height' => '14',
											'width'  => '12',
										]
									);
									?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
		</div>
	</div>
	<?php
}

/**
 * Display the two column component.
 *
 * @param object $post A WP_Post object.
 */
function slide_two_column( $post ) {
	$text_column_one = $post->post_content;
	$text_column_one = apply_filters( 'the_content', $text_column_one );
	$text_column_one = str_replace( ']]>', ']]&gt;', $text_column_one );
	$text_column_two = get_post_meta( $post->ID, 'columnTwo', true );
	$display_hr      = get_post_meta( $post->ID, 'slideSeparator', true );
	$slide_width     = get_post_meta( $post->ID, 'slidesWidth', true );
	$container_class = '';

	if ( 'extra-thin' === $slide_width ) {
		$container_class = 'grid-container--xthin';
	} elseif ( 'thin' === $slide_width ) {
		$container_class = 'grid-container--thin';
	} elseif ( 'medium' === $slide_width ) {
		$container_class = 'grid-container--medium';
	}

	$tag_whitelist = [
		'h2'     => [],
		'h3'     => [],
		'h4'     => [],
		'h5'     => [],
		'img'    => [
			'src'      => [],
			'alt'      => [],
			'class'    => [],
			'width'    => [],
			'height'   => [],
			'srcset'   => [],
			'itemprop' => [],
		],
		'strong' => [],
		'p'      => [],
		'a'      => [
			'href' => [],
			'class' => [],
		],
		'br'     => [],
	];
	?>
	<div class="c-two-column">
		<div class="grid-container <?php echo esc_attr( $container_class ); ?>">
			<div class="column small-12 medium-6">
				<?php echo wp_kses( $text_column_one, $tag_whitelist ); ?>
			</div>
			<div class="column small-12 medium-6">
				<?php echo wp_kses( $text_column_two, $tag_whitelist ); ?>
			</div>
		</div>
	</div>
	<?php
	if ( 'bottom-hr' === $display_hr ) {
		display_hr();
	}
}

/**
 * Display the three column component.
 *
 * @param object $post A WP_Post object.
 */
function slide_three_column( $post, $slide_type ) {
	$text_column_one   = $post->post_content;
	$text_column_one   = apply_filters( 'the_content', $text_column_one );
	$text_column_one   = str_replace( ']]>', ']]&gt;', $text_column_one );
	$text_column_two   = get_post_meta( $post->ID, 'columnTwo', true );
	$text_column_three = get_post_meta( $post->ID, 'columnThree', true );
	$display_hr        = get_post_meta( $post->ID, 'slideSeparator', true );
	$slide_width       = get_post_meta( $post->ID, 'slidesWidth', true );
	$numbered_bg_class = '';
	$container_class   = '';

	if ( 'three-column-numbered' === $slide_type ) {
		$numbered_bg_class = 'c-three-column--numbered';
	}

	if ( 'extra-thin' === $slide_width ) {
		$container_class = 'container--xthin';
	} elseif ( 'thin' === $slide_width ) {
		$container_class = 'container--thin';
	} elseif ( 'medium' === $slide_width ) {
		$container_class = 'container--medium';
	}

	$tag_whitelist = [
		'h2'     => [],
		'h3'     => [],
		'h4'     => [],
		'h5'     => [],
		'img'    => [
			'src'      => [],
			'alt'      => [],
			'class'    => [],
			'width'    => [],
			'height'   => [],
			'srcset'   => [],
			'itemprop' => [],
		],
		'strong' => [],
		'p'      => [],
		'a'      => [],
		'br'     => [],
	];
	?>

	<div class="c-three-column <?php echo esc_attr( $numbered_bg_class ); ?>">
		<?php if ( 'three-column-numbered' === $slide_type ) : ?>
		<div class="container <?php echo esc_attr( $container_class ); ?> ">
			<h2>
				<?php the_title(); ?>
			</h2>
		</div>
		<?php endif; ?>

		<div class="grid-container grid-container--thin">
			<div class="column small-12 medium-4">
				<?php echo wp_kses( $text_column_one, $tag_whitelist ); ?>
			</div>
			<div class="column small-12 medium-4">
				<?php echo wp_kses( $text_column_two, $tag_whitelist ); ?>
			</div>
			<div class="column small-12 medium-4">
				<?php echo wp_kses( $text_column_three, $tag_whitelist ); ?>
			</div>
		</div>
	</div>
	<?php
	if ( 'bottom-hr' === $display_hr ) {
		display_hr();
	}
}

function archive_pagination() {
	global $wp_query;
	?>
	<div class="c-archive-pagination">
		<nav class="pagination" aria-label="<?php echo esc_attr( 'Pagination Navigation', 'exercise-theme' ); ?>" role="navigation">
			<?php
			$num = 99999999;
			echo paginate_links( // WPCS: XSS ok.
				array(
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var('paged') ),
					'total'     => $wp_query->max_num_pages,
					'type'      => 'list',
					'prev_next' => false,
				)
			);
			?>
		</nav>
	</div>
	<?php
}
