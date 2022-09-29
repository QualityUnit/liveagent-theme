<?php // @codingStandardsIgnoreLine ?>

<div class="Reviews__header Reviews__header-level1 FullHeadline">
	<div class="wrapper text-align-center">
		<h2 class="FullHeadline__title">
			<?php _e( '<span class="highlight__bubble">Reviews</span> categories', 'reviews' ); ?>
		</h2>
		<h3 class="FullHeadline__subtitle">
			<?php _e( 'Find out which software in any category is the best option<br />for your business.', 'reviews' ); ?>
		</h3>
	</div>
</div>

<div class="Reviews__categories">
	<div class="wrapper__wide">
		<ul class="Reviews__categories--inn">
			<?php
			$current_id = apply_filters( 'wpml_object_id', $translated_id, 'ms_reviews' );
			$cat_args   = array(
				'taxonomy'   => 'ms_reviews_categories',
				'hide_empty' => 0,
				'orderby'    => 'menu_order',
				'order'      => 'ASC',
			);
			$categories = array_unique( get_categories( $cat_args ), SORT_REGULAR );
			
			if ( $categories ) {
				foreach ( $categories as $category ) {

					$category_icon = get_term_meta( $category->term_id, 'icon', true );
					?>
			<li class="Reviews__categories--category">
				<a class="Reviews__categories--category__link" href="/reviews/<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>">
					<div class="Reviews__categories--category__image">
						<?= wp_get_attachment_image( $category_icon ); ?>
					</div>
						<h3 class="Reviews__categories--category__title">
						<?= esc_html( $category->name ); ?>
					</h3>

					<div class="Reviews__categories--category__reviewsCount">
						<svg viewBox="0 0 16 26"><path d="M7.779 3.052C9.978 1.018 12.897 0 15.892 0v26c-2.995 0-5.914-1.018-8.113-3.052C4.547 19.96.233 15.502.233 13c0-2.502 4.314-6.96 7.546-9.948Z"/></svg>
						<?php
							echo esc_html( $category->category_count );
						if ( 1 === $category->category_count ) {
							echo esc_html( ' ' . __( 'review', 'reviews' ) );
						}
						if ( 1 !== $category->category_count ) {
							echo esc_html( ' ' . __( 'reviews', 'reviews' ) );
						}
						?>
					</div>
				</a>
			</li>
					<?php
				}
			}
			?>
		</ul>
	</div>
</div>
