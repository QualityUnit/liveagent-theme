<?php
/* Register Route for category and post image url. https://www.liveagent.com/wp-json/wp/v2/ms-awards/ */

add_action(
	'rest_api_init',
	function () {

		register_rest_field(
			'ms_awards',
			'ms_awards_years',
			array(
				'get_callback' => function ( $post ) {
					$category_ids = array();
					$category_names = array();
					$categories = get_the_terms( $post['id'], 'ms_awards_years' );
					if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
						foreach ( $categories as $category ) {
							$category_ids[] = $category->term_id;
							$category_names[] = $category->name;
						}
					}
					return array(
						'id' => $category_ids,
						'name' => $category_names,
					);
				},
				'schema' => null,
			)
		);


		register_rest_field(
			'ms_awards',
			'featured_media_url',
			array(
				'get_callback' => function ( $post ) {
					if ( has_post_thumbnail( $post['id'] ) ) {
						$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post['id'] ), 'full' );
						return $img_src[0];
					}
					return null;
				},
				'schema' => null,
			)
		);
	}
);
