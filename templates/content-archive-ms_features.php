<?php // @codingStandardsIgnoreLine
set_source('features', 'pages/Category', 'css');
set_source('features', 'pages/CategoryImages', 'css');
set_source('features', 'pages/CategoryLabelColors', 'css');
set_source('features', 'filter', 'js');
$categories = array_unique(get_categories([ 'taxonomy' => 'ms_features_categories' ]), SORT_REGULAR);
if (is_tax('ms_features_categories') === true) :
    $pageHeaderTitle       = single_cat_title();
    $pageHeaderDescription = the_archive_description();
else :
    $pageHeaderTitle       = __('Features', 'ms');
    $pageHeaderDescription = __('Get to know all LiveAgent features, that are part of the complex multi-channel help desk software. Described in one place and in depth.', 'ms');
endif;
$filterItemsCategories = [
    [
        'checked' => true,
        'value'   => '',
        'title'   => __('Any', 'ms'),
    ],
];
foreach ($categories as $category) :
    $filterItemsCategories[] = [
        'value' => $category->slug,
        'title' => $category->name,
    ];
endforeach;
$filterItems    = [
    [
        'type'  => 'radio',
        'name'  => 'collections',
        'title' => __('Collections', 'ms'),
        'items' => [
            [
                'checked' => true,
                'value'   => '',
                'title'   => __('Any', 'ms'),
            ],
            [
                'value' => 'featured',
                'title' => __('Featured', 'ms'),
            ],
            [
                'value' => 'popular',
                'title' => __('Popular', 'ms'),
            ],
            [
                'value' => 'new',
                'title' => __('New', 'ms'),
            ],
        ],
    ],
    [
        'type'  => 'radio',
        'name'  => 'plan',
        'title' => __('Available in', 'ms'),
        'items' => [
            [
                'checked' => true,
                'value'   => '',
                'title'   => __('Any', 'ms'),
            ],
            [
                'value' => 'free',
                'title' => __('Free', 'ms'),
            ],
            [
                'value' => 'ticket',
                'title' => __('Small', 'ms'),
            ],
            [
                'value' => 'ticket-chat',
                'title' => __('Medium', 'ms'),
            ],
            [
                'value' => 'all-inclusive',
                'title' => __('Large', 'ms'),
            ],
            [
                'value' => 'extensions',
                'title' => __('Extensions', 'ms'),
            ],
        ],
    ],
    [
        'type'  => 'radio',
        'name'  => 'size',
        'title' => __('Suitable for', 'ms'),
        'items' => [
            [
                'checked' => true,
                'value'   => '',
                'title'   => __('Any', 'ms'),
            ],
            [
                'value' => 'individuals',
                'title' => __('Individuals', 'ms'),
            ],
            [
                'value' => 'start-ups',
                'title' => __('Start-ups', 'ms'),
            ],
            [
                'value' => 'smbs',
                'title' => __('SMBs', 'ms'),
            ],
            [
                'value' => 'enterprise',
                'title' => __('Enterprise', 'ms'),
            ],
        ],
    ],
    [
        'type'  => 'radio',
        'name'  => 'category',
        'title' => __('Category', 'ms'),
        'items' => $filterItemsCategories,
    ],
];
$pageHeaderArgs = [
    'type'   => 'lvl-1',
    'image'  => [
        'src' => get_template_directory_uri().'/assets/images/compact_header_features.png?ver='.THEME_VERSION,
        'alt' => $pageHeaderTitle,
    ],
    'title'  => $pageHeaderTitle,
    'text'   => $pageHeaderDescription,
    'filter' => $filterItems,
    'search' => ['type' => 'academy'],
];
?>

