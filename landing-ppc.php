<?php
/*
Template Name: Landing PPC
Template Post Type: ms_landing
*/

set_custom_source( 'components/HeroHeadlineBanner', 'css' );
set_custom_source( 'common/elementor-custom', 'css' );
set_custom_source( 'layouts/LandingPPC', 'css' );
?>

<style type="text/css">
  .elementor-section.elementor-section-boxed > .elementor-container {
	width: 100%;
	max-width: 1380px !important;
	align-items: center;
  }

  [data-ytid] {
	cursor: pointer;
  }
</style>

<div class="LandingPPC urlslab-skip-keywords">
  <section class="heroBanner heroBanner--home">
	<div class="elementor-container elementor-column-gap-default">
	<div
	  class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3736715d wrapper">
	  <div class="elementor-widget-wrap elementor-element-populated">
	  <section
	  class="elementor-section elementor-inner-section elementor-element elementor-element-7a5f11e1 elementor-section-boxed elementor-section-height-default elementor-section-height-default">
	  <div class="elementor-container elementor-column-gap-default">
	  <div
	  class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-51aab93f heroBanner__content">
	  <div class="elementor-widget-wrap elementor-element-populated">
	  <div
	  class="elementor-element elementor-element-73ce06a9 heroBanner__content__title elementor-widget elementor-widget-heading">
	  <div class="elementor-widget-container">
	  <h1 class="elementor-heading-title elementor-size-default" id="h-provide-excellent-customer-service">
	  <?=
		esc_html( get_post_meta( get_the_ID(), 'title', true ) );
		?>
	</h1>
	  </div>
	  </div>
	  <div
	  class="elementor-element elementor-element-6ae1520d heroBanner__content__subtitle elementor-widget elementor-widget-text-editor">
	  <div class="elementor-widget-container">
	  <h3 id="h-answer-more-tickets-with-all-in-one-customer-care-solution">
	  <?= get_post_meta( get_the_ID(), 'subtitle', true );  // @codingStandardsIgnoreLine
		?>
	</h3>
	  </div>
	</div>
	<div
	  class="elementor-element elementor-element-5ee98022 heroBanner__content__footer elementor-widget elementor-widget-html">
	  <div class="elementor-widget-container">
	  <ul class="no-cc urlslab-skip-all">
	  <li>✓ No setup fee</li>
	  <li>✓ Customer service 24/7</li>
	  <li>✓ No credit card required</li>
	  <li>✓ Cancel any time</li>
	  </ul>
	  <div class="heroBanner__content__footer__cta">
			<a href="<?= get_post_meta( get_the_ID(), 'header_button_url', true ); // @codingStandardsIgnoreLine ?>" class="Button Button--full" title="Considering LiveAgent help desk software? Fill in your details and you can start your Free Trial, no strings attached, no credit card info needed." hreflang="en-US" onover-preload="1">
				<span><?= get_post_meta( get_the_ID(), 'header_button_text', true );  // @codingStandardsIgnoreLine  ?></span>
			</a>
	  </div>
	</div>
	</div>
	</div>
	</div>
	<div
	class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-59ba5d18 heroBanner__image">
	<div class="elementor-widget-wrap elementor-element-populated">
	<div class="elementor-element elementor-element-1d37a861 homeVideo elementor-widget elementor-widget-image"
	  <?php
		if ( ! empty( get_post_meta( get_the_ID(), 'form_videoid', true ) ) ) {
			?>
				data-ytid="<?= esc_attr( get_post_meta( get_the_ID(), 'form_videoid', true ) ); ?>" data-lightbox="youtube"
	 <?php } ?>
				>
		<div class="elementor-widget-container">
				<?php
					$img_id  = get_post_meta( get_the_ID(), 'media', true );
					$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
					echo wp_get_attachment_image( $img_id, 'header_image', false, array( 'alt' => empty( $img_alt ) ? 'Header image' : $img_alt ) );
				?>
		</div>
	<div itemscope="" itemtype="https://schema.org/VideoObject" itemprop="video">
	  <meta itemprop="name" content="LiveAgent product overview 2024.">
	  <meta itemprop="description"
	  content="Welcome to LiveAgent – your all-in-one customer support solution! LiveAgent brings you everything you need to provide effortless and efficient customer service. With our powerful, easy-to-use platform, you can manage emails, live chats, phone calls, social media interactions, and customer inquiries all in one place.">
	  <link itemprop="thumbnailUrl"
	  content="https://i.ytimg.com/vi/KpY51cPRg5w/sddefault.jpg?sqp=-oaymwEmCIAFEOAD8quKqQMa8AEB-AH-CYAC0AWKAgwIABABGF4gTyhlMA8=&amp;rs=AOn4CLBQZXU8O7LsapIqQZFO_0unLQSgbQ">
	  <link itemprop="contentUrl" content="https://www.youtube.com/watch?v=KpY51cPRg5w">
	  <link itemprop="embedUrl" content="https://www.youtube.com/embed/KpY51cPRg5w">
	  <meta itemprop="duration" content="P0Y0M0DT0H0M88S">
	  <meta itemprop="uploadDate" content="2024-06-26T11:25:09+00:00">
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>
	</div>
	</div>
	</div>
  </section>


  <section class="elementor-section">
	<div class="elementor-container Logos">
		<?= do_shortcode( '[clients]' ); ?>
	</div>
  </section>

	<section class="LandingPPC-HeaderSection">
		<div class="wrapper">
			<h2 class="h1 text-align-center"><?php _e( 'Connect with your customers on all channels', 'ms' ); ?></h2>
			<p class="text-align-center">
				<?php
				_e(
					'Discover our multi-channel help desk software with 130+ ticketing features
				and 200+ integrations with the tools you love.',
					'ms'
				);
				?>
			</p>
		</div>
	</section>

	<section>
		<div class="wrapper LandingPPC-Connect">
			<picture class="urlslab-skip-all">
				<source srcset="<?= esc_url( get_template_directory_uri() . '/assets/images/landing_ppc_all-channels_mobile.jpg' ); ?>" media="(max-width: 1023px)">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/landing_ppc_all-channels.jpg' ); ?>" alt="Connect with your customers on all channels" loading="lazy" />
			</picture>
			<div class="flex LandingPPC-Connect__button">
				<a href="/help-desk-software/" class="Button Button--outline Button--outline-white icn-after-arrow-right" title="Help Desk Software"><span><?php _e( 'Explore our Helpdesk', 'ms' ); ?></span><svg class="icon icon-arrow-right"><use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=1.25.58#arrow-right' ); ?>"></use></svg></a>

				<a href="#signupform" class="Button Button--full mt-l ma-left ma-right hidden-tablet">
					<span>
						<?php
						_e( 'Get started | 30 day free', 'ms' );
						?>
					</span>
				</a>
			</div>
		</div>
	</section>

	<section class="LandingPPC-signupForm" id="signupform">
		<div class="wrapper">
			<div class="LandingPPC-signupForm__inn">
				<div class="LandingPPC-signupForm__left flex flex-direction-column">
					<div class="LandingPPC-signupForm__left-text">
						<h3 class="title"><?= esc_html( get_post_meta( get_the_ID(), 'form_title', true ) ); ?></h3>
						<p><?= esc_html( get_post_meta( get_the_ID(), 'form_subtitle', true ) ); ?></p>
					</div>
					<img class="ma-top" src="<?= esc_url( get_template_directory_uri() . '/assets/images/landing_ppc_img_sign-up-form-app.png' ); ?>" alt="<?= esc_attr( __( 'One solution for every business', 'ms' ) ); ?>" loading="lazy" />
				</div>
				<?= do_shortcode( '[signupform-landingppc]' ); ?>
			</div>
		</div>
	</section>

  <section class="LandingPPC-HeaderSection LandingPPC-floatingBlock__header">
	<h2 class="h1">
	<?=
	esc_html( get_post_meta( get_the_ID(), 'col_title', true ) );
	?>
	</h2 >
	<p>
	<?=
	esc_html( get_post_meta( get_the_ID(), 'col_subtitle', true ) );
	?>
	</p>
  </section>

  <section class="bg-level4">
	<div class="LandingPPC-floatingBlock">
	<div class="LandingPPC-cols  LandingPPC-cols-3">
	  <div class="LandingPPC-col">
		<img class="LandingPPC-col__icon mb-l" src="<?= esc_url( get_template_directory_uri() . '/assets/images/landingppc_plus_icon.svg' ); ?>" alt="icon" />
	  <h4>
			<?=
			esc_html( get_post_meta( get_the_ID(), 'box1_title', true ) );
			?>
		</h4>
	  <p>
	  <?=
		esc_html( get_post_meta( get_the_ID(), 'box1_text', true ) );
		?>
	</p>
	  </div>

	  <div class="LandingPPC-col">
			<img class="LandingPPC-col__icon mb-l" src="<?= esc_url( get_template_directory_uri() . '/assets/images/landingppc_plus_icon.svg' ); ?>" alt="icon" />
			<h4>
				<?=
				esc_html( get_post_meta( get_the_ID(), 'box2_title', true ) );
				?>
			</h4>
	  <p>
	  <?=
		esc_html( get_post_meta( get_the_ID(), 'box2_text', true ) );
		?>
	</p>
	  </div>

	  <div class="LandingPPC-col">
			<img class="LandingPPC-col__icon mb-l" src="<?= esc_url( get_template_directory_uri() . '/assets/images/landingppc_plus_icon.svg' ); ?>" alt="icon" />
			<h4>
				<?=
				esc_html( get_post_meta( get_the_ID(), 'box3_title', true ) );
				?>
			</h4>
	  <p>
			<?=
				esc_html( get_post_meta( get_the_ID(), 'box3_text', true ) );
			?>
	</p>
	  </div>
	</div>
	<div class="flex LandingPPC-discover__wrapper">
		<a href="/features" class="LandingPPC-discover">
			<strong>
				<?php _e( 'Discover all features', 'ms' ); ?>
			</strong>
			<svg class="icon-arrow"><use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#arrow-right' ); ?>"></use></svg>
		</a>
	</div>
	</div>
  </section>

  <section class="bg-level4">

	<div class="wrapper">
		<div class="LandingPPC-HeaderSection mb-l">
			<h2 class="h1"><?php _e( 'Get LiveAgent and join 7000 happy clients', 'ms' ); ?></h2>
			<p><?php _e( 'Take a look at the key features and benefits you get when you pick LiveAgent as a dedicated help desk and communication for your business.', 'ms' ); ?></p>

			<div class="Buttons">
				<a class="Button Button--full" href="#signupform"><span><?php _e( 'Sign up for FREE', 'ms' ); ?></span></a>
				<a class="Button Button--outline" href="/demo"><span><?php _e( 'Book a demo', 'ms' ); ?></span></a>
			</div>
		</div>
	</div>

		<div class="SliderTestimonials__wrapper">
			<?=
			do_shortcode( '[slidertestimonials_landingppc]' );
			?>
		</div>
	</section>

  <?= do_shortcode( '[good-hands-new]' ); ?>

</div>

