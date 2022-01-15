<?php
/**
 * The page content.
 *
 * @package ExerciseTheme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-page' ); ?> >
	<div class="entry-content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
