<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Directory', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'components/SidebarTOC', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'reviewsGallery', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );
	$current_lang       = apply_filters( 'wpml_current_language', null );
	$header_en_category = get_en_category( 'ms_reviews', $post->ID );
	$header_category    = get_the_terms( $post->ID, 'ms_reviews_categories' );
	$titleplain         = str_replace( '^', '', get_the_title() );

if ( ! empty( $header_category ) ) {
	$header_category      = array_shift( $header_category );
	$header_category_name = $header_category->name;
	$header_category_slug = $header_category->slug;
}

	do_action( 'wpml_switch_language', $current_lang );

	$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_reviews' );
	$categories = get_the_terms( $current_id, 'ms_reviews_categories' );
if ( $categories ) {
	$category_id   = $categories[0]->term_id;
	$category_name = $categories[0]->name;
	$category_slug = $categories[0]->slug;
};
$page_header_breadcrumb = array(
	array( __( 'Reviews', 'ms' ), __( '/reviews/', 'ms' ) ),
);
if ( isset( $category_slug ) ) {
	$page_header_breadcrumb[] = array( $category_name, __( '/reviews/', 'ms' ) . $category_slug );
}
$page_header_breadcrumb[] = array( $titleplain );
$page_header_args         = array(
	'breadcrumb' => $page_header_breadcrumb,
	'title'      => get_the_title(),
	'update'     => array(
		'label' => __( 'Review Last update:', 'ms' ),
	),
);
$pre_content              = null;
if ( ! empty( meta( 'pros' ) ) || ! empty( meta( 'cons' ) ) ) {
	$pre_content .= '<h2>' . __( 'Key takeaways', 'reviews' ) . '</h2>';
	$pre_content .= '<div class="wp-block-columns">';
	if ( ! empty( meta( 'pros' ) ) ) {
		$pre_content .= '<div class="wp-block-column checklist checklist--pros">';
		$pre_content .= '<h3>' . __( 'Pros', 'reviews' ) . '</h3>';
		$pre_content .= '<ul itemprop="positiveNotes" itemtype="https://schema.org/ItemList" itemscope>';
		$pre_content .= preg_replace( "/(.+?)(\n|$)/", '<li itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope> <meta itemprop="name" content="$1" />$1</li>', meta( 'pros' ) );
		$pre_content .= '</ul>';
		$pre_content .= '</div>';
	}
	if ( ! empty( meta( 'cons' ) ) ) {
		$pre_content .= '<div class="wp-block-column checklist checklist--cons">';
		$pre_content .= '<h3>' . __( 'Cons', 'reviews' ) . '</h3>';
		$pre_content .= '<ul itemprop="negativeNotes" itemtype="https://schema.org/ItemList" itemscope>';
		$pre_content .= preg_replace( "/(.+?)(\n|$)/", '<li itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope> <meta itemprop="name" content="$1" />$1</li>', meta( 'cons' ) );
		$pre_content .= '</ul>';
		$pre_content .= '</div>';
	}
	$pre_content .= '</div>';
}
function meta( $metabox_id ) {
		global $post;
		return get_post_meta( $post->ID, $metabox_id, true );
}
?>

