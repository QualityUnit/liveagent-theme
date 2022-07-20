<?php 
function howto_item( $attr ) {
	if ( isset( $_SERVER['HTTPS'] ) &&
		( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || //@codingStandardsIgnoreLine
		isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) &&
		$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) { //@codingStandardsIgnoreLine
		$protocol = 'https://';
	} else {
		$protocol = 'http://';
	}
	$referer = urlencode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //@codingStandardsIgnoreLine;

	/* Filling the meta image property, if howto item has image,
	*  parse it from there, if not, get main post image instead
	*/
	$content = $attr['content'];

	if ( isset( $attr['schemaImage'] ) ) {
		$image = $attr['schemaImage'];
	}

	if ( ! isset( $image ) ) {
		$image = get_the_post_thumbnail_url();
		preg_match_all( '/img src="(.+\.(jpg|svg|png|gif|webp))"/', $content, $img );
		preg_match_all( '/video src="(.+\.(webm|mp4|m4v))"/', $content, $videos );
		preg_match_all( '/url":"(.+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?)"/', $content, $yt );
		if ( isset( $img ) && isset( $img[1][0] ) ) {
			$image = $img[1][0];
		}
		if ( isset( $videos ) && isset( $videos[1][0] ) ) {
			$image = null;
			$video = $videos[1][0];
		}
		if ( isset( $yt ) && isset( $yt[1][0] ) ) {
			$image = null;
			$video = $yt[1][0];
		}
	}
	
	return '
		<div class="qu-HowToItem" data-howtoitem="' . $attr['howtoItemId'] . '" 
			itemprop="step" itemscope itemtype="https://schema.org/HowToSection">
			<div class="qu-HowToItem__header">
				<h3 class="qu-HowToItem__header--text" itemprop="name">' .
					$attr['header'] 
		. ' </h3>
			</div>
			<div class="qu-HowToItem__content" itemprop="itemListElement" itemscope itemtype="https://schema.org/HowToStep">
				<div class="qu-HowToItem__content--inn" itemprop="text" >
				<meta itemprop="url" content="' . $protocol . urldecode( $referer ) . '#' . sanitize_title( $attr['header'] ) . '">
				<meta itemprop="name" content="' . $attr['header'] . '">' .
				( isset( $image ) ? '<meta itemprop="image" content="' . $image . '">' : null ) .
				( isset( $video ) ? '<meta itemprop="video" content="' . $video . '">' : null ) .
				$content
		. ' </div>
			</div>
		</div>';
}
