<?php // @codingStandardsIgnoreLine
	$first  = meta( 'first_rating_value' );
	$second = meta( 'second_rating_value' );
	$third  = meta( 'third_rating_value' );

	$average = round( ( $first + $second + $third ) / 3, 1 );

function progressbar( $text, $rating, $color ) {
	?>
		<div class="progressBar__wrapper">
			<strong class="progressBar__desc"><?= meta( $text ); ?></strong>
			<div class="progressBar">
				<div class="progressBar__inn" style="background-color: <?= esc_attr( $color ); ?>; width:<?= esc_attr( ( $rating / 5 * 100 ) . '%' ); ?>"></div>
			</div>
			<strong class="progressBar__rating"><?= $rating; ?></strong>
		</div>
	<?php
}
?>

	<div class="Post__header <?= esc_attr( $header_category ); ?>">
		<div class="wrapper__wide">
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/reviews/', 'ms' ); ?>"><?php _e( 'Reviews', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<div class="flex">
				<h1 itemprop="name"><?php the_title(); ?></h1>
				<span itemprop="dateModified" content="<?= esc_html( get_the_modified_time( 'F j, Y' ) ); ?>"> 
					<?= esc_html( __( 'Last modified on', 'ms' ) . ' ' . get_the_modified_time( 'F j, Y' ) ); ?>
				</span>
			</div>
		</div>
	</div>

	<div class="wrapper flex">
		<div class="col-50">
			<ul class="Post__sidebar__categories__labels">
				<?php
				$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_reviews' );
				$categories = get_the_terms( $current_id, 'ms_reviews_categories' );

				if ( $categories ) {
					foreach ( $categories as $category ) {
						?>
				<li class="Post__sidebar__link">
					<a href="../<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>
				</li>
						<?php
					}
				}
				?>
			</ul>
			<?php
				$how = __( 'How ${product} is doing on review portals', 'reviews' );
				echo esc_html( str_replace( '${product}', get_the_title(), $how ) );
			?>
			<div class="Reviews__rating Reviews__rating--portals">
				<div class="flex flex-align-center">
					<span class="Reviews__rating--rating">
						<?= esc_html( meta( 'rating' ) ); ?>
					</span>
					<div class="Reviews__rating--stars">
						<div class="Reviews__rating--stars__fill" style="width:<?= esc_attr( ( meta( 'rating' ) / 5 * 100 ) . '%' ); ?>"></div>
					</div>

					<div class="ComparePlans__tooltip">
						<div class="info-icon"></div>
						<span class="ComparePlans__tooltip__text Pricing__currency__tooltip">
							<?php _e( 'Average rating based on data from trusted review portals', 'reviews' ); ?>
							<?= esc_html( __( 'Rating Last Update:', 'reviews' ) . ' ' . meta( 'last_update' ) ); ?>
						</span>
					</div>
				</div>
				<strong class="Reviews__rating--count Reviews__rating--desc">
					<?= esc_html( meta( 'reviews_count' ) . '&nbsp;' . __( 'reviews', 'reviews' ) ); ?>
				</strong>
			</div>

			<p><?= esc_html( wp_trim_words( meta( 'note' ), 42 ) ); ?></p>
			<h3><?php _e( 'Pricing', 'reviews' ); ?></h3>
			<?= esc_html( __( 'Rating Last Update:', 'reviews' ) . ' ' . meta( 'last_update' ) ); ?>

			<div>
				<?= esc_html( meta( 'currency' ) ); ?>
				<?= esc_html( meta( 'price' ) ); ?>
				<?= esc_html( meta( 'period' ) ); ?>
			</div>
			<div class="flex">
				<strong><?php _e( 'Free trial', 'reviews' ); ?>:</strong> <?= meta( 'free_trial' ); ?>
			</div>
			<div>
				<strong><?php _e( 'Free version', 'reviews' ); ?>:</strong> <?= meta( 'free_version' ); ?>
			</div>
		</div>
		<div class="col-50 Reviews__Gallery">
			<div class="splide Reviews__Gallery--main">
				<div class="splide__track">
					<ul class="splide__list">
						<?php
							$gallery   = meta( 'gallery' );
							$total_img = count( $gallery );
						foreach ( $gallery as $index => $main_img ) {
							?>
						<li class="splide__slide">
							<a class="splide__inn" href="<?= esc_url( wp_get_attachment_image_url( $main_img, 'full' ) ) ?>" data-lightbox="gallery">
								<div class="Reviews__Gallery--main__desc">
									<h5 class="highlight">
									<?= esc_html( get_post_meta( $main_img, '_wp_attachment_image_alt', true ) ); ?>
									<?= ( $index + 1 ) . '/' . $total_img; ?>
									</h5>
									<p><?= esc_html( get_post( $main_img )->post_content ); ?></p>
								</div>
								<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( $main_img, 'blog_archive_thumbnail' ) ) ?>" alt=""/>
							</a>
						</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>

			<div class="splide Reviews__Gallery--thumbs">
				<div class="splide__track">
					<ul class="splide__list">
						<?php 
						foreach ( $gallery as $thumbnail ) {
							?>
						<li class="splide__slide Reviews__Gallery--thumbnail">
							<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( $thumbnail, 'blog_thumbnail' ) ) ?>" alt=""/>
						</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>

			<?php
				set_custom_source( 'common/splide' );
				set_custom_source( 'reviewsGallery', 'js' );
			?>
		</div>
	</div>

	<div class="Block--background--glassy">
		<div class="wrapper__narrow">

		<div class="Reviews__editor">
			<div class="Reviews__editor--titles">
				<div class="tag"><p><?php _e( "Editor's rating", 'reviews' ); ?>: </p></div>
				<h3 class="Reviews__editor--title"><?php _e( "Editor's rating", 'reviews' ); ?></h3>
			</div>

			<div class="Reviews__rating Reviews__rating--editor">
				<div class="Reviews__rating--editor__avatar">
					<?= get_avatar( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() ); ?>
				</div>
				<div class="Reviews__rating--editor__info">
					<strong class="Reviews__rating--desc">
						<?php _e( "Editor's overall Rating", 'reviews' ); ?>
					</strong>
					<div class="flex flex-align-center">
						<span class="Reviews__rating--rating">
							<?= esc_html( $average ); ?>
						</span>
						<div class="Reviews__rating--stars">
							<div class="Reviews__rating--stars__fill" 
							style="width:<?= esc_attr( ( $average / 5 * 100 ) . '%' ); ?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>


			<?php progressbar( 'first_rating', $first, '#FFB928' ); ?>
			<?php progressbar( 'second_rating', $second, '#48C6CE' ); ?>
			<?php progressbar( 'third_rating', $third, '#FF492B' ); ?>
		</div>
	</div>
