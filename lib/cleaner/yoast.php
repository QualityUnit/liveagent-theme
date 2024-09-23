<?php

/**
  * Disable powered by text of Yoast SEO
  */

add_filter( 'wpseo_debug_markers', '__return_false' );


/**
  * Disable SearchAction Schema.org as we don't have search
	* https://developer.yoast.com/features/schema/pieces/searchaction/#disable-searchaction-output
  */

add_filter( 'disable_wpseo_json_ld_search', '__return_true' );
