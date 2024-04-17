<?php

function ms_request_for_proposal_form( $atts ) {

	// include resources
	set_custom_source( 'components/Signup' );

	$atts = shortcode_atts(
		array(
			'title'    => __( 'Request for proposal', 'ms' ),
			'title_tooltip'    => __( 'A request for proposal is ideal for users who want to customize LiveAgent according to their demands. Contacts us and well discuss what we can offer for your business.', 'ms' ),
			'description'    => __( 'Fill out the form or send us an email. If you need us to sign an NDA, contact Andy at ', 'ms' ),
			'email_in_description' => __( 'andy@liveagent.com.', 'ms' ),
			'label1'   => __( 'Customer service since 2004', 'ms' ),
			'label2'   => __( 'More than 20 000 clients', 'ms' ),
			'footer_btn_one_text'   => __( 'Start free trial', 'ms' ),
			'footer_btn_one_url'   => __( '/trial/', 'ms' ),
			'footer_btn_two_text'   => __( 'Request demo', 'ms' ),
			'footer_btn_two_url'   => __( '/demo/', 'ms' ),

		),
		$atts,
	);

	ob_start();
	?>

	<div class="Signup__form">
		<div class="Signup__form__title h2"><?= esc_html( $atts['title'] ); ?>
			<span class="ComparePlans__tooltip">
					<span class="fontello-info"></span>
					<span class="ComparePlans__tooltip__text ComparePlans__tooltip__text--top"><?= esc_html( $atts['title_tooltip'] ); ?></span>
		</span>
		</div>

		<p class="Signup__form__description"><?= esc_html( $atts['description'] ); ?><?= esc_html( $atts['email_in_description'] ); ?></p>

		<div class="Signup__form__labels">
			<span class="Signup__form__labels__label">
				<?php echo esc_html( $atts['label1'] ); ?>
			</span>
			<span class="Signup__form__labels__label"><?php echo esc_html( $atts['label2'] ); ?></span>
		</div>
		<!-- Start of LiveAgent integration script: Contact form: LiveAgent.com - Request For Proposal -->
		<script type="text/javascript">
			(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.defer=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
				'https://support.qualityunit.com/scripts/track.js',
				function(e){ LiveAgent.createForm('g31s5iuc', e); });
		</script>
		<!-- End of LiveAgent integration script -->

		<div class="Signup__form__logos">

			<div class="Signup__form__logo">
				<a href="<?php _e( '/awards/', 'ms' ); ?>">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/rating_capterra.svg" alt="<?php _e( 'Capterra', 'ms' ); ?>" class="urlslab-skip-lazy">
				</a>
			</div>

			<div class="Signup__form__logo">
				<a href="<?php _e( '/awards/', 'ms' ); ?>">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/rating_g2.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>" class="urlslab-skip-lazy">
				</a>
			</div>
			<div class="Signup__form__logo">
				<a href="<?php _e( '/awards/', 'ms' ); ?>">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo-getapp-gray.svg" alt="<?php _e( 'Getapp', 'ms' ); ?>" class="urlslab-skip-lazy">
				</a>
			</div>

		</div>
	</div>
	<div class="Signup__form__cta__buttons">
		<a href="<?= esc_url( $atts['footer_btn_one_url'] ); ?>" class="Button Button--full">
			<span><?= esc_html( $atts['footer_btn_one_text'] ); ?></span>
		</a>
		<a href="<?= esc_url( $atts['footer_btn_two_url'] ); ?>" class="Button Button--outline">
			<span><?= esc_html( $atts['footer_btn_two_text'] ); ?></span>
		</a>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'request-for-proposal-form', 'ms_request_for_proposal_form' );
