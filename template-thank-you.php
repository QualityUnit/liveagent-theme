<?php
/**
 * Template Name: Thank You
 */

use QualityUnit\Trial_Signup;
set_source( 'thank-you', 'pages/ThankYou', 'css' );
Trial_Signup::include_crm();
?>

<div data-id="signup-trial-installation" id="loader" class="urlslab-skip-all">
	<div class="loaderIn">

		<div class="BuildingApp">
				<div class="BuildingApp__progress">
					<div class="BuildingApp__progress__header">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_logo_liveagent.jpg" alt="<?php bloginfo( 'name' ); ?>" class="BuildingApp__progress__header__logo">
							<div class="BuildingApp__progress__header__title h2 loader-label"><?php _e( 'Building Your LiveAgent...', 'ms' ); ?></div>
						<div class="BuildingApp__progress__header__action__wrapper invisible">
							<div class="BuildingApp__progress__header__percentage percentage">0%</div>
							<div data-id="redirectButtonPanel" style="display:none"></div>
						</div>
						<div id="progress-1" class="progress__bar__container invisible">
							<div class="progress__bar"></div>
							<div class="progress__ball"></div>
						</div>
					</div>

					<p class="BuildingApp__progress__wrap__text"><?php _e( 'We appreciate your recent sign up for a LiveAgent. <br>A message will be sent to your email address containing login details, right after your account is installed.', 'ms' ); ?></p>
				</div>

			<?= do_shortcode( '[laIntroductionVideos]' ); ?>

		</div>
	</div>
</div>
