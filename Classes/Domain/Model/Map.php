<?php

namespace RKW\RkwMaps\Domain\Model;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***
 *
 * This file is part of the "RKW FeeCalculator" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Christian Dilger <c.dilger@addorange.de>
 *
 ***/

/**
 * Map
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    protected $contentUid;

    protected $settings;

    protected $chartType;

    /**
     * @var array
     */
    protected $generalOptions;

    /**
     * Map constructor.
     *
     * @param $settings
     * @param $contentUid
     */
    public function __construct($settings, $contentUid)
    {
        $this->settings = $settings;
        $this->contentUid = $contentUid;

        $this->generalOptions = $this->setGeneralOptions();
    }

    public function getData()
    {
        //  @todo: pre-render html in here

        //
//        $data = json_decode($this->settings['data'], true);
//
//
//        $renderedData = array_map()
//
//        exit();

        return $this->settings['data'];
    }

    /**
     * @return mixed
     */
    public function getChartType()
    {
        return $this->chartType;
    }

    /**
     * @return array
     */
    public function setGeneralOptions()
    {
        $scriptType = 'text/javascript';

        $title = $this->settings['title'];

        return compact(
            'scriptType',
            'title'
        );
    }

    /**
     * @return array
     */
    public function process()
    {
        return array_merge($this->generalOptions, [
            'contentUid' => $this->contentUid
        ]);
    }
}