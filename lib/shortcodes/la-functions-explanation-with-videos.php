<?php
function la_functions_explanation_with_videos() {
	$atts = array(
		array(
			'class' => 'chat',
			'name' => __( 'Chat', 'ms' ),
			'url' => '/assets/videos/contact-form.mp4',
		),
		array(
			'class' => 'calls',
			'name' => __( 'Calls', 'ms' ),
			'url' => '/assets/videos/phone-call.mp4',
		),
		array(
			'class' => 'video-calls',
			'name' => __( 'Video calls', 'ms' ),
			'url' => '/assets/videos/video-call.mp4',
		),
		array(
			'class' => 'contact-forms',
			'name' => __( 'Contact forms', 'ms' ),
			'url' => '/assets/videos/contact-form.mp4',
		),
		array(
			'class' => 'forum',
			'name' => __( 'Forum', 'ms' ),
			'url' => '/assets/videos/forum.mp4',
		),
		array(
			'class' => 'feedbacks',
			'name' => __( 'Feedbacks', 'ms' ),
			'url' => '/assets/videos/feedback.mp4',
		),
		array(
			'class' => 'twitter',
			'name' => __( 'Twitter', 'ms' ),
			'url' => '/assets/videos/twitter.mp4',
		),
		array(
			'class' => 'gmail',
			'name' => __( 'Gmail', 'ms' ),
			'url' => '/assets/videos/mail.mp4',
		),
		array(
			'class' => 'facebook',
			'name' => __( 'Facebook', 'ms' ),
			'url' => '/assets/videos/facebook.mp4',
		),
		array(
			'class' => 'viber',
			'name' => __( 'Viber', 'ms' ),
			'url' => '/assets/videos/viber.mp4',
		),
		array(
			'class' => 'whatsapp',
			'name' => __( 'Whatsapp', 'ms' ),
			'url' => '/assets/videos/whatsapp.mp4',
		),
		array(
			'class' => 'slack',
			'name' => __( 'Slack', 'ms' ),
			'url' => '/assets/videos/slack.mp4',
		),
	);

	?>

		<div class="BuildingApp__videos ">
		<h3 class="BuildingApp__videos__title">
			<?php _e( ' Try all communication channels while your LiveAgent is ready. ', 'ms' ); ?>
		</h3>

		<?php

			echo '<div class="BuildingApp__videos__tabs">';
		foreach ( $atts as $att ) {
			$class_name = $att['class'];
			$display_name = $att['name'];

			echo '<div class="BuildingApp__videos__tab RadioInputContainer" data-tab="' . esc_attr( $class_name ) . '"  onclick="selectRadioTab(\'' . esc_attr( $class_name ) . '\')">
											<input type="radio" id="' . esc_attr( $class_name ) . '" name="radio" checked/>
											<label for="' . esc_attr( $class_name ) . '"><div class="tab-icon ' . esc_attr( $class_name ) . '"></div>' . esc_html( $display_name ) . '</label>
											</div>';

		}
			echo '</div>';
		?>

			<div class="BuildingApp__videos__contents">
				<?php
				foreach ( $atts as $att ) {
					$video_url = $att['url'];
					$class_name = $att['class'];
					?>

			<div class="tab-content" data-tab="<?php echo esc_attr( $class_name ); ?>">
				<video data-src="<?php echo esc_url( get_template_directory_uri() ) . esc_html( $video_url ); ?>" loading="lazy" muted autoplay>
					<source src="<?php echo esc_url( get_template_directory_uri() ) . esc_html( $video_url ); ?>" type="video/mp4" />
				</video>
			</div>
					<?php
				}
				?>
			</div>
	</div>


	<?php
		add_action(
			'wp_footer',
			function() {
				?>
	<script>
	let selectedParent = null;

		function selectRadioTab(id) {
			const radio = document.getElementById(id);
			radio.checked = true;
			const parentElement = radio.parentNode;

			if (selectedParent !== null) {
				selectedParent.classList.remove("selected");
				const activeContent = document.querySelector('.tab-content[data-tab="' + selectedParent.getAttribute("data-tab") + '"]');
				if (activeContent) {
					activeContent.style.display = 'none';
				}
			}

			parentElement.classList.add("selected");
			selectedParent = parentElement;

			const activeContent = document.querySelector('.tab-content[data-tab="' + id + '"]');
			if (activeContent) {
				activeContent.style.display = 'block';
				const video = activeContent.querySelector("video");
				if (video) {
					video.currentTime = 0;
				}
			}

			const prevActiveContent = document.querySelector('.tab-content[data-tab]:not([data-tab="' + id + '"])');
			if (prevActiveContent) {
				prevActiveContent.style.display = 'none';
			}
		}


		window.addEventListener("DOMContentLoaded", function() {
			const firstRadio = document.querySelector('.RadioInputContainer input[type="radio"]');
			if (firstRadio) {
				const firstTabId = firstRadio.id;
				selectRadioTab(firstTabId);
			}
		});

	</script>
				<?php
			}
		);
	?>
	<?php
}
add_shortcode( 'laFunctionsExplanationWithVideos', 'la_functions_explanation_with_videos' );
