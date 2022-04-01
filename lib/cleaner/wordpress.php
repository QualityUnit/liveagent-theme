<?php

/**
 * Remove info about WordPress in head
 */

remove_action( 'wp_head', 'wp_generator' );


/**
  * Remove links to the extra feeds (e.g. category feeds)
  */

remove_action( 'wp_head', 'feed_links_extra', 3 );


/**
  * Remove links to the general feeds (e.g. posts and comments)
  */

remove_action( 'wp_head', 'feed_links', 2 );


/**
  * Remove link to the RSD service endpoint, EditURI link
  */

remove_action( 'wp_head', 'rsd_link' );


/**
  * Remove link to the Windows Live Writer manifest file
  */

remove_action( 'wp_head', 'wlwmanifest_link' );


/**
  * Disable XML-RPC
  */

add_filter( 'xmlrpc_enabled', '__return_false' );
