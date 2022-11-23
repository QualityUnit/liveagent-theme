<?php

function pricing( $meta ) {
	return '
	<h3 class="no-margin">' . __( 'Pricing', 'reviews' ) . '</h3>
	<div class="Reviews__info" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
		<dl class="Reviews__info--details first mt-xs">
			<dt>' . __( 'Starting from:', 'reviews' ) . '</dt>
			<dd>
				<div class="Reviews__info--pricing">
					<strong class="currency" itemprop="priceCurrency" content="USD">' . $meta->currency . '</strong>
					<strong class="price" itemprop="price">' . $meta->price . '</strong>
					<span class="text-light">
					&nbsp;' .
					$meta->period . '
					</span>
				</div>
				</dd>
			<dt class="note invisible">Note</dt>
			<dd class="note text-light">' . $meta->note . '</dd>
		</dl>
		<dl class="Reviews__info--details second">
			<dt>' .
				__( 'Free trial', 'reviews' ) . ':
			</dt>
			<dd>' . ( $meta->free_trial ? ucfirst( $meta->free_trial ) : __( 'No', 'reviews' ) ) . '</dd>
			<dt>' . __( 'Free version', 'reviews' ) . ':</dt>
			<dd>' . ( $meta->free_version ? ucfirst( $meta->free_version ) : __( 'No', 'reviews' ) ) . '</dd>
		</dl>
	</div>';
}