<div class="Post Post--sidebar-right Reviews">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<?php
	require_once get_template_directory() . '/templates/content-single-ms_reviews-top.php';
	?>

	<div class="wrapper Post__container">
		<div class="Post__sidebar urlslab-skip-keywords">
			<?php if ( sidebar_toc() !== false ) { ?>
				<div class="SidebarTOC-wrapper js-sidebar-sticky">
					<div class="SidebarTOC Post__SidebarTOC">
						<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
						<div class="SidebarTOC__slider slider splide">
							<div class="splide__track">
								<ul class="SidebarTOC__content splide__list">
									<?= wp_kses_post( sidebar_toc( $pre_content . apply_filters( 'the_content', strip_shortcodes( get_the_content() ) ) ) ); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="Post__content">
			<div class="Content" itemprop="articleBody">
				<?php if ( $pre_content ) { ?>
					<?= wp_kses_post( $pre_content ); ?>
				<?php } ?>
				<?php the_content(); ?>

				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<?php
				if ( ! empty( meta( 'details_contacts' ) ) ) {
					require_once get_template_directory() . '/templates/content-single-ms_reviews-contacts.php';
				}

				if ( ! empty( meta( 'how_it_works' ) ) ) {
					$how_it_works_id    = meta( 'how_it_works' );
					$how_it_works       = get_post( $how_it_works_id )->post_content;
					$how_it_works_title = get_post( $how_it_works_id )->post_title;
					$how_it_works       = apply_filters( 'the_content', $how_it_works );
					?>

					<?= do_shortcode( '[split-title title="' . $how_it_works_title . '"]' ); ?>
					<div class="mt-xl"></div>
					<?= $how_it_works; // @codingStandardsIgnoreLine ?>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<?php if ( $categories ) { ?>
			<h2 class="text-align-center larger mb-l"><?php _e( 'Product reviews', 'reviews' ); ?></h2>
				<ul class="Reviews__relatedReviews urlslab-skip-all">
				<?php
				$counter              = 0;
				$query_glossary_posts = new WP_Query(
					array(
						'post_type'      => 'ms_reviews',
						// @codingStandardsIgnoreLine
						'posts_per_page' => 500,
						'orderby'        => 'date',
						'order'          => 'ASC',
						'tax_query'      => array( // @codingStandardsIgnoreLine
							array(
								'taxonomy' => 'ms_reviews_categories',
								'field'    => 'term_id',
								'terms'    => $category_id,
							),
						),
					)
				);
				while ( $query_glossary_posts->have_posts() ) :
					$query_glossary_posts->the_post();
					?>
						<li class="Reviews__relatedReviews--post <?= ( get_the_ID() === $current_id ) ? 'active' : ''; ?>" >
							<a class="flex Reviews__relatedReviews--post__inn" href="<?php the_permalink(); ?>" title="<?= esc_attr( str_replace( '^', '', get_the_title() ) ); ?>" itemprop="review" itemscope itemtype="https://schema.org/Review">

								<span itemprop="itemReviewed" itemscope itemtype="https://schema.org/SoftwareApplication">
									<span class="hidden" itemprop="name"><?= esc_html( str_replace( '^', '', get_the_title() ) ); ?></span>
									<meta itemprop="operatingSystem" content="Any" />
									<span itemprop="applicationCategory" content="BusinessApplication"><meta itemprop="name" content="<?= esc_attr( str_replace( '^', '', get_the_title() ) ); ?>"></span>
									<?php
									$first  = get_post_meta( get_the_ID(), 'first_rating_value', true );
									$second = get_post_meta( get_the_ID(), 'second_rating_value', true );
									$third  = get_post_meta( get_the_ID(), 'third_rating_value', true );

									$average = 1;

									if ( ! empty( $first ) && ! empty( $second ) && ! empty( $third ) ) {
										$average = round( ( $first + $second + $third ) / 3, 1 );
									}
									?>
									<div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
										<meta itemprop="ratingValue" content="<?= esc_attr( $average ); ?>" />
										<meta itemprop="ratingCount" content="<?= esc_attr( get_post_meta( get_the_ID(), 'reviews_count', true ) ); ?>" />
									</div>
									<?php
									$rating_post = get_post_meta( get_the_ID(), 'rating', true );
									if ( $rating_post ) {
										?>
									<div itemprop="offers" itemtype="https://schema.org/Offer" itemscope>
										<meta itemprop="priceCurrency" content="USD" />
										<meta itemprop="price" content="<?= esc_attr( is_numeric( get_post_meta( get_the_ID(), 'price', true ) ) ? get_post_meta( get_the_ID(), 'price', true ) : '0' ); ?>" />
									</div>
								<?php } ?>
								</span>
								<span class="hidden" itemprop="author" itemscope itemtype="https://schema.org/Person">
									<span itemprop="name">LiveAgent</span>
								</span>
								<span class="Reviews__relatedReviews--post__number mr-xl-tablet"><?= esc_html( ++$counter ); ?></span>
								<h3 class="Reviews__relatedReviews--post__title" itemprop="name"><?= esc_html( str_replace( '^', '', get_the_title() ) ); ?></h3>
								<?php
									$rating_post = get_post_meta( get_the_ID(), 'rating', true );
								if ( $rating_post ) {
									?>
									<div itemprop="offers" itemtype="https://schema.org/Offer" itemscope>
										<link itemprop="url" href="<?php the_permalink(); ?>" />
										<meta itemprop="priceCurrency" content="USD" />
										<meta itemprop="price" content="<?= esc_attr( is_numeric( get_post_meta( get_the_ID(), 'price', true ) ) ? get_post_meta( get_the_ID(), 'price', true ) : '0' ); ?>" />
									</div>
									<div class="ml-s-tablet mr-ultra-tablet flex flex-align-center" itemscope itemtype="https://schema.org/Rating">
										<span class="mr-s-tablet-landscape" itemprop="ratingValue"><?= esc_html( $rating_post ); ?></span>
										<meta itemprop="reviewCount" content="<?= esc_attr( get_post_meta( get_the_ID(), 'reviews_count', true ) ); ?>" />
										<div class="Reviews__rating--stars mr-m <?= ( get_the_ID() === $current_id ) ? '' : 'grey'; ?>">
											<div class="Reviews__rating--stars__fill"
											style="width:<?= esc_attr( ( $rating_post / 5 * 100 ) . '%' ); ?>"></div>
										</div>
										<span class="mr-xs"><?= esc_html( get_post_meta( get_the_ID(), 'reviews_count', true ) ); ?></span><span><?= esc_html( __( 'reviews', 'reviews' ) ); ?></span>
									</div>

									<?php
								}
								?>
								<div class="Reviews__relatedReviews--post__arrow">
									<svg viewBox="0 0 13 22" fill="white" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.93934 0.93934C1.52513 0.353553 2.47487 0.353553 3.06066 0.93934L12.0339 9.91255C12.6197 10.4983 12.6197 11.4481 12.0339 12.0339L3.06066 21.0071C2.47487 21.5929 1.52513 21.5929 0.93934 21.0071C0.353553 20.4213 0.353553 19.4716 0.93934 18.8858L8.85189 10.9732L0.93934 3.06066C0.353553 2.47487 0.353553 1.52513 0.93934 0.93934Z" />
									</svg>
								</div>
							</a>
						</li>
						<?php
					endwhile;
				?>
					<?php wp_reset_postdata(); ?>
				</ul>
				<script>
					const reviews = document.querySelectorAll('.Reviews__relatedReviews--post:not(.active)');
					reviews.forEach(review => {
						review.addEventListener('mouseenter', () => {
							review.querySelector('.Reviews__rating--stars').classList.remove('grey');
						});
						review.addEventListener('mouseout', () => {
							review.querySelector('.Reviews__rating--stars').classList.add('grey');
						});
					});
				</script>
			<?php } ?>
		<?php
		if ( ! empty( get_the_author() ) ) {
			$avatar = get_avatar_url( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() );
			?>
			<div class="AuthorCard mt-xxxl" itemscope itemprop="author" itemtype="https://schema.org/Person">
				<div class="AuthorCard__image--wrapper">
				<?php
				if ( ! empty( $avatar ) ) {
					?>
					<meta itemprop="image" content="<?= esc_url( $avatar ); ?>"></meta>
						<?php
				}
				?>
					<img class="AuthorCard__image" src="<?= esc_url( empty( $avatar ) ? get_template_directory_uri() . '/assets/images/author_avatar.svg' : esc_url( $avatar ) ); ?>" alt="<?php the_author(); ?>" />
				</div>
				<div class="AuthorCard__content">
					<h3 class="AuthorCard__name" itemprop="name"><?php the_author(); ?></h3>
					<p class="AuthorCard__company" itemprop="jobTitle"><?php _e( 'LiveAgent', 'ms' ); ?></p>
					<p class="AuthorCard__desc" itemprop="text"><?php the_author_meta( 'description' ); ?></p>

					<ul class="AuthorCard__contacts">
					<?php if ( ! empty( get_the_author_meta( 'email' ) ) ) { ?>
						<li class="AuthorCard__contact AuthorCard__contact--email fontello-mail">
							<?php
								$mail_text = __( 'Contact ${author} from LiveAgent by mail', 'use-case' );
								$mail_text = str_replace( '${author}', get_the_author(), $mail_text );
							?>
							<a href="mailto:<?= esc_url( get_the_author_meta( 'email' ) ); ?>" title="<?= esc_attr( $mail_text ); ?>" itemprop="email"><?php _e( 'Mail', 'use-case' ); ?></a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
				<?php
		}
		?>
		<div class="Post__content__resources">
			<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

			<div class="SimilarSources">
				<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
			</div>
		</div>
	</div>
</div>
