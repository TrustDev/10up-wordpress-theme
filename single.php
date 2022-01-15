<?php
/**
 * Single post template.
 *
 * @package ExerciseTheme
 */

use ExerciseTheme\Helpers;

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'partials/post/post-content' ); ?>

<?php endwhile; ?>

<?php
get_footer();