<div id="category" class="Category">
    <?php get_template_part('lib/custom-blocks/compact-header', null, $pageHeaderArgs); ?>

    <div class="wrapper Category__container">
        <div class="Category__content">
            <ul class="Category__content__items list">
                <?php
                while (have_posts() === true) :
                    the_post();
                    ?>

                    <?php
                    $collections = '';
                    $plan        = '';
                    $size        = '';
                    $category    = '';

                    $futurePlans       = (get_post_meta(get_the_ID(), 'mb_features_mb_features_plan', true) ?? '');
                    $futureSizes       = (get_post_meta(get_the_ID(), 'mb_features_mb_features_size', true) ?? '') ;
                    $futureCollections = (get_post_meta(get_the_ID(), 'mb_features_mb_features_collections', true) ?? '');


                    if ($futurePlans === true) {
                        $plan = implode(' ', $futurePlans);
                    }

                    if ($futureSizes === true) {
                        $size = implode(' ', $futureSizes);
                    }

                    if ($futureCollections === true) {
                        $collections = implode(' ', $futureCollections);
                    }


                    $categories  = get_the_terms(0, 'ms_features_categories');
                    $currentLang = apply_filters('wpml_current_language', null);
                    do_action('wpml_switch_language', 'en');
                    $categoriesEn = get_the_terms(0, 'ms_features_categories');
                    if (empty($categoriesEn) === false) {
                        $categoryEn = array_shift($categoriesEn)->slug;
                    }

                    do_action('wpml_switch_language', $currentLang);
                    if (empty($categories) === false) {
                        foreach ($categories as $categoryItem) {
                            $categoryItem = array_shift($categories);
                            $category    .= $categoryItem->slug;
                            $category    .= ' ';
                        }
                    }

                    $category = substr($category, 0, -1);

                    ?>

                    <?php
                    // Element classes.
                    $pillarValue = (get_post_meta(get_the_ID(), 'mb_features_mb_features_pillar', true) ?? '');
                    $pillarClass = '';
                    if ($pillarValue === 'on') {
                            $pillarClass = 'pillar';
                    }

                    $categoryItemClasses = 'Category__item redesign Category__item--features '.$pillarClass.' '.esc_attr($category).' '.esc_attr($categoryEn);

                    // Element attributes.
                    $categoryItemAttributes = [
                        'data-plan'        => esc_attr($plan),
                        'data-collections' => esc_attr($collections),
                        'data-size'        => esc_attr($size),
                        'data-category'    => esc_attr($category),
                        'data-href'        => get_permalink(),
                    ];
                    if ($pillarValue === 'on') : ?>
                            <li class="<?php echo $categoryItemClasses ?>" <?php foreach ($categoryItemAttributes as $name => $value) {
                                echo $name.'="'.$value.'" ';
                                       } ?>>
                            <a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
                                <span class="Category__item__thumbnail__image"></span>
                            </a>
                            <div class="Category__item__wrap">
                                <h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="Category__item__excerpt item-excerpt">
                                    <a href="<?php the_permalink(); ?>">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 14)); ?>
                                    </a>
                                </div>
                                <a class="Category__item__cta" href="<?php the_permalink(); ?>"><?php _e('Learn more', 'ms'); ?></a>
                            </div>
                            </li>
        <?php else : ?>
                            <li class="<?php echo $categoryItemClasses ?>" <?php foreach ($categoryItemAttributes as $name => $value) {
                                echo $name.'="'.$value.'" ';
}?>>
                                <div class="Category__item__wrap">
                                    <div class="Category__item__header">
            <?php
            if (has_post_thumbnail() === true) {
                the_post_thumbnail('archive_thumbnail');
            } else { ?>
                                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e('Features', 'ms'); ?>">
            <?php	} ?>
                                        <div class="Category__item__header__label">
                                            <span class="Category__item__header__label_text">Ticketing system</span>
                                        </div>
                                    </div>
                                    <div class="Category__item__content">
                                        <h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="Category__item__excerpt item-excerpt">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 14)); ?>
                                            </a>
                                        </div>
                                        <a class="Category__item__cta" href="<?php the_permalink(); ?>"><?php _e('Learn more', 'ms'); ?></a>
                                    </div>
                                </div>
                            </li>
        <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>
