<?php
	/**
	 * Template Name: Free Account
	 */

	set_custom_source( 'layouts/FreeAccount', 'css' );
?>

<div class="FullScreen FreeAccount">

	<div class="FreeAccount__sidebar">

		<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="FreeAccount__sidebar__logo">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">
		</a>

		<?= do_shortcode( '[signupform-free]' ); ?>

		<div class="showMainSection__wrapper pos-relative flex flex-direction-column">
			<div class="showMainSection__image"><img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/free_account/we_have_better_option__mobile.svg" alt="We have better option"></div>
			<button class="Button Button--full showMainSection" data-target="mainSection" type="button">
				<span class="flex flex-align-center"><?php _e( 'Show', 'ms' ); ?>
					<svg class="icon icon-chevron-down">
						<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION ); ?>#chevron-down"></use>
					</svg>
				</span>
			</button>
		</div>
	</div>

	<div class="FreeAccount__main hidden" data-targetId="mainSection">
		<div class="FreeAccount__main__included">
			<h3><?php _e( 'Included in Small business plan:', 'ms' ); ?></h3>
			<ul class="FreeAccount__main__included--list">
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/ticket_history.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Ticket history', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Ticket history', 'ms' ); ?></h4>
						<?php _e( 'for unlimited days', 'ms' ); ?>
					</div>
				</li>

				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/integrations.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Integrations', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Integrations', 'ms' ); ?></h4>
						<?php _e( 'over 190 available', 'ms' ); ?>
					</div>
				</li>

				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/more_email_accounts.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'More email accounts', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'More email accounts', 'ms' ); ?></h4>
						<?php _e( '+ departments, contact forms, and more', 'ms' ); ?>
					</div>
				</li>

				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/chat_transcripts.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Chat Transcripts', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Chat Transcripts', 'ms' ); ?></h4>
						<?php _e( 'with satisfactions surveys', 'ms' ); ?>
					</div>
				</li>

				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/canned_messages.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Canned messages', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Canned messages', 'ms' ); ?></h4>
						<?php _e( 'with predefined answers (20)', 'ms' ); ?>
					</div>
				</li>
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/social_networks.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Social networks', 'ms' ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Social networks', 'ms' ); ?></h4>
						<?php _e( 'option to buy access to our social media integrations', 'ms' ); ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="FreeAccount__main__try">
			<h1 class="FreeAccount__main__try--title pos-relative highlight__underline"><?php _e( 'Try small business plan', 'ms' ); ?>
			<img class="FreeAccount__main__try--title__option" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/we_have_better_option.png?ver=' . THEME_VERSION ); ?>" alt="We have better option" /></h1>
			<p class="FreeAccount__main__try--subtitle"><?php _e( 'While the Free account is great, it doesn’t provide the best value. Our Small plan has better features for a very small price.', 'ms' ); ?></p>

			<div class="FreeAccount__main__included--mobile">
				<ul class="checklist">
					<li>
						<?php _e( 'Ticket history for 7 days', 'ms' ); ?>
					</li>

					<li>
						<?php _e( 'Over 190 integrations', 'ms' ); ?>
					</li>

					<li>
						<?php _e( 'More email accounts and email ticketing features', 'ms' ); ?>
					</li>

					<li>
						<?php _e( 'Chat transcripts and Chat satisfaction surveys', 'ms' ); ?>
					</li>

					<li>
						<?php _e( 'Canned messages and predefined answers (20)', 'ms' ); ?>
					</li>
					<li>
						<?php _e( 'Option to buy access to social media features', 'ms' ); ?>
					</li>
				</ul>
			</div>

			<div class="FreeAccount__main__try--pricing pos-relative flex">
				<h3><sup>$</sup><span class="big">15/</span><?php _e( 'agent', 'ms' ); ?></h3>
				<img class="FreeAccount__main__try--pricing__beers" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/less_than_3_beers.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Less than 3 beers', 'ms' ); ?>" />
			</div>
			<p class="FreeAccount__main__try--pricing__monthly"><?php _e( 'per month billed annualy or', 'ms' ); ?> <sup>$</sup><strong>19</strong> <?php _e( 'monthly billing', 'ms' ); ?></p>

			<a class="Button Button--full FreeAccount__main__try--trial" href="<?php _e( '/trial', 'ms' ); ?>"><span><?php _e( 'Try for FREE', 'ms' ); ?></span></a>

			<div class="FreeAccount__main__try--citation flex">
				<img class="FreeAccount__main__try--citation__image" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/peter_komorik.jpg?ver=' . THEME_VERSION ); ?>" alt="Peter Komorik image" />
				<div class="FreeAccount__main__try--citation__text">
					<p><i><?php _e( '“LiveAgent combines excellent live chat, ticketing and automation that allow us to provide exceptional support to our customers.”', 'ms' ); ?></i></p>
					<strong>Peter Komornik, CEO, Slido</strong>
				</div>
			</div>
			<ul class="FreeAccount__main__try--logos flex">
				<li>
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/rating_capterra.svg" alt="<?php _e( 'Capterra', 'ms' ); ?>" class="urlslab-skip-lazy">
					</a>
				</li>
				<li>
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/rating_g2.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>" class="urlslab-skip-lazy">
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<script>
	const activatorBtn = document.querySelector('.showMainSection');

	const disableBtn = activatorBtn.addEventListener('click', (event) => {
		activatorBtn.disabled = true;
		activatorBtn.removeEventListener('click', disableBtn);
	}, false)
</script>
