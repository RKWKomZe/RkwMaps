<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_map',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
        // do only make requestUpdate, if token-list should be shown on check
       // 'requestUpdate' => 'access_restricted',
		'searchFields' => 'name',
		'iconfile' => 'EXT:rkw_maps/Resources/Public/Icons/tx_rkwmaps_domain_model_map.gif'
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, items, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime, access_restricted'],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
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
				'foreign_table' => 'tx_rkwmaps_domain_model_map',
				'foreign_table_where' => 'AND tx_rkwmaps_domain_model_map.pid=###CURRENT_PID### AND tx_rkwmaps_domain_model_map.sys_language_uid IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
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
		'name' => [
			'exclude' => false,
			'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_map.name',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim, required'
			],
		],
		'items' => [
			'exclude' => false,
			'label' => 'LLL:EXT:rkw_maps/Resources/Private/Language/locallang_db.xlf:tx_rkwmaps_domain_model_item.items',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_rkwmaps_domain_model_item',
				'foreign_field' => 'map',
                'label' => 'foreign_table',
                'label_alt' => 'foreign_field, name',
                'label_alt_force' => 1,
				'maxitems' => 9999,
				'minitems' => 1,
				'appearance' => [
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				],
			],
		],
	],
];
