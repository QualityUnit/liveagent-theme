<?php
// Disable Speculative Loading via the Speculation Rules API (since WordPress v6.8).
add_filter( 'wp_speculation_rules_configuration', '__return_null' );
