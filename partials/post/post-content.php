<?php
/**
 * The post content partial
 *
 * @package ExerciseTheme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/BlogPosting">

	<!-- flag this as the main area of the page -->
	<div itemprop="mainEntityOfPage">

		<!-- articles get headers (and footers) -->
		<header class="post__header">

			<div class="post__header-content">
				<div class="container container">
					<div class="post__header-content-inner">
						<!-- Name of the article -->
						<h1 class="post__header-title" itemprop="headline"><?php the_title(); ?></h1>

						<div class="post__header-meta">
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
					</div>
				</div>
			</div>

			<div class="post__header-background">
				<?php if ( has_post_thumbnail() ) : ?>

					<?php
					$meta           = wp_get_attachment_metadata( get_post_thumbnail_id( get_the_ID() ) );
					$width          = $meta['width'];
					$height         = $meta['height'];
					$post_image_url = get_the_post_thumbnail_url( $post, 'full' );
					?>

					<svg version="1.1" xmlns="http://www.w3.org/2000/svg">
						<clipPath id="header-bg-clip">
							<path d="M0 0H107.748H833V484C833 484 730.376 416.696 590.199 409.476C450.023 402.257 340.894 323.806 265.5 213.5C190.106 103.194 0 0 0 0Z" fill="#E8FEFD"/>
						</clipPath>
					</svg>

					<svg class="post__header-background-image" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<image xlink:href="<?php echo esc_url( $post_image_url ); ?>" width="100%" height="540"></image>
					</svg>

					<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
						<meta itemprop="url" content="<?php echo esc_url( the_post_thumbnail_url() ); ?>" />
						<meta itemprop="width" content="<?php echo esc_attr( $width ); ?>" />
						<meta itemprop="height" content="<?php echo esc_attr( $height ); ?>" />
					</div><!--/itemprop=image-->
				<?php endif; ?>
			</div>
		</header>

		<div itemprop="publisher" itemscope="itemscope" itemtype="https://schema.org/Organization">
			<div itemprop="logo" itemscope="itemscope" itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/logo-full.svg' ); ?>" />
				<meta itemprop="width" content="100" />
				<meta itemprop="height" content="100" />
			</div>
			<meta itemprop="name" content="<?php esc_attr_e( 'Lorem ipsum', 'exercise-theme' ); ?>" />
		</div><!--/.itemprop=publisher-->

		<!-- Main body of the article -->
		<div class="post__content" itemprop="articleBody">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div><!--/itemprop=articleBody-->

	</div><!--/itemprop=mainEntityOfPage-->

</article><!--/itemtype=BlogPosting-->
