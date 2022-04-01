<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_features', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );
?>

<div class="Post" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header <?= esc_attr( $header_category ); ?>">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">
			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Categories', 'ms' ); ?></div>
				<ul class="Post__sidebar__categories__labels">
					<?php
					$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_features' );
					$categories = get_the_terms( $current_id, 'ms_features_categories' );

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
			</div>

			<div class="Post__sidebar__available">
				<div class="Post__sidebar__title h4"><?php _e( 'Available in', 'ms' ); ?></div>
				<ul>
					<?php
					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) as $item ) {
							if ( 'ticket' === $item ) {
								echo "<li class='" . esc_attr( $item ) . "'>" . esc_html( get_option( 'ms_theme_ms_general_ticket' ) ) . '</li>';
							}
							if ( 'ticket-chat' === $item ) {
									echo "<li class='" . esc_attr( $item ) . "'>" . esc_html( get_option( 'ms_theme_ms_general_ticket_chat' ) ) . '</li>';
							}
							if ( 'all-inclusive' === $item ) {
									echo "<li class='" . esc_attr( $item ) . "'>" . esc_html( get_option( 'ms_theme_ms_general_all_inclusive' ) ) . '</li>';
							}
							if ( 'extensions' === $item ) {
									echo "<li class='" . esc_attr( $item ) . "'>" . esc_html( get_option( 'ms_theme_ms_general_extensions' ) ) . '</li>';
							}
						}
					}
					?>
				</ul>
			</div>

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
			<div class="Post__logo Post__logo--features">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
				<?php } else { ?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e( 'Integration', 'ms' ); ?>">
				<?php } ?>
			</div>
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/features/', 'ms' ); ?>"><?php _e( 'Features', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
					<div class="Post__content__resources Post__m__negative">
						<div class="Post__sidebar__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>

						<div class="SimilarSources">
							<?php echo do_shortcode( '[similarsources]' ); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
