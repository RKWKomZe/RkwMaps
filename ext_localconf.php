<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {

        //=================================================================
        // Configure Plugin
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.RkwMaps',
            'Maps',
            [
                'Maps' => 'show'
            ],
            // non-cacheable actions
            [
                'Maps' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'RKW.RkwMaps',
            'GEMMaps',
            [
                'GEMMaps' => 'gem'
            ],
            // non-cacheable actions
            [
                'GEMMaps' => ''
            ]
        );
    },
    'rkw_maps'
);
