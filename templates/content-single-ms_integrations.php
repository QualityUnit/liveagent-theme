<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_integrations', $post->ID );
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
			<div class="Post__sidebar__buttons">
				<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ) ) { ?>
					<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ) ) ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Native Integration'])" target="_blank">
						<span><?php _e( 'Native Integration', 'ms' ); ?></span>
					</a>
				<?php } ?>
				<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) ) { ?>
					<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - External Integration'])" target="_blank" rel="nofollow" class="Button Button--outline">
						<span><?php _e( 'External Integration', 'ms' ); ?></span>
					</a>
				<?php } ?>
				<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) ) { ?>
					<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Zapier Integration'])" target="_blank" rel="nofollow" class="Button Button--outline">
						<span><?php _e( 'Zapier Integration', 'ms' ); ?></span>
					</a>
				<?php } ?>
			</div>

			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Categories', 'ms' ); ?></div>
				<ul class="Post__sidebar__categories__labels">
					<?php
					$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_integrations' );
					$categories = get_the_terms( $current_id, 'ms_integrations_categories' );

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
					if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) as $item ) {
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
							if ( 'self-hosted' === $item ) {
									echo "<li class='" . esc_attr( $item ) . "'>" . esc_html_e( 'Self-Hosted', 'ms' ) . '</li>';
							}
						}
					}
					?>
				</ul>
			</div>

			<div class="Post__sidebar__partner">
				<div class="Post__sidebar__title h4"><?php _e( 'Partner', 'ms' ); ?></div>
				<ul>
					<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ) { ?>
						<li>
							<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Partner - Learn More'])" target="_blank" rel="nofollow">
								<?php _e( 'Learn More', 'ms' ); ?>
							</a>
						</li>
					<?php } ?>
					<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ) { ?>
						<li>
							<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Partner - Privacy Policy'])" target="_blank" rel="nofollow">
								<?php the_title(); ?> <?php _e( 'Privacy Policy', 'ms' ); ?>
							</a>
						</li>
					<?php } ?>
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
			<div class="Post__logo">
				<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
			</div>

			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/integrations/', 'ms' ); ?>"><?php _e( 'Integrations', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ) { ?>
					<div class="hidden">
						<script type="application/ld+json">
							{
								"@context": "https://schema.org",
								"@type": "FAQPage",
								"mainEntity": [
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ) { ?>
									{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a1', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q2', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q2', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a2', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q3', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q3', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a3', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q4', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q4', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a4', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q5', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q5', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a5', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q6', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q6', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a6', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q7', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q7', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a7', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q8', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q8', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a8', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q9', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q9', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a9', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q10', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q10', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a10', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
								]
							}
						</script>
					</div>

					<div class="Post__m__negative">
						<h2 id="faq"><?php _e( 'FAQ', 'ms' ); ?></h2>

						<div class="Faq">
							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a1', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q2', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q2', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a2', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q3', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q3', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a3', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q4', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q4', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a4', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q5', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q5', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a5', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q6', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q6', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a6', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q7', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q7', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a7', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q8', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q8', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a8', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q9', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q9', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a9', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q10', true ) ) { ?>
								<div class="Faq__item">
									<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q10', true ) ); ?></h3>
									<div class="Faq__outer-wrapper">
										<div class="Faq__inner-wrapper">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a10', true ) ); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>

				<div class="Post__m__negative Post__buttons">
					<a href="<?php _e( '/integrations/', 'ms' ); ?>" class="Button Button--outline Button--back"  onclick="_paq.push(['trackEvent', 'Activity', 'Integrations', 'Back to Integrations'])"><span><?php _e( 'Back to Integrations', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

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
