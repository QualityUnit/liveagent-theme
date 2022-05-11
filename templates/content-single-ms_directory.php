<?php // @codingStandardsIgnoreLine
	set_source( 'directory', 'pages/Directory', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );
?>
<div class="Post" itemscope itemtype="http://schema.org/Organization">
	<div class="Post__header directory">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">

			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Business Type', 'ms' ); ?></div>
				<div class="Post__sidebar__categories__labels">
				<?php $industry = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_industry', true ); ?>
					<a href="<?php _e( '/industry/', 'ms' ); ?><?= esc_html( $industry ) ?>/" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Industry'])">
					<?php
					if ( 'accounting-legal' === $industry ) {
						_e( 'Accounting & Legal', 'ms' );
					} elseif ( 'automotive' === $industry ) {
						_e( 'Automotive', 'ms' );
					} elseif ( 'banking-insurance' === $industry ) {
						_e( 'Banking & Insurance', 'ms' );
					} elseif ( 'e-commerce-services' === $industry ) {
						_e( 'E-commerce & Services', 'ms' );
					} elseif ( 'entertainment' === $industry ) {
						_e( 'Entertainment', 'ms' );
					} elseif ( 'esports' === $industry ) {
						_e( 'eSports', 'ms' );
					} elseif ( 'fashion' === $industry ) {
						_e( 'Fashion', 'ms' );
					} elseif ( 'healthcare' === $industry ) {
						_e( 'Healthcare', 'ms' );
					} elseif ( 'hr-recruitment' === $industry ) {
						_e( 'HR & Recruitment', 'ms' );
					} elseif ( 'marketing-telecommunications' === $industry ) {
						_e( 'Marketing & TelCo', 'ms' );
					} elseif ( 'construction-real-estate' === $industry ) {
						_e( 'Real Estate', 'ms' );
					} elseif ( 'retail' === $industry ) {
						_e( 'Retail', 'ms' );
					} elseif ( 'saas' === $industry ) {
						_e( 'SaaS', 'ms' );
					} elseif ( 'software-internet' === $industry ) {
						_e( 'Software & Internet', 'ms' );
					} elseif ( 'travel-accommodation' === $industry ) {
						_e( 'Travel & Accommodation', 'ms' );
					} elseif ( 'webhosting' === $industry ) {
						_e( 'Webhosting', 'ms' );
					}
					?>
					</a>

					<?php $business = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_business', true ); ?>
					<a href="<?php _e( '/business/', 'ms' ); ?><?= esc_html( $business ) ?>/" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Business'])">
					<?php
					if ( 'agency' === $business ) {
						_e( 'Agency', 'ms' );
					} elseif ( 'education-ngo' === $business ) {
						_e( 'EDU and NGOs', 'ms' );
					} elseif ( 'government' === $business ) {
						_e( 'Government', 'ms' );
					} elseif ( 'enterprise' === $business ) {
						_e( 'Enterprise', 'ms' );
					} elseif ( 'solo' === $business ) {
						_e( 'Solopreneur', 'ms' );
					} elseif ( 'startups' === $business ) {
						_e( 'Startups and SMBs', 'ms' );
					}
					?>
					</a>
				</div>
			</div>

			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Technologies', 'ms' ); ?></div>
				<div class="Post__sidebar__categories__labels">
				<?php if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) { ?>
					<a href="<?php _e( '/help-desk-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Help Desk Software'])"><?php _e( 'Help Desk Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) { ?>
					<a href="<?php _e( '/ticketing-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Ticketing Software])"><?php _e( 'Ticketing Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) { ?>
					<a href="<?php _e( '/live-chat-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Live Chat Software])"><?php _e( 'Live Chat Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) { ?>
					<a href="<?php _e( '/call-center-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Call Center Software])"><?php _e( 'Call Center Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) || get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) || get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) { ?>
					<a href="<?php _e( '/social-media-customer-service/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Social Media Support])"><?php _e( 'Social Media Support', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) { ?>
					<a href="<?php _e( '/customer-portal-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Customer Portal Software])"><?php _e( 'Customer Portal Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) { ?>
					<a href="<?php _e( '/knowledge-base-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Knowledge Base Software])"><?php _e( 'Knowledge Base Software', 'ms' ); ?></a>
				<?php } if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) { ?>
					<a href="https://www.postaffiliatepro.com/?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Label - Technologies - Affiliate Program])"><?php _e( 'Affiliate Software', 'ms' ); ?></a>
				<?php } ?>
				</div>
			</div>

			<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_business-hours', true ) ) ) { ?>
				<div class="Post__sidebar__related">
					<div class="Post__sidebar__title h4"><?php _e( 'Business Hours', 'ms' ); ?></div>
					<?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_business-hours', true ) ) ?>
				</div>
			<?php } ?>

			<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_address', true ) ) ) { ?>
				<div class="Post__sidebar__related">
					<div class="Post__sidebar__title h4"><?php _e( 'Address', 'ms' ); ?></div>
					<div itemprop="address">
						<?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_address', true ) ) ?>
					</div>
				</div>
			<?php } ?>

			<div class="SidebarTOC-wrapper">
				<div class="SidebarTOC Post__SidebarTOC">
					<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
					<ul class="SidebarTOC__content">
						<li class="SidebarTOC__item"><a href="#customer-service-contacts"><?php _e( 'Customer Service Contacts', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#social-media"><?php _e( 'Social Media Support Contacts', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#sla"><?php _e( 'SLAs & Agreements', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#legal-contacts"><?php _e( 'Legal Contacts', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#other-links"><?php _e( 'Other Links', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#location"><?php _e( 'Location', 'ms' ); ?></a></li>
						<li class="SidebarTOC__item"><a href="#faq"><?php _e( 'FAQ', 'ms' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
		</div>

		<div class="Post__content">
			<div class="Post__logo">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
				<?php } else { ?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e( 'Directory', 'ms' ); ?>">
				<?php } ?>
			</div>

			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/directory/', 'ms' ); ?>"><?php _e( 'Directory', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content">
				<?php
					$declaration = __( 'It looks like you’re trying to reach ${company_name}’s customer service team. Unfortunately, we’re not associated with ${company_name}’s support team. We are two entirely different business organizations. However, to make your life a little easier, we’ve researched ${company_name}’s website and found the following customer support contact details. Please get in contact with ${company_name}’s representatives by reaching out to them directly using the contact information below.', 'ms' );
					$declaration = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $declaration );
				?>

				<p><?= esc_html( $declaration ); ?></p>

				<div class="Directory__blocks">
					<?php
						$csc_title = __( '${company_name} Customer Service Contacts', 'ms' );
						$csc_title = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_title );
					?>
					<h2 id="customer-service-contacts" class="Directory__blocks__title"><span><?php echo esc_html( $csc_title ); ?></span></h2>

					<?php
						$csc_email_support = __( 'Contact ${company_name} customer support by email', 'ms' );
						$csc_email_support = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_email_support );

						$csc_chat_support = __( 'Chat with ${company_name} representative', 'ms' );
						$csc_chat_support = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_chat_support );

						$csc_call_support = __( 'Call with ${company_name} support', 'ms' );
						$csc_call_support = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_call_support );

						$csc_knowledge_base_support = __( 'Learn more about ${company_name} products', 'ms' );
						$csc_knowledge_base_support = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_knowledge_base_support );

						$csc_forum_support = __( 'Participate in ${company_name}’s community forum discussions', 'ms' );
						$csc_forum_support = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_forum_support );
					?>

					<div class="Directory__blocks__items">
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-ticket.svg" alt="<?php echo esc_attr( $csc_email_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Email Support', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_email_support ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Email Support'])"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><a itemprop="email" href="mailto:<?= esc_attr( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?>" title="<?php echo esc_attr( $csc_email_support ); ?>"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?></a></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-live-chat.svg" alt="<?php echo esc_attr( $csc_chat_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Live Chat Support', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_chat_support ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Live Chat Support'])"><?php _e( 'Live Chat Button on Website', 'ms' ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-call-center.svg" alt="<?php echo esc_attr( $csc_call_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Call Center Support', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_call_support ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Call Center Support'])"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><a itemprop="telephone" href="tel:<?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?>" title="<?php echo esc_attr( $csc_call_support ); ?>"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?></a></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-knowledge-base.svg" alt="<?php echo esc_attr( $csc_knowledge_base_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Knowledge Base', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_knowledge_base_support ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Knowledge Base'])"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-forum.svg" alt="<?php echo esc_attr( $csc_forum_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Forum', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_forum_support ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Forum'])"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="social-media" class="Directory__blocks__title"><span><?php _e( 'Social Media Support Contacts', 'ms' ); ?></span></h2>

					<?php
						$csc_instagram = __( '${company_name} Instagram', 'ms' );
						$csc_instagram = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_instagram );

						$csc_facebook = __( '${company_name} Facebook Page', 'ms' );
						$csc_facebook = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_facebook );

						$csc_twitter = __( '${company_name} Twitter', 'ms' );
						$csc_twitter = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_twitter );
					?>

					<div class="Directory__blocks__items">
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-instagram.svg" alt="<?php echo esc_attr( $csc_instagram ); ?>">
							<h3><?php echo esc_html( $csc_instagram ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ), 'http' ) !== false ) { ?>
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_instagram ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Instagram'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-facebook.svg" alt="<?php echo esc_attr( $csc_facebook ); ?>">
							<h3><?php echo esc_html( $csc_facebook ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ), 'http' ) !== false ) { ?>
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_facebook ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Facebook'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-twitter.svg" alt="<?php echo esc_attr( $csc_twitter ); ?>">
							<h3><?php echo esc_html( $csc_twitter ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ), 'http' ) !== false ) { ?>
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_twitter ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Twitter'])"><?= esc_html( str_replace( 'https://', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="sla" class="Directory__blocks__title"><span><?php _e( 'SLAs & Agreements', 'ms' ); ?></span></h2>

					<?php
						$email_sla = __( '${company_name} support agents usually replies to email within ', 'ms' );
						$email_sla = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $email_sla );

						$livechat_sla = __( '${company_name} live agents usually pick up chats within ', 'ms' );
						$livechat_sla = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $livechat_sla );

						$callcenter_sla = __( '${company_name} call representatives usually pick up calls within ', 'ms' );
						$callcenter_sla = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $callcenter_sla );

						$forum_sla = __( '${company_name} support agents usually replies on forum within ', 'ms' );
						$forum_sla = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $forum_sla );
					?>

					<div class="Directory__blocks__items">
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-ticket.svg" alt="<?php _e( 'Directory', 'ms' ); ?>">
							<h3><?php _e( 'Email SLA', 'ms' ); ?></h3>
							<?php if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-sla', true ) === 'na' ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><?= esc_html( $email_sla ); ?>
								<?php
								$time = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-sla', true );

								if ( 'na' === $time ) {
									_e( 'N/A', 'ms' );
								} elseif ( '15min' === $time ) {
									_e( '15 Minutes', 'ms' );
								} elseif ( '30min' === $time ) {
									_e( '30 Minutes', 'ms' );
								} elseif ( '1h' === $time ) {
									_e( '1 Hour', 'ms' );
								} elseif ( '6h' === $time ) {
									_e( '6 Hours', 'ms' );
								} elseif ( '12h' === $time ) {
									_e( '12 Hours', 'ms' );
								} elseif ( '1d' === $time ) {
									_e( '1 Day', 'ms' );
								} elseif ( '2d' === $time ) {
									_e( '2 Days', 'ms' );
								} elseif ( '3d' === $time ) {
									_e( '3 Days', 'ms' );
								} elseif ( '1w' === $time ) {
									_e( '1 Week', 'ms' );
								} elseif ( '1mo' === $time ) {
									_e( '1 Month', 'ms' );
								}
								?>
								.</p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-live-chat.svg" alt="<?php _e( 'Directory', 'ms' ); ?>">
							<h3><?php _e( 'Live Chat SLA', 'ms' ); ?></h3>
							<?php if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-sla', true ) === 'na' ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><?= esc_html( $livechat_sla ); ?>
								<?php
								$time = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-sla', true );

								if ( 'na' === $time ) {
									_e( 'N/A', 'ms' );
								} elseif ( '15min' === $time ) {
									_e( '15 Minutes', 'ms' );
								} elseif ( '30min' === $time ) {
									_e( '30 Minutes', 'ms' );
								} elseif ( '1h' === $time ) {
									_e( '1 Hour', 'ms' );
								} elseif ( '6h' === $time ) {
									_e( '6 Hours', 'ms' );
								} elseif ( '12h' === $time ) {
									_e( '12 Hours', 'ms' );
								} elseif ( '1d' === $time ) {
									_e( '1 Day', 'ms' );
								} elseif ( '2d' === $time ) {
									_e( '2 Days', 'ms' );
								} elseif ( '3d' === $time ) {
									_e( '3 Days', 'ms' );
								} elseif ( '1w' === $time ) {
									_e( '1 Week', 'ms' );
								} elseif ( '1mo' === $time ) {
									_e( '1 Month', 'ms' );
								}
								?>
								.</p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-call-center.svg" alt="<?php _e( 'Directory', 'ms' ); ?>">
							<h3><?php _e( 'Call Center SLA', 'ms' ); ?></h3>
							<?php if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-sla', true ) === 'na' ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><?= esc_html( $callcenter_sla ); ?>
								<?php
								$time = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-sla', true );

								if ( 'na' === $time ) {
									_e( 'N/A', 'ms' );
								} elseif ( '15min' === $time ) {
									_e( '15 Minutes', 'ms' );
								} elseif ( '30min' === $time ) {
									_e( '30 Minutes', 'ms' );
								} elseif ( '1h' === $time ) {
									_e( '1 Hour', 'ms' );
								} elseif ( '6h' === $time ) {
									_e( '6 Hours', 'ms' );
								} elseif ( '12h' === $time ) {
									_e( '12 Hours', 'ms' );
								} elseif ( '1d' === $time ) {
									_e( '1 Day', 'ms' );
								} elseif ( '2d' === $time ) {
									_e( '2 Days', 'ms' );
								} elseif ( '3d' === $time ) {
									_e( '3 Days', 'ms' );
								} elseif ( '1w' === $time ) {
									_e( '1 Week', 'ms' );
								} elseif ( '1mo' === $time ) {
									_e( '1 Month', 'ms' );
								}
								?>
								.</p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-forum.svg" alt="<?php _e( 'Directory', 'ms' ); ?>">
							<h3><?php _e( 'Forum SLA', 'ms' ); ?></h3>
							<?php if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum-sla', true ) === 'na' ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } else { ?>
								<p><?= esc_html( $forum_sla ); ?>
								<?php
								$time = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum-sla', true );

								if ( 'na' === $time ) {
									_e( 'N/A', 'ms' );
								} elseif ( '15min' === $time ) {
									_e( '15 Minutes', 'ms' );
								} elseif ( '30min' === $time ) {
									_e( '30 Minutes', 'ms' );
								} elseif ( '1h' === $time ) {
									_e( '1 Hour', 'ms' );
								} elseif ( '6h' === $time ) {
									_e( '6 Hours', 'ms' );
								} elseif ( '12h' === $time ) {
									_e( '12 Hours', 'ms' );
								} elseif ( '1d' === $time ) {
									_e( '1 Day', 'ms' );
								} elseif ( '2d' === $time ) {
									_e( '2 Days', 'ms' );
								} elseif ( '3d' === $time ) {
									_e( '3 Days', 'ms' );
								} elseif ( '1w' === $time ) {
									_e( '1 Week', 'ms' );
								} elseif ( '1mo' === $time ) {
									_e( '1 Month', 'ms' );
								}
								?>
								.</p>
							<?php } ?>
						</div>
					</div>

					<h2 id="legal-contacts" class="Directory__blocks__title"><span><?php _e( 'Legal Contacts', 'ms' ); ?></span></h2>

					<?php
						$legal_terms = __( '${company_name} Terms & Conditions', 'ms' );
						$legal_terms = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $legal_terms );

						$legal_privacy = __( '${company_name} Privacy Policy', 'ms' );
						$legal_privacy = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $legal_privacy );

						$legal_security = __( '${company_name} Security Policy', 'ms' );
						$legal_security = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $legal_security );

						$legal_gdpr = __( '${company_name} GDPR', 'ms' );
						$legal_gdpr = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $legal_gdpr );
					?>

					<div class="Directory__blocks__items">
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-terms-conditions.svg" alt="<?= esc_attr( $legal_terms ); ?>">
							<h3><?= esc_html( $legal_terms ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_terms ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Terms & Conditions'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-privacy-policy.svg" alt="<?= esc_attr( $legal_privacy ); ?>">
							<h3><?= esc_html( $legal_privacy ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_privacy ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Privacy Policy'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-security-policy.svg" alt="<?= esc_attr( $legal_security ); ?>">
							<h3><?= esc_html( $legal_security ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_security ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Security Policy'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-gdpr.svg" alt="<?= esc_attr( $legal_gdpr ); ?>">
							<h3><?= esc_html( $legal_gdpr ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_gdpr ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - GDPR'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="other-links" class="Directory__blocks__title"><span><?php _e( 'Other Links', 'ms' ); ?></span></h2>

					<?php
						$others_affiliate = __( '${company_name} Affiliate Program', 'ms' );
						$others_affiliate = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $others_affiliate );

						$others_wikipedia = __( '${company_name} Wikipedia Page', 'ms' );
						$others_wikipedia = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $others_wikipedia );
					?>

					<div class="Directory__blocks__items">
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-knowledge-base.svg" alt="<?= esc_attr( $others_wikipedia ); ?>">
							<h3><?= esc_html( $others_wikipedia ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $others_wikipedia ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Wikipedia'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-affiliate-program.svg" alt="<?= esc_attr( $others_affiliate ); ?>">
							<h3><?= esc_html( $others_affiliate ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $others_affiliate ); ?>" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Directory <?php the_title(); ?> - Button - Affiliate Program'])"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_location', true ) ) ) { ?>
					<div class="Post__m__negative">
						<h2 id="location" class="Directory__blocks__title"><span><?php _e( 'Location', 'ms' ); ?></span></h2>

						<div class="Directory__blocks__items">
							<?= wp_kses(
								get_post_meta( get_the_ID(), 'mb_directory_mb_directory_location', true ),
								array(
									'iframe' => array(
										'src'             => array(),
										'width'           => array(),
										'height'          => array(),
										'frameborder'     => array(),
										'style'           => array(),
										'allowfullscreen' => array(),
										'aria-hidden'     => array(),
										'tabindex'        => array(),
									),
								)
							) ?>
						</div>
					</div>
				<?php } ?>
				<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-q1', true ) ) ) { ?>
						<div class="Post__m__negative Faq" itemscope itemtype="https://schema.org/FAQPage">
							<h2 id="faq">
							<?php
								$headline = __( 'Frequently asked questions', 'ms' );
								$words    = explode( ' ', $headline );
								$counter  = 0;
							foreach ( $words as $word ) {
								if ( 0 === $counter ) {
									echo '<span class="highlight">' . esc_html( $words[0] ) . '</span>';
								} else {
									echo ' ';
									echo esc_html( $word );
								}
								$counter++;
							}
							echo '</h2>';
							if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-text', true ) ) {
								?>
								<div class="subhead--wrapper">
									<p class="subhead"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-text', true ) ); ?></p>
								</div>
								<?php
							} 
							for ( $i = 1; $i <= 15; ++$i ) {
								if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-q' . $i, true ) && get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-a' . $i, true ) ) {
									?>
									<div class="Faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
										<h3 itemprop="name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-q' . $i, true ) ); ?></h3>
										<div class="Faq__outer-wrapper" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
											<div class="Faq__inner-wrapper" itemprop="text">
												<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_faq-a' . $i, true ) ); ?></p>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					<?php } ?>

					<div class="Post__m__negative Post__buttons">
						<a href="<?php _e( '/directory/', 'ms' ); ?>" class="Button Button--outline Button--back"  onclick="_paq.push(['trackEvent', 'Activity', 'Directory', 'Back to Directory'])"><span><?php _e( 'Back to Directory', 'ms' ); ?></span></a>
						<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
							<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
						</a>
					</div>
			</div>
		</div>
	</div>
</div>
