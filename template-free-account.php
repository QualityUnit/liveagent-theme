<?php
	/**
	 * Template Name: Free Account
	 */

	 set_custom_source( 'layouts/FreeAccount', 'css' );
?>

<div class="FullScreen FreeAccount">

	<div class="FullScreen__sidebar FreeAccount__sidebar">

	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="FreeAccount__sidebar__logo">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">
	</a>

			<?= do_shortcode( '[signupform-free]' ); ?>
	</div>

	<div class="FullScreen__main FreeAccount__main">
		<div class="FreeAccount__main__included">
			<h3><?php _e( 'Included in Small business plan:', 'ms' ); ?></h3>
			<ul class="FreeAccount__main__included--list">
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/ticket_history.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Ticket history', 'ms' ); ?></h4>
						<?php _e( 'for 7 days', 'ms' ); ?>
					</div>
				</li>
	
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/integrations.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Integrations', 'ms' ); ?></h4>
						<?php _e( 'over 190 available', 'ms' ); ?>
					</div>
				</li>
	
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/more_email_accounts.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'More email accounts', 'ms' ); ?></h4>
						<?php _e( '+ departments, contact forms, and more', 'ms' ); ?>
					</div>
				</li>
	
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/chat_transcripts.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Chat Transcripts', 'ms' ); ?></h4>
						<?php _e( 'with satisfactions surveys', 'ms' ); ?>
					</div>
				</li>
	
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/canned_messages.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Canned messages', 'ms' ); ?></h4>
						<?php _e( 'with predefined answers (20)', 'ms' ); ?>
					</div>
				</li>
				<li class="FreeAccount__main__included--item">
					<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/social_networks.png?ver=' . THEME_VERSION ); ?>" />
					<div class="FreeAccount__main__included--text">
						<h4><?php _e( 'Social networks', 'ms' ); ?></h4>
						<?php _e( 'option to buy access to our social media integrations', 'ms' ); ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="FreeAccount__main__try">
			<h2 class="FreeAccount__main__try--title pos-relative highlight__underline"><?php _e( 'Try small business plan', 'ms' ); ?>
			<img class="FreeAccount__main__try--title__option" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/we_have_better_option.png?ver=' . THEME_VERSION ); ?>" /></h2>
			<p class="FreeAccount__main__try--subtitle"><?php _e( 'While the Free account is great, it doesn’t provide the best value. Our Small plan has better features for a very small price.', 'ms' ); ?></p>

			<div class="FreeAccount__main__try--pricing pos-relative flex">
				<h3><sup>$</sup><span class="big">9/</span><?php _e( 'agent', 'ms' ); ?></h3>
				<img class="FreeAccount__main__try--pricing__beers" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/less_than_3_beers.png?ver=' . THEME_VERSION ); ?>" />
			</div>
			<p class="FreeAccount__main__try--pricing__monthly"><?php _e( 'per month billed annualy or', 'ms' ); ?> <sup>$</sup><strong>12</strong> <?php _e( 'monthly billing', 'ms' ); ?></p>

			<a class="Button Button--full FreeAccount__main__try--trial" href="<?php _e( '/trial', 'ms' ); ?>"><span><?php _e( 'Try for FREE', 'ms' ); ?></span></a>

			<div class="FreeAccount__main__try--citation flex-tablet">
				<img class="FreeAccount__main__try--citation__image" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/peter_komorik.jpg?ver=' . THEME_VERSION ); ?>" />
				<div class="FreeAccount__main__try--citation__text">
					<p><i><?php _e( '“LiveAgent combines excellent live chat, ticketing and automation that allow us to provide exceptional support to our customers.”', 'ms' ); ?></i></p>
					<strong>Peter Komornik, CEO, Slido</strong>
				</div>
			</div>
			<ul class="FreeAccount__main__try--logos flex-tablet">
				<li><img class="FreeAccount__main__try--komorik" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/trustpilot.svg?ver=' . THEME_VERSION ); ?>" /></li>
				<li><img class="FreeAccount__main__try--komorik" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/capterra.svg?ver=' . THEME_VERSION ); ?>" /></li>
				<li><img class="FreeAccount__main__try--komorik" src="<?= esc_url( get_template_directory_uri() . '/assets/images/free_account/g2.svg?ver=' . THEME_VERSION ); ?>" /></li>
			</ul>
		</div>
	</div>
</div>
