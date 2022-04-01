<?php
	/**
	 * Template Name: Demo
	 */
?>

<div class="FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="FullScreen__logo" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Demo Logo'])">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent_black.svg" alt="<?php bloginfo( 'name' ); ?>">
	</a>

	<div class="FullScreen__sidebar">
		<div class="slider splide">
			<div class="splide__track">
				<div class="splide__list">
					<div class="splide__slide FullScreen__sidebar__item FullScreen__sidebar__item--demo" style="background-image: url(<?= esc_url( home_url( '/', 'relative' ) ); ?>app/uploads/2020/01/bg_demo_michaela.jpg);">
						<div class="FullScreen__sidebar__item__text">
						<?php _e( '<p>"Do you know what is best about LiveAgent? All the live chat benefits? Providing real-time support? Having all the communication under the same roof...? Maybe I could go on and on about all the features we have but let me show you what we have during our demo presentation and decide for yourself!"</p><p>Michael Gombarova, <strong>Sales Manager</strong></p>', 'ms' ); ?>
						</div>
					</div>

					<div class="splide__slide FullScreen__sidebar__item FullScreen__sidebar__item--demo" style="background-image: url(<?= esc_url( home_url( '/', 'relative' ) ); ?>app/uploads/2020/01/bg_demo_tomas.jpg);">
						<div class="FullScreen__sidebar__item__text">
						<?php _e( '<p>"Lumberjack shirt? Check! Laptop for the demo? Check! Notepad for ideas? Check! Are you ready?"</p><p>Tomas Varga, <strong>Sales Manager</strong></p>', 'ms' ); ?>
						</div>
					</div>

					<div class="splide__slide FullScreen__sidebar__item FullScreen__sidebar__item--demo" style="background-image: url(<?= esc_url( home_url( '/', 'relative' ) ); ?>app/uploads/2020/01/bg_demo_andrej.jpg);">
						<div class="FullScreen__sidebar__item__text">
						<?php _e( '<p>"Approach each customer with the idea of helping him or her to solve a problem or achieve a goal, not of selling a product or service." – Brian Tracy</p><p>Andrej Saxon, <strong>Sales Manager</strong></p>', 'ms' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="FullScreen__main FullScreen__main--long">
		<div class="FullScreen__main__container">

			<img class="FullScreen__main__container__image" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">

			<h1 class="FullScreen__main__container__title"><?php _e( 'Schedule a Demo', 'ms' ); ?></h1>
			<p class="FullScreen__main__container__text"><?php _e( 'Get a jump start on the competition and schedule a one-on-one call with one of our customer success representatives, to see how LiveAgent can benefit your business.', 'ms' ); ?></p>

			<script type="text/javascript">
				(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
				'//support.qualityunit.com/scripts/track.js',
				function(e){ LiveAgent.createForm('xw2c9xiu', e); });
			</script>

		</div>
	</div>
</div>
