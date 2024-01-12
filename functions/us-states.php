<?php

// USA states and their corresponding phone area codes, lowercase names, and ANSI codes
$us_states = array(
	'Alabama'         => array(
		'state_name'        => 'Alabama',
		'major_city'        => 'Birmingham',
		'area_codes'        => array( '205', '251', '256', '334', '938' ),
		'slug'              => 'alabama',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'AL',
	),
	'Alaska'          => array(
		'state_name'        => 'Alaska',
		'major_city'        => 'Anchorage',
		'area_codes'        => array( '907' ),
		'slug'              => 'alaska',
		'gmt_timezone_diff' => -9, // Alaska Time (GMT-9)
		'ansi_code'         => 'AK',
	),
	'Arizona'         => array(
		'state_name'        => 'Arizona',
		'major_city'        => 'Phoenix',
		'area_codes'        => array( '480', '520', '602', '623', '928' ),
		'slug'              => 'arizona',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'AZ',
	),
	'Arkansas'        => array(
		'state_name'        => 'Arkansas',
		'major_city'        => 'Little Rock',
		'area_codes'        => array( '501', '870' ),
		'slug'              => 'arkansas',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'AR',
	),
	'California'      => array(
		'state_name'        => 'California',
		'major_city'        => 'Los Angeles',
		'area_codes'        => array( '209', '213', '310', '323', '408', '415', '510', '530', '559', '562', '619', '626', '650', '707', '714', '760', '805', '818', '831', '858', '909', '916', '925', '949', '951' ),
		'slug'              => 'california',
		'gmt_timezone_diff' => -8, // Pacific Time (GMT-8)
		'ansi_code'         => 'CA',
	),
	'Colorado'        => array(
		'state_name'        => 'Colorado',
		'major_city'        => 'Denver',
		'area_codes'        => array( '303', '719', '720', '970' ),
		'slug'              => 'colorado',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'CO',
	),
	'Connecticut'     => array(
		'state_name'        => 'Connecticut',
		'major_city'        => 'Bridgeport',
		'area_codes'        => array( '203', '475', '860', '959' ),
		'slug'              => 'connecticut',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'CT',
	),
	'Delaware'        => array(
		'state_name'        => 'Delaware',
		'major_city'        => 'Wilmington',
		'area_codes'        => array( '302' ),
		'slug'              => 'delaware',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'DE',
	),
	'Florida'         => array(
		'state_name'        => 'Florida',
		'major_city'        => 'Miami',
		'area_codes'        => array( '239', '305', '321', '352', '386', '407', '561', '727', '754', '772', '786', '813', '850', '863', '904', '941', '954', '941' ),
		'slug'              => 'florida',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'FL',
	),
	'Georgia'         => array(
		'state_name'        => 'Georgia',
		'major_city'        => 'Atlanta',
		'area_codes'        => array( '229', '404', '470', '478', '678', '706', '762', '770', '912' ),
		'slug'              => 'georgia',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'GA',
	),
	'Hawaii'          => array(
		'state_name'        => 'Hawaii',
		'major_city'        => 'Honolulu',
		'area_codes'        => array( '808' ),
		'slug'              => 'hawaii',
		'gmt_timezone_diff' => -10, // Hawaii-Aleutian Time (GMT-10)
		'ansi_code'         => 'HI',
	),
	'Idaho'           => array(
		'state_name'        => 'Idaho',
		'major_city'        => 'Boise',
		'area_codes'        => array( '208' ),
		'slug'              => 'idaho',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'ID',
	),
	'Illinois'        => array(
		'state_name'        => 'Illinois',
		'major_city'        => 'Chicago',
		'area_codes'        => array( '217', '224', '309', '312', '331', '618', '630', '708', '773', '779', '815', '847', '872' ),
		'slug'              => 'illinois',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'IL',
	),
	'Indiana'         => array(
		'state_name'        => 'Indiana',
		'major_city'        => 'Indianapolis',
		'area_codes'        => array( '219', '260', '317', '463', '574', '765', '812', '930' ),
		'slug'              => 'indiana',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'IN',
	),
	'Iowa'            => array(
		'state_name'        => 'Iowa',
		'major_city'        => 'Des Moines',
		'area_codes'        => array( '319', '515', '563', '641', '712' ),
		'slug'              => 'iowa',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'IA',
	),
	'Kansas'          => array(
		'state_name'        => 'Kansas',
		'major_city'        => 'Wichita',
		'area_codes'        => array( '316', '620', '785', '913' ),
		'slug'              => 'kansas',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'KS',
	),
	'Kentucky'        => array(
		'state_name'        => 'Kentucky',
		'major_city'        => 'Louisville',
		'area_codes'        => array( '270', '364', '502', '606', '859' ),
		'slug'              => 'kentucky',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'KY',
	),
	'Louisiana'       => array(
		'state_name'        => 'Louisiana',
		'major_city'        => 'New Orleans',
		'area_codes'        => array( '225', '318', '337', '504', '985' ),
		'slug'              => 'louisiana',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'LA',
	),
	'Maine'           => array(
		'state_name'        => 'Maine',
		'major_city'        => 'Portland',
		'area_codes'        => array( '207' ),
		'slug'              => 'maine',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'ME',
	),
	'Maryland'        => array(
		'state_name'        => 'Maryland',
		'major_city'        => 'Baltimore',
		'area_codes'        => array( '240', '301', '410', '443' ),
		'slug'              => 'maryland',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'MD',
	),
	'Massachusetts'   => array(
		'state_name'        => 'Massachusetts',
		'major_city'        => 'Boston',
		'area_codes'        => array( '339', '351', '413', '508', '617', '774', '781', '857', '978' ),
		'slug'              => 'massachusetts',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'MA',
	),
	'Michigan'        => array(
		'state_name'        => 'Michigan',
		'major_city'        => 'Detroit',
		'area_codes'        => array( '231', '248', '269', '313', '517', '586', '616', '734', '810', '906', '947', '989' ),
		'slug'              => 'michigan',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'MI',
	),
	'Minnesota'       => array(
		'state_name'        => 'Minnesota',
		'major_city'        => 'Minneapolis',
		'area_codes'        => array( '218', '320', '507', '612', '651', '763', '952' ),
		'slug'              => 'minnesota',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'MN',
	),
	'Mississippi'    => array(
		'state_name'        => 'Mississippi',
		'major_city'        => 'Jackson',
		'area_codes'        => array( '228', '601', '662', '769' ),
		'slug'              => 'mississippi',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'MS',
	),
	'Missouri'       => array(
		'state_name'        => 'Missouri',
		'major_city'        => 'Kansas City',
		'area_codes'        => array( '314', '417', '573', '636', '660', '816' ),
		'slug'              => 'missouri',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'MO',
	),
	'Montana'        => array(
		'state_name'        => 'Montana',
		'major_city'        => 'Billings',
		'area_codes'        => array( '406' ),
		'slug'              => 'montana',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'MT',
	),
	'Nebraska'       => array(
		'state_name'        => 'Nebraska',
		'major_city'        => 'Omaha',
		'area_codes'        => array( '308', '402', '531' ),
		'slug'              => 'nebraska',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'NE',
	),
	'Nevada'         => array(
		'state_name'        => 'Nevada',
		'major_city'        => 'Las Vegas',
		'area_codes'        => array( '702', '725', '775' ),
		'slug'              => 'nevada',
		'gmt_timezone_diff' => -8, // Pacific Time (GMT-8)
		'ansi_code'         => 'NV',
	),
	'New Hampshire'  => array(
		'state_name'        => 'New Hampshire',
		'major_city'        => 'Manchester',
		'area_codes'        => array( '603' ),
		'slug'              => 'new-hampshire',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'NH',
	),
	'New Jersey'     => array(
		'state_name'        => 'New Jersey',
		'major_city'        => 'Newark',
		'area_codes'        => array( '201', '551', '609', '732', '848', '856', '862', '908', '973' ),
		'slug'              => 'new-jersey',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'NJ',
	),
	'New Mexico'     => array(
		'state_name'        => 'New Mexico',
		'major_city'        => 'Albuquerque',
		'area_codes'        => array( '505', '575' ),
		'slug'              => 'new-mexico',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'NM',
	),
	'New York'       => array(
		'state_name'        => 'New York',
		'major_city'        => 'New York City',
		'area_codes'        => array( '212', '315', '332', '347', '516', '518', '585', '607', '631', '646', '680', '716', '718', '838', '845', '914', '917', '929', '934' ),
		'slug'              => 'new-york',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'NY',
	),
	'North Carolina' => array(
		'state_name'        => 'North Carolina',
		'major_city'        => 'Charlotte',
		'area_codes'        => array( '252', '336', '704', '743', '828', '910', '919', '980', '984' ),
		'slug'              => 'north-carolina',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'NC',
	),
	'North Dakota'   => array(
		'state_name'        => 'North Dakota',
		'major_city'        => 'Fargo',
		'area_codes'        => array( '701' ),
		'slug'              => 'north-dakota',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'ND',
	),
	'Ohio'           => array(
		'state_name'        => 'Ohio',
		'major_city'        => 'Columbus',
		'area_codes'        => array( '216', '330', '419', '440', '513', '614', '740', '937' ),
		'slug'              => 'ohio',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'OH',
	),
	'Oklahoma'       => array(
		'state_name'        => 'Oklahoma',
		'major_city'        => 'Oklahoma City',
		'area_codes'        => array( '405', '539', '580' ),
		'slug'              => 'oklahoma',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'OK',
	),
	'Oregon'         => array(
		'state_name'        => 'Oregon',
		'major_city'        => 'Portland',
		'area_codes'        => array( '503', '541', '971' ),
		'slug'              => 'oregon',
		'gmt_timezone_diff' => -8, // Pacific Time (GMT-8)
		'ansi_code'         => 'OR',
	),
	'Pennsylvania'   => array(
		'state_name'        => 'Pennsylvania',
		'major_city'        => 'Philadelphia',
		'area_codes'        => array( '215', '267', '412', '484', '570', '717', '724', '814', '878' ),
		'slug'              => 'pennsylvania',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'PA',
	),
	'Rhode Island'   => array(
		'state_name'        => 'Rhode Island',
		'major_city'        => 'Providence',
		'area_codes'        => array( '401' ),
		'slug'              => 'rhode-island',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'RI',
	),
	'South Carolina' => array(
		'state_name'        => 'South Carolina',
		'major_city'        => 'Columbia',
		'area_codes'        => array( '803', '843', '854', '864' ),
		'slug'              => 'south-carolina',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'SC',
	),
	'South Dakota'   => array(
		'state_name'        => 'South Dakota',
		'major_city'        => 'Sioux Falls',
		'area_codes'        => array( '605' ),
		'slug'              => 'south-dakota',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'SD',
	),
	'Tennessee'      => array(
		'state_name'        => 'Tennessee',
		'major_city'        => 'Nashville',
		'area_codes'        => array( '423', '615', '629', '731', '865', '901', '931' ),
		'slug'              => 'tennessee',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'TN',
	),
	'Texas'          => array(
		'state_name'        => 'Texas',
		'major_city'        => 'Houston',
		'area_codes'        => array( '210', '214', '254', '281', '325', '361', '409', '430', '432', '469', '512', '682', '713', '737', '806', '817', '830', '832', '903', '915', '936', '940', '956', '972', '979' ),
		'slug'              => 'texas',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'TX',
	),
	'Utah'           => array(
		'state_name'        => 'Utah',
		'major_city'        => 'Salt Lake City',
		'area_codes'        => array( '385', '435', '801' ),
		'slug'              => 'utah',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'UT',
	),
	'Vermont'        => array(
		'state_name'        => 'Vermont',
		'major_city'        => 'Burlington',
		'area_codes'        => array( '802' ),
		'slug'              => 'vermont',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'VT',
	),
	'Virginia'       => array(
		'state_name'        => 'Virginia',
		'major_city'        => 'Virginia Beach',
		'area_codes'        => array( '276', '434', '540', '571', '703', '757', '804' ),
		'slug'              => 'virginia',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'VA',
	),
	'Washington'     => array(
		'state_name'        => 'Washington',
		'major_city'        => 'Seattle',
		'area_codes'        => array( '206', '253', '360', '425', '509' ),
		'slug'              => 'washington',
		'gmt_timezone_diff' => -8, // Pacific Time (GMT-8)
		'ansi_code'         => 'WA',
	),
	'West Virginia'  => array(
		'state_name'        => 'West Virginia',
		'major_city'        => 'Charleston',
		'area_codes'        => array( '304', '681' ),
		'slug'              => 'west-virginia',
		'gmt_timezone_diff' => -5, // Eastern Time (GMT-5)
		'ansi_code'         => 'WV',
	),
	'Wisconsin'      => array(
		'state_name'        => 'Wisconsin',
		'major_city'        => 'Milwaukee',
		'area_codes'        => array( '262', '414', '534', '608', '715', '920' ),
		'slug'              => 'wisconsin',
		'gmt_timezone_diff' => -6, // Central Time (GMT-6)
		'ansi_code'         => 'WI',
	),
	'Wyoming'        => array(
		'state_name'        => 'Wyoming',
		'major_city'        => 'Cheyenne',
		'area_codes'        => array( '307' ),
		'slug'              => 'wyoming',
		'gmt_timezone_diff' => -7, // Mountain Time (GMT-7)
		'ansi_code'         => 'WY',
	),
);
