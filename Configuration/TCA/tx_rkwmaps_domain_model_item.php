<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_item',
		'hideTable' => 1,
		'label' => 'district',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		/*'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		*/
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'district,content',
		'iconfile' => 'EXT:rkw_maps/Resources/Public/Icons/tx_rkwmaps_domain_model_item.gif'
	],
	'types' => [
		'1' => ['showitem' => 'hidden, district, content, map, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
	'columns' => [
	    /*
		'sys_language_uid' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_rkwmaps_domain_model_item',
				'foreign_table_where' => 'AND tx_rkwmaps_domain_model_item.pid=###CURRENT_PID### AND tx_rkwmaps_domain_model_map_item.sys_language_uid IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
	    */
		'hidden' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
				'items' => [
					'1' => [
						'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
					]
				],
			],
		],
		'starttime' => [
			'exclude' => false,
			//'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
                'renderType' => 'inputDateTime',
				'size' => 13,
				'eval' => 'datetime',
				'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
			]
		],
		'endtime' => [
			'exclude' => false,
			//'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
                'renderType' => 'inputDateTime',
				'size' => 13,
				'eval' => 'datetime',
				'default' => 0,
				'range' => [
					'upper' => mktime(0, 0, 0, 1, 1, 2038)
				],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
			],
		],
		'district' => [
			'exclude' => false,
			'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_item.district',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_rkwmaps_domain_model_district',
                'foreign_table_where' => 'ORDER BY tx_rkwmaps_domain_model_district.name',
                'maxitems'      => 1,
                'minitems'      => 1,
                'size'          => 5,
            ],
		],
        'content' => [
            'exclude' => false,
            'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_item.content',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim, required',
                'enableRichtext' => true,
            ],
        ],
		'map' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
	],
];
