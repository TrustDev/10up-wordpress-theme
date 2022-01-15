<?php
/**
 * The main template file
 *
 * @package ExerciseTheme
 */

get_header(); ?>
	<div class="header-wave">
		<?php get_template_part( 'partials/global/wave' ); ?>
	</div>

	<div class="c-page-header">
		<div class="grid-container grid-container--thin">
			<h1>
				<?php esc_html_e( 'Articles', 'exercise-theme' ); ?>
			</h1>
		</div>
	</div>

	<div class="grid-container grid-container--thin">

		<div class="column small-12 medium-3">
			<aside class="c-sidebar">
				<nav class="c-sidebar-widget__cat-list" role="navigation">
					<ul>
						<?php wp_list_categories( [ 'title_li' => '' ] ); ?>
					</ul>
				</nav>
				<?php get_template_part( 'partials/dropdown-cats' ); ?>
			</aside>
		</div>

		<div class="column small-12 medium-9">

			<div class="post-list">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/post-block' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>
			</div>

			<?php archive_pagination(); ?>

		</div>
	</div>

<?php
get_footer();
