<?php

return [
    // categories
    'DEFAULT' => '0',
    'COMMERCIAL' => '1',
    'RESIDENTIAL' => '2',
    'MULTI_UNIT' => '3',
    'PLOT_LAND' => '4',
    'UNDER_CONSTRUCTION' => '5',
    'DEMOLISHED' => '6',
    'APARTMENT' => '7',
    'INDEPENDENT_HOUSE_VILLA' => '8',
    'STAND_ALONE_APARTMENT' => '9',
    'GATED_COMMUNITY_APARTMENT' => '10',
    'INDIVIDUAL_HOUSE_APARTMENT' => '11',
    'GATED_COMMUNITY_VILLA' => '12',
    'OPEN_PLOT_LAND' => '13',
    'GATED_COMMUNITY_PLOT_LAND' => '14',
    'COMMERCIAL_BUILDING' => '15',
    'COMMERCIAL_TOWER' => '16',
    'SEMI_GATED_COMMUNITY' => '17',

    // floor unit categories
    'VACANT' => '1',
    'OCCUPIED' => '2',
    'OFFICE' => '102',
    'HOSPITALITY_HOTEL' => '109',

    'FOR_SALE' => 1,
    'FOR_RENT' => 2,
    'RENTED' => 3,
    'SOLD' => 4,
    'PRICE_CHANGE' => 5,
    'RELISTED_RENT' => 6,
    'RELISTED_SALE' => 7,

    'FLOOR_UNIT_CATEGORY' => [
        'VACANT' => '1',
        'OCCUPIED' => '2',
        'OFFICE' => '102',
        'HOSPITALITY_HOTEL' => '109',
        'RETAIL' => '104',
        'STORAGE_INDUSTRY' => '150',
        'OTHER_COMMERCIAL' => '151',
        'STAND_ALONE_APARTMENT' => '1',
        'SERVICED_APARTMENT' => '2',
        'ONE_RK_APARTMENT' => '3',
    ],

    // Add more constants as needed

    'PROJECT_STATUS' => [
        'GROUNDED' => 1, //Pre Launch
        'UNDER_CONSTRUCTION' => 2,
        'COMPLETED' => 3,
        'EXTERIOR_WORKS' => 4,
    ],

    'UNIT_PRICE_LOG_STATUS' => [
        '1' => 'Listed For Sale', 
        '2' => 'Listed For Rent',
        '3' => 'Rented',            
        '4' => 'Sold',
        '5' => 'price changed',
        '6' => 'Re-listed for Rent',
        '7' => 'Re-listed for Sale',
    ],

    'AREA_TYPES' => [
         ['id' => 1, 'name'=>'Carpet Area'], 
         ['id' => 2, 'name'=>'Build-up Area'], 
         ['id' => 3, 'name'=>'Super Build-up Area'], 
    ],

    'SALE_STATUS' =>[
        1=>'New',
        2=>'Resale'
    ]

];
