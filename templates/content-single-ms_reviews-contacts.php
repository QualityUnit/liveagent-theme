<?php  // @codingStandardsIgnoreLine
	$screenshot = do_shortcode( "[urlslab-screenshot alt='" . esc_attr( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ) . " Homepage' url='" . esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_website', true ) ) . "' ]" );

	$csc_title = __( '${company_name} customer support', 'ms' );
	$csc_title = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_title );

	$csc_desc = __( '${company_name} is a free solution with no available pricing plans or extra charges for features. You can download the newest version and start using it free of charge. ${company_name} doesn’t include advertisements, and there are no usage limits present in the app.', 'reviews' );
	$csc_desc = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_desc );

	$csc_email_support = __( 'Contact ${company_name} customer support by email', 'ms' );
	$csc_email_support = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_email_support );

	$csc_chat_support = __( 'Chat with ${company_name} representative', 'ms' );
	$csc_chat_support = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_chat_support );

	$csc_call_support = __( 'Call with ${company_name} support', 'ms' );
	$csc_call_support = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_call_support );

	$csc_knowledge_base_support = __( 'Learn more about ${company_name} products', 'ms' );
	$csc_knowledge_base_support = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_knowledge_base_support );

	$csc_forum_support = __( 'Participate in ${company_name}’s community forum discussions', 'ms' );
	$csc_forum_support = str_replace( '${company_name}', get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ), $csc_forum_support );
?>
<div class="Directory__blocks mt-xxl mb-xxxl">
	<h2 id="customer-service-contacts" class="Post__sectiontitle"><span><?php echo esc_html( $csc_title ); ?></span></h2>

	<p><?= esc_html( $csc_desc ); ?></p>

	<div class="Directory__blocks__items">
		<div class="Directory__blocks__items__item">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-ticket.svg" alt="<?php echo esc_attr( $csc_email_support ); ?>">
			<h3><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Email Support', 'ms' ); ?></h3>
			<?php if ( strpos( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ), 'http' ) !== false ) { ?>
				<p><a href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_email_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ) ); ?></a></p>
			<?php } elseif ( empty( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ) ) ) { ?>
				<p><?php _e( 'N/A', 'ms' ); ?></p>
			<?php } else { ?>
				<p><a itemprop="email" href="mailto:<?= esc_attr( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ) ); ?>" title="<?php echo esc_attr( $csc_email_support ); ?>"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_email-support', true ) ); ?></a></p>
			<?php } ?>
		</div>

		<div class="Directory__blocks__items__item">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-live-chat.svg" alt="<?php echo esc_attr( $csc_chat_support ); ?>">
			<h3><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Live Chat Support', 'ms' ); ?></h3>
			<?php if ( strpos( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_livechat-support', true ), 'http' ) !== false ) { ?>
				<p><a href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_livechat-support', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_chat_support ); ?>" target="_blank" rel="nofollow"><?php _e( 'Live Chat Button on Website', 'ms' ); ?></a></p>
			<?php } elseif ( empty( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_livechat-support', true ) ) ) { ?>
				<p><?php _e( 'N/A', 'ms' ); ?></p>
			<?php } ?>
		</div>

		<div class="Directory__blocks__items__item">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-call-center.svg" alt="<?php echo esc_attr( $csc_call_support ); ?>">
			<h3><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Call Center Support', 'ms' ); ?></h3>
			<?php if ( strpos( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ), 'http' ) !== false ) { ?>
				<p><a href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_call_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ) ); ?></a></p>
			<?php } elseif ( empty( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ) ) ) { ?>
				<p><?php _e( 'N/A', 'ms' ); ?></p>
			<?php } else { ?>
				<p><a itemprop="telephone" href="tel:<?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ) ); ?>" title="<?php echo esc_attr( $csc_call_support ); ?>"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_call-center-support', true ) ); ?></a></p>
			<?php } ?>
		</div>

		<div class="Directory__blocks__items__item">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-knowledge-base.svg" alt="<?php echo esc_attr( $csc_knowledge_base_support ); ?>">
			<h3><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Knowledge Base', 'ms' ); ?></h3>
			<?php if ( strpos( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_knowledge-base', true ), 'http' ) !== false ) { ?>
				<p><a href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_knowledge-base', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_knowledge_base_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_knowledge-base', true ) ); ?></a></p>
			<?php } elseif ( empty( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_knowledge-base', true ) ) ) { ?>
				<p><?php _e( 'N/A', 'ms' ); ?></p>
			<?php } ?>
		</div>

		<div class="Directory__blocks__items__item">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-forum.svg" alt="<?php echo esc_attr( $csc_forum_support ); ?>">
			<h3><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_company-name', true ) ); ?> <?php _e( 'Forum', 'ms' ); ?></h3>
			<?php if ( strpos( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_forum', true ), 'http' ) !== false ) { ?>
				<p><a href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_forum', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" title="<?php echo esc_attr( $csc_forum_support ); ?>" target="_blank" rel="nofollow"><?= esc_html( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_forum', true ) ); ?></a></p>
			<?php } elseif ( empty( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_forum', true ) ) ) { ?>
				<p><?php _e( 'N/A', 'ms' ); ?></p>
			<?php } ?>
		</div>
	</div>


	<?php
	if ( preg_match( '/\<img/', $screenshot ) ) {
		?>
	<h2 id="product-homepage" class="Post__sectiontitle"><span><?php echo esc_html( 'Product home page', 'reviews' ); ?></span></h2>
	<a class="Directory__screenshot mb-xxxl" href="<?= esc_url( get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_website', true ) ); ?>" target="_blank" rel="nofollow" title="<?= esc_attr( __( 'Go to', 'ms' ) . ' ' . get_post_meta( get_the_ID(), 'mb_directory_mb_directory_website', true ) ); ?>">
		<div class="Directory__screenshot--url">
		<?= esc_html( __( 'Go to', 'ms' ) . ' ' . get_post_meta( meta( 'details_contacts' ), 'mb_directory_mb_directory_website', true ) ); ?>
		</div>
		<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/browser_window.svg' ); ?>" />
	<?= $screenshot; // @codingStandardsIgnoreLine ?>
	</a>
		<?php
	}
	?>
</div>
