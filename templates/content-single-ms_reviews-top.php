<?php // @codingStandardsIgnoreLine
	$first  = meta( 'first_rating_value' );
	$second = meta( 'second_rating_value' );
	$third  = meta( 'third_rating_value' );

	$average = round( ( $first + $second + $third ) / 3, 1 );

	$avatar_image = get_template_directory_uri() . '/assets/images/author_avatar.svg';

	$rating_update = new DateTime( meta( 'last_update' ) );

function progressbar( $text, $rating, $color ) {
	?>
		<div class="progressBar__wrapper">
			<strong class="progressBar__desc"><?= esc_html( meta( $text ) ); ?></strong>
			<div class="progressBar">
				<div class="progressBar__inn" style="background-color: <?= esc_attr( $color ); ?>; width:<?= esc_attr( ( $rating / 5 * 103.3 ) . '%' ); ?>"></div>
			</div>
			<strong class="progressBar__rating"><?= esc_html( $rating ); ?></strong>
		</div>
	<?php
}
?>

	<div class="Post__header  Reviews__header Reviews__header--post <?= esc_attr( $header_category ); ?>">
		<div class="wrapper flex flex-direction-column">
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/reviews/', 'ms' ); ?>"><?php _e( 'Reviews', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<div class="flex flex-align-center Reviews__header--post__bottom">
				<h1 class="Reviews__header--post__title" itemprop="name"><?php the_title(); ?></h1>
				<time class="Reviews__update" itemprop="dateModified" content="<?= esc_attr( get_the_modified_time( 'F j, Y' ) ); ?>"> 
					<?= esc_html( __( 'Review Last update:', 'reviews' ) . ' ' ); ?>
					<em><?= esc_html( get_the_modified_time( 'F j, Y' ) ); ?></em>
				</time>
			</div>
		</div>
	</div>

	<div class="wrapper flex-tablet-landscape mb-extreme">
		<div class="col-50 Reviews__info">
			<?php
			$review_in = __( '${product} review is included in:', 'reviews' );
			?>
			<small class="text-light"><?= esc_html( str_replace( '${product}', get_the_title(), $review_in ) ); ?></small>
			<ul class="Post__sidebar__categories__labels">
				<?php
				$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_reviews' );
				$categories = get_the_terms( $current_id, 'ms_reviews_categories' );

				if ( $categories ) {
					foreach ( $categories as $category ) {
						?>
				<li class="Post__sidebar__link mr-s">
					<a href="../../<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>
				</li>
						<?php
					}
				}
				?>
			</ul>
			<?php
				$how = __( 'How ${product} is doing on review portals', 'reviews' );
			?>
			<small class="text-light"><?= esc_html( str_replace( '${product}', get_the_title(), $how ) ); ?></small>

			<div class="Reviews__rating Reviews__rating--portals">
				<div class="flex flex-align-center">
					<span class="Reviews__rating--rating">
						<?= esc_html( meta( 'rating' ) ); ?>
					</span>
					<div class="Reviews__rating--stars">
						<div class="Reviews__rating--stars__fill" style="width:<?= esc_attr( ( meta( 'rating' ) / 5 * 100 ) . '%' ); ?>"></div>
					</div>

					<div class="ComparePlans__tooltip Reviews__rating--tooltip">
						<div class="info-icon"></div>
						<span class="ComparePlans__tooltip__text Reviews__rating--tooltip__text">
							<?php _e( 'Average rating based on data from trusted review portals', 'reviews' ); ?>

							<time class="Reviews__update fit" itemprop="dateModified" content="<?= esc_attr( $rating_update->format( 'F j, Y' ) ); ?>" datetime="<?= esc_attr( $rating_update->format( 'F j, Y' ) ); ?>"> 

								<?= esc_html( __( 'Rating Last Update:', 'reviews' ) . ' ' . $rating_update->format( 'F j, Y' ) ); ?>
							</time>
						</span>
					</div>
				</div>
				<strong class="Reviews__rating--count Reviews__rating--desc">
					<?= esc_html( meta( 'reviews_count' ) . '&nbsp;' . __( 'reviews', 'reviews' ) ); ?>
				</strong>
			</div>

			<p><?= esc_html( wp_trim_words( meta( 'note' ), 42 ) ); ?></p>

			<div class="flex">
				<h3 class="no-margin mr-s"><?php _e( 'Pricing', 'reviews' ); ?></h3>
				<time class="Reviews__update small text-light" itemprop="dateModified" content="<?= esc_attr( $rating_update->format( 'F j, Y' ) ); ?>" datetime="<?= esc_attr( $rating_update->format( 'F j, Y' ) ); ?>"> 
					<?= esc_html( __( 'Rating Last Update:', 'reviews' ) . ' ' . $rating_update->format( 'F j, Y' ) ); ?>
				</time>
			</div>

			<div class="flex-tablet Reviews__info--details mt-xs">
				<strong class="Reviews__info--desc mt-s"><?php _e( 'Starting from', 'reviews' ); ?>:</strong>
				<div>
					<div class="Reviews__info--pricing">
						<strong class="currency"><?= esc_html( meta( 'currency' ) ); ?></strong>
						<strong class="price"><?= esc_html( meta( 'price' ) ); ?></strong>
						<span class="text-light">
							&nbsp;
							<?= esc_html( meta( 'period' ) ); ?>
						</span>
					</div>

					<?php 
							$plan = meta( 'equal_la_plan' );

							$free        = __( "Equal to LiveAgent's Free plan", 'reviews' );
							$ticket      = __( "Equal to LiveAgent's Ticket plan", 'reviews' );
							$ticket_chat = __( "Equal to LiveAgent's Ticket + Chat plan", 'reviews' );
							$all         = __( "Equal to LiveAgent's All Inclusive plan", 'reviews' );
							$la_pricing  = __( 'Liveagent pricing', 'reviews' );

							$la_pricing_url = __( '/pricing', 'reviews' );

					if ( isset( $plan ) ) {
						?>
					<div class="Reviews__equalPlan mt-m">
						<div class="alert-icon"></div>
						<div class="Reviews__equalPlan--text">
							<?= esc_html( ${$plan} ); ?>
							<a class="Reviews__equalPlan--pricing" href="<?= esc_url( $la_pricing_url ); ?>"><?= esc_html( $la_pricing ); ?></a>
						</div>
					</div>
						<?php
					}
					?>
				</div>
			</div>


			<div class="flex-tablet Reviews__info--details mt-xs">
				<strong class="Reviews__info--desc"><?php _e( 'Free trial', 'reviews' ); ?>:</strong> <span class="text-light"><?= esc_html( meta( 'free_trial' ) ? ucfirst( meta( 'free_trial' ) ) : __( 'No', 'reviews' ) ); ?></span>
			</div>
			<div class="flex-tablet Reviews__info--details mt-xs">
				<strong class="Reviews__info--desc"><?php _e( 'Free version', 'reviews' ); ?>:</strong> <span class="text-light"><?= esc_html( meta( 'free_version' ) ? ucfirst( meta( 'free_version' ) ) : __( 'No', 'reviews' ) ); ?></span>
			</div>
		</div>
		<div class="col-50 ml-xxxl-tablet-landscape Reviews__Gallery">
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
									<?= esc_html( ( $index + 1 ) . '/' . $total_img ); ?>
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
		</div>
	</div>

	<div class="Reviews__editor">
		<div class="wrapper__narrow">

		<div class="Reviews__editor--top">
			<div class="Reviews__editor--titles">
				<div class="tag"><p><?php _e( "Editor's rating", 'reviews' ); ?>: </p></div>
				<h3 class="Reviews__editor--title"><?php _e( "Editor's rating", 'reviews' ); ?></h3>
			</div>

			<div class="Reviews__rating Reviews__rating--editor">
				<div class="Reviews__rating--avatar">
					<?= get_avatar( get_the_author_meta( 'ID' ), 220, 'mystery', get_the_author() ); ?>
				</div>
				<div class="Reviews__rating--editor__info">
					<strong class="Reviews__rating--desc">
						<?php _e( "Editor's overall Rating", 'reviews' ); ?>
					</strong>
					<div class="flex flex-align-center">
						<span class="Reviews__rating--rating">
							<?= esc_html( $average ); ?>
						</span>
						<div class="Reviews__rating--stars white">
							<div class="Reviews__rating--stars__fill" 
							style="width:<?= esc_attr( ( $average / 5 * 103.3 ) . '%' ); ?>"></div>
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
