<?php
add_filter( 'simple_register_metaboxes', 'landing_ppc_metaboxes' );

function landing_ppc_metaboxes( $sidebars ) {

	$sidebars[] = array(
		'id'        => 'landingppc',
		'name'      => 'Custom fields',
		'post_type' => array( 'ms_landing' ),
		'fields'    => array(
			array(
				'id'           => 'title',
				'label'        => 'Main title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'Provide excellent customer service.',
			),
			array(
				'id'           => 'subtitle',
				'label'        => 'Subtitle',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'Answer more tickets with <br> all-in-one customer care solution.',
			),
			array(
				'id'           => 'media',
				'label'        => 'Header Media',
				'description'  => '',
				'type'         => 'image',
				'show_in_rest' => true,
				'default'      => '',
			),
			array(
				'id'           => 'form_title',
				'label'        => 'Signup Left title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'One solution for every business',
			),
			array(
				'id'           => 'form_subtitle',
				'label'        => 'Signup Left Subtitle',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'Get an efficient customer communication solution and streamline business growth with improved customer satisfaction. LiveAgent is the right help desk software for various business types.',
			),
			array(
				'id'           => 'col_title',
				'label'        => '3 columns title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'What are the benefits of help desk software?',
			),
			array(
				'id'           => 'col_subtitle',
				'label'        => '3 columns Subtitle',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'Take a look at the key features and benefits you get when you pick LiveAgent as a dedicated help desk and communication afor your business.',
			),
			array(
				'id'           => 'box1_title',
				'label'        => 'Box 1 Title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
				'default'      => 'Organize your team with collaboration tools',
			),
			array(
				'id'           => 'box1_text',
				'label'        => 'Box 1 Text',
				'description'  => '',
				'type'         => 'textarea',
				'show_in_rest' => true,
				'default'      => 'Customer service teams can use a collaborative inbox and other tools to work in tight integration with each other. Customer service teams can use a collaborative inbox and other tools.',
			),
			array(
				'id'          => 'box2_title',
				'label'       => 'Box 2 Title',
				'description' => '',
				'type'        => 'text',
				'default'     => 'Measure performance with custom reports',
			),
			array(
				'id'          => 'box2_text',
				'label'       => 'Box 2 Text',
				'description' => '',
				'type'        => 'textarea',
				'default'     => 'Get important data, use it to improve, and provide awesome customer service thanks to analytics from custom reports. Get important data, use it to improve, and provide awesome customer service.',
			),
			array(
				'id'          => 'box3_title',
				'label'       => 'Box 3 Title',
				'description' => '',
				'type'        => 'text',
				'default'     => 'Get rid of late replies to your customers',
			),
			array(
				'id'          => 'box3_text',
				'label'       => 'Box 3 Text',
				'description' => '',
				'type'        => 'textarea',
				'default'     => 'Deliver consistent customer service across all channels with faster response times. Use SLAs to prioritize customer emails. Deliver consistent customer service across all channels with faster.',
			),
		),
	);

	return $sidebars;
}
