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

<div class="Block--background-glass">
	<div class="wrapper wrapper__extended">
		<h1 class="Blog__header__title"><?php single_cat_title(); ?></h1>

		<div class="Blog__header__navigation">
			<ul class="">
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
				<li class="">
						<?= wp_get_attachment_image( $category_icon ); ?>
					<a href="/ms_reviews_categories/<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>

						<?php
						echo esc_html( $category->category_count );
						if ( 1 === $category->category_count ) {
							echo esc_html( ' ' . __( 'review', 'reviews' ) );
						}
						if ( 1 !== $category->category_count ) {
							echo esc_html( ' ' . __( 'reviews', 'reviews' ) );
						}
						?>
				</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</div>
</div>
