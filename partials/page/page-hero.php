<?php
/**
 * Page hero partial
 *
 * @package ExerciseTheme
 */

$post_thumb_url = '';

if ( true === has_post_thumbnail() ) {
	$post_thumb_url = get_the_post_thumbnail_url();
}

$hero_cta_button = get_post_meta( $post->ID, 'buttonType', true );
$hero_cta_text   = get_post_meta( $post->ID, 'heroCtaText', true );
$hero_cta_url    = get_post_meta( $post->ID, 'heroCtaURL', true );

if ( empty( $hero_cta_button  ) ) {
	$hero_cta_button = 'button-primary';
}

$hero_content   = get_post_meta( $post->ID, 'heroText', true );
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

<div class="c-hero" <?php if ( ! empty( $post_thumb_url ) ) : ?> style="background-image:url(<?php echo esc_url( $post_thumb_url ); ?>);" <?php endif; ?>>
	<?php if ( is_front_page() ) : ?>
		<div class="c-hero__background">
			<?php get_template_part( 'partials/illustrations/illustration-car-moon' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_page( 'plans-pricing' ) ) : ?>
		<div class="c-hero__background">
			<?php get_template_part( 'partials/illustrations/illustration-doc-2' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_page( 'getting-started' ) ) : ?>
		<div class="c-hero__background">
			<?php get_template_part( 'partials/illustrations/illustration-hover-board' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_page( 'features' ) ) : ?>
		<div class="c-hero__background">
			<?php get_template_part( 'partials/illustrations/illustration-almanac' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_page( 'request-a-demo' ) ) : ?>
		<div class="c-hero__background">
			<?php get_template_part( 'partials/illustrations/illustration-demo' ); ?>
		</div>
	<?php endif; ?>
	<div class="grid-container grid-container--thin">
		<div class="c-hero__inner">
			<h1 class="c-hero__title">
				<?php the_title(); ?>
			</h1>

			<?php if ( ! empty( $hero_content ) ) : ?>
			<div class="c-hero__content">
				<?php echo wp_kses( $hero_content, $tag_whitelist ); ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $hero_cta_text ) ) : ?>
			<a class="<?php echo esc_attr( $hero_cta_button ); ?>" href="<?php echo esc_url( $hero_cta_url ); ?>">
				<?php esc_html_e( 'Start Free Trial', 'exercise-theme' ); ?>

				<?php if ( 'button-secondary' === $hero_cta_button ) : ?>
					<?php
					ExerciseTheme\Helpers\svg_icon(
						'arrow-right-heavy',
						[
							'height' => '14',
							'width'  => '12',
						]
					);
					?>
				<?php endif; ?>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>
