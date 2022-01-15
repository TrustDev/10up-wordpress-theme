<?php
/**
 * The post block partial
 *
 * @package ExerciseTheme
 */

?>

<div class="c-post-block">

	<div class="post-block__meta">
		<p>
			<span itemprop="datePublished">
				<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" pubdate>
					<?php the_date(); ?>
				</time>
			</span>
			<?php esc_html_e( 'by', 'exercise-theme' ); ?>
			<span itemprop="author"><?php the_author_link(); ?></span>
		</p>
	</div>

	<h4 class="post-block__title">
		<a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h4>

	<div class="post-block__content">
		<?php the_excerpt(); ?>
	</div>
</div>
