<?php
/**
 * The main template file
 *
 * @package ExerciseTheme
 */

get_header(); ?>
	<div class="header-wave">
		<?php // get_template_part( 'partials/global/wave' ); ?>
	</div>

	<div class="c-page-header">
		<div class="grid-container grid-container--thin">
			<!-- TEMPORARY-->
			<h1>
				<?php esc_html_e( 'There\'s nothing here...', 'exercise-theme' ); ?>
			</h1>
			<div>
				<?php get_template_part( 'partials/illustrations/illustration-car-moon--iso' ); ?>
			</div>
		</div>
	</div>

	<?php /*
	<div class="grid-container grid-container--thin">
		<!-- Some illustration goes here? -->
		<div>
			<?php get_template_part( 'partials/illustrations/illustration-car-moon--iso' ); ?>
		</div>
	</div>

	*/?>

<?php
get_footer();
