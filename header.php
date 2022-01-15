<?php
/**
 * The template for displaying the header.
 *
 * @package ExerciseTheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<?php wp_head(); ?>

		<script>
			// remove no-js and add js to the HTML (do it the cross-brower way)
			document.documentElement.className = document.documentElement.className.replace('no-js', " ");
			document.documentElement.className += ' js ';

			// Webfont loader
			WebFontConfig = {
				google: { families: [ 'Rubik:300,400,500,600,700' ] }
			};

			(function() {
				var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
					'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		</script>
	</head>

	<body <?php body_class(); ?>>
		<?php do_action( 'after_body' ); ?>

		<header id="js-site-header" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<div class="container">

				<div class="site-header__logo" itemscope itemtype="http://schema.org/Organization">
					<span class="site-header__logo-desktop">
						<?php get_template_part( 'partials/global/logo-full' ); ?>
					</span>
					<span class="site-header__logo-mobile" id="js-site-header-logo">
						<?php get_template_part( 'partials/global/logo-small' ); ?>
					</span>
					<span class="screen-reader-text">
						<?php esc_html_e( 'Lorem ipsum', 'exercise-theme' ); ?>
					</span>
				</div>

				<nav id="js-nav-primary"
					class="nav-primary"
					role="navigation"
					itemscope="itemscope"
					itemtype="http://schema.org/SiteNavigationElement">
					<a id="js-nav-primary__toggle"
						href="#js-nav-primary"
						aria-controls="js-nav-primary__nav-menu"
						class="nav-primary__toggle">
						<div class="burger-menu">
							<div class="burger"></div>
						</div>
					</a>

					<?php
					$args = [
						'theme_location'  => 'primary',
						'menu_class'      => 'nav-primary__nav-menu',
						'menu_id'         => 'js-nav-primary__nav-menu',
						'container_class' => 'nav-primary__nav-menu-container',
						'container_id'    => 'js-nav-primary__nav-menu-container',
					];

					wp_nav_menu( $args );
					?>
				</nav>

			</div>
		</header>

		<main id="main" class="main <?php echo esc_attr( get_illustration_class() ); ?>" role="main">
