<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_district',
		'label' => 'name',
        'adminOnly' => true,
        'rootLevel' => 1,
        'is_static' => 1,
        'readOnly' => 1,
        'default_sortby' => 'ORDER BY name',
        'delete' => 'deleted',
        // do only make requestUpdate, if token-list should be shown on check
       // 'requestUpdate' => 'access_restricted',
		'searchFields' => 'name',
		'iconfile' => 'EXT:rkw_maps/Resources/Public/Icons/tx_rkwmaps_domain_model_district.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'name, slug',
	],
	'columns' => [
        'deleted' => [
            'readonly' => 1,
            'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_district.deleted',
            'config' => [
                'type' => 'check',
            ],
        ],
		'name' => [
			'exclude' => false,
			'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_district.name',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim, required'
			],
		],
        'slug' => [
            'exclude' => false,
            'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_district.slug',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ],
        ],
	],
];
