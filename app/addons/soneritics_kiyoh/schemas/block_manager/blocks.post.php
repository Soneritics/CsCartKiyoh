<?php
/* Copyright (C) Soneritics - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
$schema['soneritics_kiyoh_reviews'] = [
    'templates' => [
        'addons/soneritics_kiyoh/blocks/kiyoh_reviews.tpl' => [],
    ],
    'settings' => [
        'review_count_per_page' => [
            'type' => 'input',
            'default_value' => '25',
        ],
    ],
    'wrappers' => 'blocks/wrappers',
    'cache' => true
];

return $schema;
