<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Reviews', 'css' );
	set_custom_source( 'common/splide' );
	set_custom_source( 'reviewsGallery', 'js' );
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_reviews', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );

	$current_id     = apply_filters( 'wpml_object_id', $post->ID, 'ms_reviews' );
		$categories = get_the_terms( $current_id, 'ms_reviews_categories' );
if ( $categories ) {
	$category_id   = $categories[0]->term_id;
	$category_name = $categories[0]->name;
	$category_slug = $categories[0]->slug;
};

function meta( $metabox_id ) {
		global $post;
		return get_post_meta( $post->ID, $metabox_id, true );
}
?>

<div class="Post Reviews" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<?php
	require_once get_template_directory() . '/templates/content-single-ms_reviews-top.php';
	?>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">

			<?php if ( sidebar_toc() !== false ) { ?>
				<div class="SidebarTOC-wrapper">
					<div class="SidebarTOC Post__SidebarTOC">
						<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
						<div class="SidebarTOC__slider slider splide">
							<div class="splide__track">
								<ul class="SidebarTOC__content splide__list">
									<?= wp_kses_post( sidebar_toc() ); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
		</div>

		<div class="Post__content">

			<div class="Content" itemprop="articleBody">
				<div class="wp-block-columns">
					<?php
					if ( ! empty( meta( 'pros' ) ) ) {
						?>
					<div class="wp-block-column checklist checklist--pros">
						<h4><?php _e( 'Pros', 'reviews' ); ?></h4>
						<ul>
							<?= preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', meta( 'pros' ) ); // @codingStandardsIgnoreLine?>
						</ul>
					</div>
						<?php
					}
					if ( ! empty( meta( 'cons' ) ) ) {
						?>
						<div class="wp-block-column checklist checklist--cons">
							<h4><?php _e( 'Cons', 'reviews' ); ?></h4>
							<ul>
								<?= preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', meta( 'cons' ) ); // @codingStandardsIgnoreLine?>
							</ul>
						</div>
						<?php
					}
					?>
				</div>

				<?php the_content(); ?>

			</div>
		</div>
	</div>

	<div class="wrapper">
		<?php if ( $categories ) { ?>
			<h2 class="text-align-center larger mb-l"><?php _e( 'Product reviews', 'reviews' ); ?></h2>
				<ul class="Reviews__relatedReviews">
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
						<li class="Reviews__relatedReviews--post <?= ( get_the_ID() === $current_id ) ? 'active' : '' ?>">
							<a class="flex Reviews__relatedReviews--post__inn" href="<?php the_permalink(); ?>" title="<?= esc_attr( str_replace( '^', '', get_the_title() ) ) ?>">
								<span class="Reviews__relatedReviews--post__number mr-xl-tablet"><?= esc_html( ++$counter ); ?></span>
								<h3 class="Reviews__relatedReviews--post__title"><?= esc_html( str_replace( '^', '', get_the_title() ) ); ?></h3>
								<?php
									$rating_post = get_post_meta( get_the_ID(), 'rating', true );
								if ( $rating_post ) {
									?>
									<span class="mr-s-tablet-landscape"><?= esc_html( $rating_post ); ?></span>
									<div class="Reviews__rating--stars <?= ( get_the_ID() === $current_id ) ? '' : 'grey' ?>">
										<div class="Reviews__rating--stars__fill" 
										style="width:<?= esc_attr( ( $rating_post / 5 * 100 ) . '%' ); ?>"></div>
									</div>
									<span class="ml-s-tablet mr-ultra-tablet"><?= esc_html( get_post_meta( get_the_ID(), 'reviews_count', true ) . ' ' . __( 'reviews', 'reviews' ) ); ?></span>
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
					<img class="AuthorCard__image" src="<?=  esc_url( empty( $avatar ) ? get_template_directory_uri() . '/assets/images/author_avatar.svg' : esc_url( $avatar ) ); ?>" alt="<?php the_author(); ?>" />
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
		<div class="Post__content__resources Post__m__negative">
			<div class="Post__sidebar__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>

			<div class="SimilarSources">
				<?php echo do_shortcode( '[urlslab-related-resources]' ); ?>
			</div>
		</div>
	</div>
</div>
