<?php
/**
 * The front page template file.
 *
 * @package ExerciseTheme
 */

get_header(); ?>


<div class="c-page-header">
	<div class="grid-container grid-container--thin">
		<h1><?php the_title(); ?></h1>
	</div>
</div>

<div class="grid-container grid-container--thin">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'partials/content', 'page' );

	endwhile; // End of the loop.
	?>
</div>

<?php
get_footer();
