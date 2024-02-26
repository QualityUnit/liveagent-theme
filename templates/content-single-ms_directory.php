<?php // @codingStandardsIgnoreLine
set_source( 'directory', 'pages/Directory', 'css' );
set_custom_source( 'common/splide', 'css' );
set_custom_source( 'components/SidebarTOC' );
set_custom_source( 'splide', 'js' );
set_custom_source( 'sidebar_toc', 'js' );
global $post;
$screenshot = do_shortcode( "[urlslab-screenshot alt='" . esc_attr( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ) . " Homepage' url='" . esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ) . "' ]" );

$industry = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_industry', true );
$business = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_business', true );

$page_header_tags                       = array();
$page_header_tags[0]['title']           = __( 'Business Type', 'ms' );
$page_header_tags[0]['list'][0]['href'] = __( '/industry/', 'ms' ) . $industry . '/';
if ( 'accounting-legal' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Accounting & Legal', 'ms' );
} elseif ( 'automotive' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Automotive', 'ms' );
} elseif ( 'banking-insurance' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Banking & Insurance', 'ms' );
} elseif ( 'e-commerce-services' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'E-commerce & Services', 'ms' );
} elseif ( 'entertainment' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Entertainment', 'ms' );
} elseif ( 'esports' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'eSports', 'ms' );
} elseif ( 'fashion' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Fashion', 'ms' );
} elseif ( 'healthcare' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Healthcare', 'ms' );
} elseif ( 'hr-recruitment' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'HR & Recruitment', 'ms' );
} elseif ( 'marketing-telecommunications' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Marketing & TelCo', 'ms' );
} elseif ( 'construction-real-estate' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Real Estate', 'ms' );
} elseif ( 'retail' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Retail', 'ms' );
} elseif ( 'saas' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'SaaS', 'ms' );
} elseif ( 'software-internet' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Software & Internet', 'ms' );
} elseif ( 'travel-accommodation' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Travel & Accommodation', 'ms' );
} elseif ( 'webhosting' === $industry ) {
	$page_header_tags[0]['list'][0]['title'] = __( 'Webhosting', 'ms' );
}
$page_header_tags[0]['title']           = __( 'Business Type', 'ms' );
$page_header_tags[0]['list'][1]['href'] = __( '/business/', 'ms' ) . $business . '/';
if ( 'agency' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'Agency', 'ms' );
} elseif ( 'education-ngo' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'EDU and NGOs', 'ms' );
} elseif ( 'government' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'Government', 'ms' );
} elseif ( 'enterprise' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'Enterprise', 'ms' );
} elseif ( 'solo' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'Solopreneur', 'ms' );
} elseif ( 'startups' === $business ) {
	$page_header_tags[0]['list'][1]['title'] = __( 'Startups and SMBs', 'ms' );
}
$page_header_tags[1]['title'] = __( 'Technologies', 'ms' );
if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/help-desk-software/', 'ms' ),
		'title' => __( 'Help Desk Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/ticketing-software/', 'ms' ),
		'title' => __( 'Ticketing Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/live-chat-software/', 'ms' ),
		'title' => __( 'Live Chat Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/call-center-software/', 'ms' ),
		'title' => __( 'Call Center Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) || get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) || get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/social-media-customer-service/', 'ms' ),
		'title' => __( 'Social Media Support', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/customer-portal-software/', 'ms' ),
		'title' => __( 'Customer Portal Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'  => __( '/knowledge-base-software/', 'ms' ),
		'title' => __( 'Knowledge Base Software', 'ms' ),
	);
} if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) {
	$page_header_tags[1]['list'][] = array(
		'href'   => 'https://www.postaffiliatepro.com/?utm_medium=referral&utm_source=liveagent&utm_campaign=directory',
		'title'  => __( 'Affiliate Software', 'ms' ),
		'target' => '_blank',
		'rel'    => 'nofollow',
	);
}

$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-custom-post_type.svg',
	'alt' => __( 'Directory', 'ms' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( 'logo_thumbnail' );
}

