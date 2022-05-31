<?php

function yt_videodetails( $video_id ) {
	// settings
	$api_key       = $_ENV['YOUTUBE_API_KEY'];
	$ytid          = $video_id;
	$url           = 'https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet%2CcontentDetails&contentDetails.duration&id=' . $ytid . '&key=' . $api_key; // json source
	$cache         = wp_get_upload_dir()['basedir'] . "/youtube_cache/" . $ytid . ".cache";//@codingStandardsIgnoreLine
	$force_refresh = false; // dev
	$refresh       = 60 * 60 * 24; // once a day

	// cache json results so to not over-query (api restrictions)
	if ( $force_refresh || ( ( time() - filectime( $cache ) ) > ( $refresh ) || 0 == filesize( $cache ) ) ) {

		// read json source
		$json_cache = wp_remote_get( //@codingStandardsIgnoreLine
			$url,
			array(
				'sslverify' => false,
			) 
		)['body'];
		$handle     = fopen( $cache, 'wb' ) or die( 'no fopen' );
		fwrite( $handle, $json_cache ); 
		fclose( $handle );
	} else {
		$json_cache = file_get_contents( $cache ); // @codingStandardsIgnoreLine
	}

	$video_info = json_decode(
		$json_cache,
		false 
	);

	if ( isset( $video_info->items[0] ) ) {
		return $video_info->items[0];
	}
	return null;
}

function yt_microdata( $video_id ) {
	$data = yt_videodetails( $video_id );

	if ( isset( $data ) ) {
		$channel = yt_videodetails( $video_id )->snippet->channelTitle;
	
		if ( 'Post Affiliate Pro' === $channel ) {
			$name        = yt_videodetails( $video_id )->snippet->title;
			$description = yt_videodetails( $video_id )->snippet->description;
			$uploaded    = yt_videodetails( $video_id )->snippet->publishedAt;
			$duration    = yt_videodetails( $video_id )->contentDetails->duration;
			$thumbnail   = yt_videodetails( $video_id )->snippet->thumbnails->maxres->url;
			return '
				<div itemprop="video" itemscope itemtype="https://schema.org/VideoObject">
					<meta itemprop="name" content="' . $name . '" />
					<meta itemprop="description" content="' . $description . '" />
					<link itemprop="thumbnailUrl" content="' . $thumbnail . '" />
					<link itemprop="contentUrl" content="https://www.youtube.com/watch?v=' . $video_id . '" />
					<link itemprop="embedUrl" content="https://www.youtube.com/embed/' . $video_id . '" />
					<meta itemprop="duration" content="' . $duration . '" />
					<meta itemprop="uploadDate" content="' . $uploaded . '" />
				</div>
			';
		}
	}
	return false;
}

function add_yt_microdata( $html ) {
	$html = preg_replace_callback(
		'/(\<.+data-ytid="(.+?)".+\>)/',
		function ( $m ) {
				return yt_microdata( $m[2] ) . $m[1];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'add_yt_microdata', 10 );

/**
 * Youtube iframe replacemenets with image, loading YT on click
 */

function youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?title="(.+).+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?"(.+\>)/',
		function ( $m ) {
				return yt_microdata( $m[4] ) . '
				<div class="youtube__loader" title="' . $m[1] . '" data-ytid="' . $m[4] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[1] . '">
				</div>';
		},
		$html
	);

	return $html;
}

add_filter( 'the_content', 'youtube_loader', 10 );

function youtube_loader2( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?".+?title="(.+?)"(.+?\>)/',
		function ( $m ) {
				return yt_microdata( $m[3] ) . '
				<div class="youtube__loader" title="' . $m[5] . '" data-ytid="' . $m[3] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[3] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[5] . '">
				</div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'youtube_loader2', 10 );

function elementor_youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<div(.+)elementor-widget-video.+data-settings=.+(youtube\.com|youtu\.be)\\\\\/(watch\?v=)?(.+?)(&amp;|&quot;|\?)(.+?\>)((\n.+?)+)?(.+elementor-video.+?\>)/',
		function ( $m ) {
				return yt_microdata( $m[4] ) . '<div' . $m[1] . ' elementor-widget-video">' . $m[7] . $m[9] . '<div class="youtube__loader youtube__loader--elementor" title="" data-ytid="' . $m[4] . '" data-width="" data-height=""><img class="youtube__loader--img" data-src="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt=""></div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'elementor_youtube_loader', 10 );
