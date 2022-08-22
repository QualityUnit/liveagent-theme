<?php

if ( ! file_exists( wp_get_upload_dir()['basedir'] . "/cache/youtube/" ) ) {//@codingStandardsIgnoreLine
		mkdir( wp_get_upload_dir()['basedir'] . "/cache/youtube/", 0777, true );//@codingStandardsIgnoreLine
}

function yt_videodetails( $video_id ) {
	// settings
	$api_key = $_ENV['YOUTUBE_API_KEY'];
	$ytid    = $video_id;
	$url     = 'https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet%2CcontentDetails&contentDetails.duration&id=' . $ytid . '&key=' . $api_key; // json source
	
	$cache         = wp_get_upload_dir()['basedir'] . "/cache/youtube/" . $ytid . ".cache";//@codingStandardsIgnoreLine
	$cache_exists  = file_exists( wp_get_upload_dir()['basedir'] . "/cache/youtube/" . $ytid . ".cache" );//@codingStandardsIgnoreLine
	$force_refresh = false; // dev
	$refresh       = 60 * 60 * 24; // once a day

	// read json source
	if ( ! $cache_exists ) {
		$json_cache = wp_remote_get( //@codingStandardsIgnoreLine
			$url,
			array(
				'sslverify' => false,
			) 
		)['body'];
	
		$video_info = json_decode(
			$json_cache,
			false 
		);
		if ( isset( $video_info->items[0] ) ) {
			$handle = fopen( $cache, 'wb' ) or die( 'no fopen' );
				fwrite( $handle, $json_cache ); 
				fclose( $handle );
				return $video_info->items[0];
		}
	}
	if ( $cache_exists ) {
		// cache json results so to not over-query (api restrictions)
		if ( $force_refresh ) {
			$handle = fopen( $cache, 'wb' ) or die( 'no fopen' );
			fwrite( $handle, $json_cache ); 
			fclose( $handle );
		} else {
			$json_cache = file_get_contents( $cache ); // @codingStandardsIgnoreLine
		}
		$video_info = json_decode(
			$json_cache,
			false 
		);
		if ( $video_info ) {
			return $video_info->items[0];
		}
	}
	return null;
}

function yt_microdata( $video_id ) {
	$data = yt_videodetails( $video_id );

	if ( isset( $data ) ) {
		$channel = yt_videodetails( $video_id )->snippet->channelTitle;
	
		if ( 'Live Agent' === $channel ) {
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

// /**
//  * Youtube iframe replacemenets with image, loading YT on click
//  */

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

function elementor_youtube_loader( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath         = new DOMXPath( $dom );
	$parent        = "//div[contains(@class, 'elementor-widget-video')]";
	$parent_blocks = $xpath->query( $parent );

	foreach ( $parent_blocks as $parent_block ) {
			$settings = $parent_block->getAttribute( 'data-settings' );
			$child    = $xpath->query( "//div[@data-settings='" . $settings . "']//div[contains(@class, 'elementor-video')]" );
			preg_match( '/(youtube|youtu)(\.com|\.be)((\\\\\/)(.+?))"/', $settings, $ytid );
			
		if ( isset( $ytid[5] ) ) {
			$ytid           = str_replace( 'watch?v=', '', $ytid[5] );
			$youtube_loader = $dom->createElement( 'div' );
			$youtube_loader->setAttribute( 'class', 'youtube__loader youtube__loader--elementor' );
			$youtube_loader->setAttribute( 'data-ytid', $ytid );
				
			$youtube_img = $dom->createElement( 'img' );
			$youtube_img->setAttribute( 'class', 'youtube__loader--img' );
			$youtube_img->setAttribute( 'data-lasrc', 'https://i.ytimg.com/vi/' . $ytid . '/hqdefault.jpg' );
			$youtube_img->setAttribute( 'style', 'opacity: 0; transition: opacity .5s' );
			$youtube_img->setAttribute( 'alt', 'Youtube video ' . $ytid );
	
			$youtube_loader->appendChild( $youtube_img );
	
			if ( ! empty( yt_microdata( $ytid ) ) ) {
				$schema = new DOMDocument();
				$schema->loadHTML( yt_microdata( $ytid ) );
			}
				
			if ( $child->length ) {
				$child->item( 0 )->appendChild( $youtube_loader );
				if ( isset( $schema ) ) {
					$child->item( 0 )->appendChild( $dom->importNode( $schema->documentElement, true ) ); // @codingStandardsIgnoreLine
				}
			}
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_youtube_loader', 10 );
