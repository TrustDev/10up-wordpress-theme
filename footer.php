<?php
/**
 * The template for displaying the footer.
 *
 * @package ExerciseTheme
 */

?>
	</main>

	<footer class="site-footer" id="footer" role="contentinfo">
		<div class="site-footer__top">
			<div class="site-footer__car">
				<?php get_template_part( 'partials/global/car-image' ); ?>
			</div>
			<div class="site-footer__cta">
				<h2 class="site-footer__cta-title">
					<?php
					$title_string = __( 'Praesent fermentum ', 'exercise-theme' ) . '<br>' . __( 'enim mauris', 'exercise-theme' ) . '<br>' . __( 'quis egestas?', 'exercise-theme' );

					$tag_whitelist = [
						'br' => [],
					];

					echo wp_kses( $title_string, $tag_whitelist );
					?>


				</h2>
				<a class="button-primary" href="#">
					<?php esc_html_e( 'Vivamus tristique', 'exercise-theme' ); ?>
				</a>
				<a class="button-secondary" href="#">
					<?php esc_html_e( 'Curabitur euismod', 'exercise-theme' ); ?>

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
			</div>
		</div>

		<div class="container container--thin">
			<div class="site-footer__logo" itemscope itemtype="http://schema.org/Organization">
				<a itemprop="url" href="<?php echo esc_url( site_url() ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/logo-full.svg' ); ?>" alt="<?php esc_attr_e( 'Logo', 'exercise-theme' ); ?>" />
					<!--
						Visually hide this text.
						WCAG 2.1: “image alt text cannot be the primary text of a link"
					-->
					<span class="screen-reader-text">
						<?php esc_html_e( 'Website', 'exercise-theme' ); ?>
					</span>
				</a>
			</div>

			<div class="site-footer__nav-wrapper">
				<nav class="site-footer__primary-nav" aria-hidden="false">
					<?php
					$args = [
						'theme_location'  => 'footer',
						'menu_class'      => 'nav-footer',
						'menu_id'         => 'nav-footer__menu',
						'container'       => 'div',
						'container_class' => 'nav-footer__nav-menu-container',
					];

					wp_nav_menu( $args );
					?>
				</nav>
			</div>

			<div class="site-footer__misc">
				<p class="site-footer__copyright">
					&copy; <?php echo date('Y'); ?><?php esc_html_e( ' Proin justo purus vestibulum.', 'exercise-theme' ); ?>
					<?php esc_html_e( 'Quisque aliquet pretium massa at porttitor', 'exercise-theme' ); ?>
				</p>
			</div>
		</div>
	</footer>

	<?php get_template_part('partials/gdpr-banner'); ?>

	<?php wp_footer(); ?>

	</body>
</html>
