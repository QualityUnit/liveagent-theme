<?php // @codingStandardsIgnoreLine
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
		<div class="elementor-column elementor-col-50">
			<ul class="Post__sidebar__categories__labels">
				<?php
				$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_reviews' );
				$categories = get_the_terms( $current_id, 'ms_reviews_categories' );

				if ( $categories ) {
					foreach ( $categories as $category ) {
						?>
				<li class="Post__sidebar__link">
					<a href="../#<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>
				</li>
						<?php
					}
				}
				?>
			</ul>

			<p><?= esc_html( meta( 'note' ) ); ?></p>

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
		<div class="elementor-column elementor-col-50">
			<?php
				$how = __( 'How ${product} is doing on review portals', 'reviews' );
				echo esc_html( str_replace( '${product}', get_the_title(), $how ) );
			?>
			<?php 
				$gallery = meta( 'gallery' );

				foreach ( $gallery as $image ) {
					echo wp_get_attachment_image( $image );
				}
			?>
		</div>
	</div>

	<div class="Block--background">
		<div class="wrapper__narrow">
			<h3><?php _e( "Editor's rating", 'reviews' ); ?>: </h3>
			<?php 
				$first_rating  = meta( 'first_rating' );
				$first  = meta( 'first_rating_value' );
				$second_rating = meta( 'second_rating' );
				$second = meta( 'second_rating_value' );
				$third_rating  = meta( 'third_rating' );
				$third  = meta( 'third_rating_value' );

				$average = round( ( $first + $second + $third ) / 3, 1 );

				function progressbar( $rating, $color ) {
				?>
					<div class="progressBar">
						<div class="progressBar__inn" style="background-color: <?= esc_attr( $color ); ?>; width:<?= esc_attr( ( $rating / 5 * 100 ) . '%' ); ?>"></div>
					</div>
				<?php
				}
			?>

			Editor's overall Rating
			<?= get_avatar( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() ); ?>
			<?= esc_html( $average ); ?>

			<?php progressbar( $first, '#FFB928' ); ?>
			<?php progressbar( $second, '#48C6CE' ); ?>
			<?php progressbar( $third, '#FF492B' ); ?>
		</div>
	</div>
