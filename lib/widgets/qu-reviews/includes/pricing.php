<?php

function pricing( $meta ) {
	return '
	<div class="Reviews__info">
		<h3 class="no-margin">' . __( 'Pricing', 'reviews' ) . '</h3>
	
		<div class="flex-tablet Reviews__info--details mt-xs">
			<strong class="Reviews__info--desc mt-s">' . __( 'Starting from', 'reviews' ) . '</strong>
			<div>
				<div class="Reviews__info--pricing">
					<strong class="currency">' . $meta->currency . '</strong>
					<strong class="price">' . $meta->price . '</strong>
					<span class="text-light">
						&nbsp;' .
						$meta->period . '
					</span>
				</div>	
			</div>
		</div>
	
		<div class="flex-tablet Reviews__info--details mt-xs">
			<strong class="Reviews__info--desc">' . __( 'Free trial', 'reviews' ) . ':</strong> <span class="text-light">' . ( $meta->free_trial ? ucfirst( $meta->free_trial ) : __( 'No', 'reviews' ) ) . '</span>
		</div>
		<div class="flex-tablet Reviews__info--details mt-xs">
			<strong class="Reviews__info--desc">' . __( 'Free version', 'reviews' ) . ':</strong> <span class="text-light">' . ( $meta->free_version ? ucfirst( $meta->free_version ) : __( 'No', 'reviews' ) ) . '</span>
		</div>
	</div>';
}
