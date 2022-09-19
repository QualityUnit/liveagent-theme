<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Reviews', 'css' );
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_features', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );

	function meta( $metabox_id ) {
			global $post;
		 return get_post_meta( $post->ID, $metabox_id, true );
	}
?>

<div class="Post" itemscope itemtype="http://schema.org/TechArticle">
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
				<?php the_content(); ?>

				<div class="wp-block-columns">
				<?php
				if ( ! empty( meta( 'pros' ) ) ) {
				?>
				<div class="wp-block-column checklist checklist--pros">
					<h4><?php _e( 'Pros', 'reviews' ); ?></h4>
					<ul>
						<?= preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', meta( 'pros' ) ); ?>
					</ul>
				</div>
				<?php
				}
				if ( ! empty( meta( 'cons' ) ) ) {
					?>
					<div class="wp-block-column checklist checklist--cons">
						<h4><?php _e( 'Cons', 'reviews' ); ?></h4>
						<ul>
							<?= preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', meta( 'cons' ) ); ?>
						</ul>
					</div>
				<?php
				}
				?>
								</div>
				<?php
				if ( ! empty( get_the_author() ) ) {
					$avatar = get_avatar_url( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() );
					?>
				<br />
				<br />
				<div class="AuthorCard Post__m__negative--small" itemscope itemprop="author" itemtype="https://schema.org/Person">
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
	</div>
</div>