$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_directory.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo'  => $page_header_logo,
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
	'tags'  => $page_header_tags,
	'toc'   => array(
		'items' => array(
			array(
				'id'    => 'customer-service-contacts',
				'title' => __( 'Customer Service Contacts', 'ms' ),
			),
			array(
				'href'  => 'social-media',
				'title' => __( 'Social Media Support Contacts', 'ms' ),
			),
			array(
				'id'    => 'sla',
				'title' => __( 'SLAs & Agreements', 'ms' ),
			),
			array(
				'id'    => 'legal-contacts',
				'title' => __( 'Legal Contacts', 'ms' ),
			),
			array(
				'id'    => 'other-links',
				'title' => __( 'Other Links', 'ms' ),
			),
			array(
				'id'    => 'location',
				'title' => __( 'Location', 'ms' ),
			),
			array(
				'id'    => 'faq',
				'title' => __( 'FAQ', 'ms' ),
			),
		),
	),
);
?>
<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/Organization">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
		<div class="Post__content">
			<div class="Content">
				<?php
					$declaration = __( 'It looks like you’re trying to reach ${company_name}’s customer service team. Unfortunately, we’re not associated with ${company_name}’s support team. We are two entirely different business organizations. However, to make your life a little easier, we’ve researched ${company_name}’s website and found the following customer support contact details. Please get in contact with ${company_name}’s representatives by reaching out to them directly using the contact information below.', 'ms' );
					$declaration = str_replace( '${company_name}’s website', '<a href="' . esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ) . '" title="' . esc_attr( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ) . ' Homepage">${company_name}’s website</a>', $declaration );
					$declaration = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $declaration );
				?>

				<p><?= $declaration; // phpcs:ignore ?></p>

				<?php
				if ( preg_match( '/\<img/', $screenshot ) ) {
					?>
				<a class="Directory__screenshot urlslab-skip-lazy" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ); ?>" target="_blank" rel="nofollow" title="<?= esc_attr( __( 'Go to', 'ms' ) . ' ' . get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ); ?>">
					<div class="Directory__screenshot--url">
					<?= esc_html( __( 'Go to', 'ms' ) . ' ' . get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ); ?>
					</div>
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/browser_window.svg' ); ?>" alt="<?php _e( 'Browser Window', 'ms' ); ?>" />
				<?= $screenshot; // @codingStandardsIgnoreLine ?>
				</a>
					<?php
				}
				?>

				<div class="Directory__blocks">
					<?php
						$csc_title = __( '${company_name} Customer Service Contacts', 'ms' );
						$csc_title = str_replace( '${company_name}', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ), $csc_title );
					?>
					<h2 id="customer-service-contacts" class="Post__sectiontitle"><span><?php echo esc_html( $csc_title ); ?></span></h2>

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
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_email_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_email-support', true ) ) ?></a></p>
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
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_chat_support ); ?>" target="_blank" rel="nofollow"><?php _e( 'Live Chat Button on Website', 'ms' ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_livechat-support', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-call-center.svg" alt="<?php echo esc_attr( $csc_call_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Call Center Support', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_call_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_call-center-support', true ) ) ?></a></p>
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
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_knowledge_base_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_knowledge-base', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-forum.svg" alt="<?php echo esc_attr( $csc_forum_support ); ?>">
							<h3><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Forum', 'ms' ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_forum_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_forum', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="social-media" class="Post__sectiontitle"><span><?php _e( 'Social Media Support Contacts', 'ms' ); ?></span></h2>

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
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_instagram ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_instagram', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-facebook.svg" alt="<?php echo esc_attr( $csc_facebook ); ?>">
							<h3><?php echo esc_html( $csc_facebook ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ), 'http' ) !== false ) { ?>
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_facebook ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_facebook', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-twitter.svg" alt="<?php echo esc_attr( $csc_twitter ); ?>">
							<h3><?php echo esc_html( $csc_twitter ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ), 'http' ) !== false ) { ?>
								<p><a itemprop="sameAs" href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_twitter ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_twitter', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="sla" class="Post__sectiontitle"><span><?php _e( 'SLAs & Agreements', 'ms' ); ?></span></h2>

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

					<h2 id="legal-contacts" class="Post__sectiontitle"><span><?php _e( 'Legal Contacts', 'ms' ); ?></span></h2>

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
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_terms ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_terms-conditions', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-privacy-policy.svg" alt="<?= esc_attr( $legal_privacy ); ?>">
							<h3><?= esc_html( $legal_privacy ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_privacy ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_privacy-policy', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-security-policy.svg" alt="<?= esc_attr( $legal_security ); ?>">
							<h3><?= esc_html( $legal_security ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_security ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_security-policy', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-gdpr.svg" alt="<?= esc_attr( $legal_gdpr ); ?>">
							<h3><?= esc_html( $legal_gdpr ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $legal_gdpr ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_gdpr', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>

					<h2 id="other-links" class="Post__sectiontitle"><span><?php _e( 'Other Links', 'ms' ); ?></span></h2>

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
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $others_wikipedia ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_wikipedia', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>

						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-affiliate-program.svg" alt="<?= esc_attr( $others_affiliate ); ?>">
							<h3><?= esc_html( $others_affiliate ); ?></h3>
							<?php if ( strpos( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ), 'http' ) !== false ) { ?>
								<p><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?= esc_attr( $others_affiliate ); ?>" target="_blank" rel="nofollow"><?= esc_html( str_replace( 'https://www.', '', get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ); ?></a></p>
							<?php } elseif ( empty( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_affiliate-program', true ) ) ) { ?>
								<p><?php _e( 'N/A', 'ms' ); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php if ( boolval( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_location', true ) ) ) { ?>
					<div class="Post__m__negative">
						<h2 id="location" class="Post__sectiontitle"><span><?php _e( 'Location', 'ms' ); ?></span></h2>

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
					<?php
				}
					the_content();
					echo do_shortcode( '[urlslab-faq]' );
				?>

					<div class="Post__buttons">
						<a href="<?php _e( '/directory/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Directory', 'ms' ); ?></span></a>
						<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
							<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
						</a>
					</div>
			</div>
		</div>
	</div>
</div>
