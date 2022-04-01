<?php // @codingStandardsIgnoreLine ?>
<div class="Post" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header customer-support-glossary">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">

			<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_related-articles', true ) ) ) { ?>
				<div class="Post__sidebar__related">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
					<?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_related-articles', true ) ) ?>
				</div>
			<?php } ?>

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
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
				<?php } else { ?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-book.svg" alt="<?php _e( 'Glossary', 'ms' ); ?>">
				<?php } ?>
			</div>

			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/customer-support-glossary/', 'ms' ); ?>"><?php _e( 'Customer Support Glossary', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ) { ?>
					<div class="hidden">
						<script type="application/ld+json">
							{
								"@context": "https://schema.org",
								"@type": "FAQPage",
								"mainEntity": [
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ) { ?>
									{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a1', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q2', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q2', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a2', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q3', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q3', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a3', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q4', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q4', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a4', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q5', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q5', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a5', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q6', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q6', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a6', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q7', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q7', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a7', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q8', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q8', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a8', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q9', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q9', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a9', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q10', true ) ) { ?>
									,{
										"@type": "Question",
										"name": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q10', true ) ) ) ); ?>",
										"acceptedAnswer": {
											"@type": "Answer",
											"text": "<?= esc_attr( clean_json( wp_strip_all_tags( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a10', true ) ) ) ); ?>"
										}
									}
									<?php } ?>
								]
							}
						</script>
					</div>

						<div class="Post__m__negative">
							<h2 id="faq"><?php _e( 'FAQ', 'ms' ); ?></h2>

							<div class="ExtraFaq">
								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a1', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q2', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q2', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a2', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q3', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q3', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a3', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q4', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q4', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a4', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q5', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q5', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a5', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q6', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q6', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a6', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q7', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q7', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a7', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q8', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q8', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a8', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q9', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q9', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a9', true ) ); ?></p>
									</div>
								<?php } ?>

								<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q10', true ) ) { ?>
									<div class="ExtraFaq__item">
										<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q10', true ) ); ?></h3>
										<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a10', true ) ); ?></p>
									</div>
								<?php } ?>
							</div>
						</div>
				<?php } ?>

				<div class="Post__m__negative Post__buttons">
					<a href="<?php _e( '/customer-support-glossary/', 'ms' ); ?>" class="Button Button--outline Button--back" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Back to Glossary'])"><span><?php _e( 'Back to Glossary', 'ms' ); ?></span></a>

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
