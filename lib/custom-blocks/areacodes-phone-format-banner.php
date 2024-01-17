<?php
set_custom_source( 'components/AreaCodes-PhoneFormatBanner', 'css' );

?>

<div class="AreaCodes__PhoneFormatBanner">
		<div class="prefix">
			<span class="phoneCode"><?= esc_html( $args['calling_prefix'] ); ?></span>

			<span class="phoneCode__desc"><?php _e( 'Country Code', 'areacodes' ); ?></span>
		</div>

		<div class="areaCode">
			<span class="phoneCode">
				<?php
				if ( ! empty( $args['area_code'] ) ) {
					echo esc_html( $args['area_code'] );
				} else {
					echo '917';
				}
				?>
			</span>
			<span class="phoneCode__desc"><?php _e( 'Area Code', 'areacodes' ); ?></span>
		</div>

		<div>
			<span class="phoneCode">222</span>
			<span class="phoneCode__desc"><?php _e( 'Central Office/Exchange Code', 'areacodes' ); ?></span>
		</div>
		<div>
			<span class="phoneCode">3551</span>
			<span class="phoneCode__desc"><?php _e( 'Line Number/Subscriber Number', 'areacodes' ); ?></span>
		</div>
</div>
