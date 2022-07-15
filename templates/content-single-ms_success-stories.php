<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_success-stories', $post->ID );

	
	$details = (object) array(
		'website'      => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-website', true ),
		'insta'        => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-insta', true ),
		'fb'           => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-fb', true ),
		'twitter'      => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-twitter', true ),
		'linkedin'     => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-linkedin', true ),
		'yt'           => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-yt', true ),
		'founded'      => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-founded', true ),
		'headquarters' => get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-headquarters', true ),
	);

	$author = (object) array(
		'image'    => get_post_meta( get_the_ID(), 'mb_ss-author_image', true ),
		'name'     => get_post_meta( get_the_ID(), 'mb_ss-author_name', true ),
		'company'  => get_post_meta( get_the_ID(), 'mb_ss-author_position-company', true ),
		'about'    => get_post_meta( get_the_ID(), 'mb_ss-author_about', true ),
		'email'    => get_post_meta( get_the_ID(), 'mb_ss-author_email', true ),
		'phone'    => get_post_meta( get_the_ID(), 'mb_ss-author_phone', true ),
		'linkedin' => get_post_meta( get_the_ID(), 'mb_ss-author_linkedin', true ),
	);

	do_action( 'wpml_switch_language', $current_lang );
	?>

<div class="Post" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header <?= esc_attr( $header_category ); ?>">
		<div class="wrapper__wide has-image">
			<?php 
			if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'wide_image' );
			}
			?>
		</div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">
			<?php
			if ( ! empty( $details->website ) ) {
				?>
			<div class="Post__sidebar__buttons mb-m">
				<a href="<?= esc_url( $details->website ); ?>" class="Button Button--outline" target="_blank">
					<span>
					<?php 
						the_title();
						echo ' ';
						_e( 'website', 'use-case' );
					?>
					</span>
				</a>
			</div>
				<?php
			}
			?>
			<div class="Post__sidebar__socials flex flex-align-center flex-justify-center">
				<?php
				if ( ! empty( $details->insta ) && 'https://www.instagram.com/' !== $details->insta ) {
					?>
					<a href="<?= esc_url( $details->insta ); ?>" class="Post__sidebar__social" target="_blank">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/social_icons/instagram.svg' ); ?>" alt="<?= esc_html( $details->insta ); ?>" />
					</a>
					<?php
				}
				if ( ! empty( $details->fb ) && 'https://www.facebook.com/' !== $details->fb ) {
					?>
					<a href="<?= esc_url( $details->fb ); ?>" class="Post__sidebar__social" target="_blank">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/social_icons/facebook.svg' ); ?>" alt="<?= esc_html( $details->fb ); ?>" />
					</a>
					<?php
				}

				if ( ! empty( $details->twitter ) && 'https://www.twitter.com/' !== $details->twitter ) {
					?>
					<a href="<?= esc_url( $details->twitter ); ?>" class="Post__sidebar__social" target="_blank">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/social_icons/twitter.svg' ); ?>" alt="<?= esc_html( $details->twitter ); ?>" />
					</a>
					<?php
				}
				if ( ! empty( $details->linkedin ) ) {
					?>
					<a href="<?= esc_url( $details->linkedin ); ?>" class="Post__sidebar__social" target="_blank">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/social_icons/linkedin.svg' ); ?>" alt="<?= esc_html( $details->linkedin ); ?>" />
					</a>
					<?php
				}
				if ( ! empty( $details->yt ) && 'https://www.youtube.com/user/' !== $details->yt ) {
					?>
					<a href="<?= esc_url( $details->yt ); ?>" class="Post__sidebar__social" target="_blank">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/social_icons/youtube.svg' ); ?>" alt="<?= esc_html( $details->yt ); ?>" />
					</a>
					<?php
				}
				?>
			</div>
			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Industry', 'ms' ); ?></div>
				<ul class="Post__sidebar__categories__labels blue">
					<?php
					$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_success-stories' );
					$categories = get_the_terms( $current_id, 'ms_success-stories_categories' );

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

			<?php
			if ( isset( $founded ) ) {
				?>
			<div class="Post__sidebar__item">
				<div class="Post__sidebar__title h4"><?php _e( 'Founded', 'ms' ); ?></div>
				<p><?= esc_html( $founded ); ?></p>
			</div>
				<?php
			}
			?>
			<?php
			if ( isset( $headquarters ) ) {
				?>
			<div class="Post__sidebar__item">
				<div class="Post__sidebar__title h4"><?php _e( 'Headquarters', 'ms' ); ?></div>
				<p><?= esc_html( $headquarters ); ?></p>
			</div>
				<?php
			}
			?>

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
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/features/', 'ms' ); ?>"><?php _e( 'Features', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php
				if ( ! empty( $author->name ) ) {
					?>
				<br />
				<br />
				<div class="AuthorCard Post__m__negative--small" itemscope itemprop="author" itemtype="https://schema.org/Person">
					<div class="AuthorCard__image--wrapper">
						<?php
						if ( ! empty( $author->image ) ) {
							?>
						<meta itemprop="image" content="<?= esc_url( $author->image ); ?>"></meta>
							<?php
						}
						?>
						<img class="AuthorCard__image" src="<?=  esc_url( empty( $author->image ) ? get_template_directory_uri() . '/assets/images/author_avatar.svg' : $author->image ) ?>" alt="<?= esc_html( $author->name ); ?>" />
					</div>
					<div class="AuthorCard__content">
						<h3 class="AuthorCard__name" itemprop="name"><?= esc_html( $author->name ); ?></h3>
						<p class="AuthorCard__company" itemprop="jobTitle"><?= esc_html( $author->company ); ?></p>
						<p class="AuthorCard__desc" itemprop="text"><?= esc_html( $author->about ); ?></p>

						<ul class="AuthorCard__contacts">
							<?php if ( ! empty( $author->email ) ) { ?>
							<li class="AuthorCard__contact AuthorCard__contact--email fontello-mail">
								<a href="mailto:<?= esc_url( $author->email ); ?>" title="<?= esc_html( $author->name ); ?> <?= esc_html( $author->company ); ?> by email" itemprop="email"><?php _e( 'Mail', 'use-case' ); ?></a>
							</li>
							<?php } ?>
							<?php if ( ! empty( $author->phone ) ) { ?>
							<li class="AuthorCard__contact AuthorCard__contact--phone fontello-icon-e806">
								<a href="tel:<?= esc_html( $author->phone ); ?>" title="<?= esc_html( $author->name ); ?> <?= esc_html( $author->company ); ?> by phone" itemprop="telephone"><?= esc_html( $author->phone ); ?></a>
							</li>
							<?php } ?>
							<?php if ( ! empty( $author->linkedin ) ) { ?>
							<li class="AuthorCard__contact AuthorCard__contact--linkedin fontello-linkedin-brands">
							<a href="<?= esc_url( $author->linkedin ); ?>" title="<?= esc_html( $author->name ); ?> <?= esc_html( $author->company ); ?> by LinkedIn" target="_blank" itemprop="url">LinkedIn</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
	if ( $categories[0]->count >= 3 ) {
		?>
				<div class="wrapper__wide" style="padding-left: 21em">
					<div class="h2 line-above no-margin"><?php _e( 'Related stories', 'use-case' ); ?></div>
				</div>
				<div class="wrapper">
			<?php
			echo do_shortcode( '[successstories posts=3 category=' . $categories[0]->term_id . ']' );
			?>
				</div>
			<?php
	}
	?>
	<div class="wrapper text-align-center mb-xl">
		<a href="<?php _e( '/use-case-scenarios', 'use-case' ); ?>" class="Button Button--outline">
			<?php _e( 'Check out the rest of the stories', 'use-case' ); ?>
			<svg class="ml-m" width="21" height="15" viewBox="0 0 21 15" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.65 0L12.1695 1.51071L16.9785 6.42857H0V8.57143H16.9785L12.159 13.4893L13.65 15L21 7.5L13.65 0Z"
				/></svg>
		</a>
	</div>
</div>
