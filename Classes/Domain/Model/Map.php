<?php

namespace RKW\RkwMaps\Domain\Model;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***
 *
 * This file is part of the "RKW Maps" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Dilger <c.dilger@addorange.de>
 *
 ***/

/**
 * Map
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * items
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwMaps\Domain\Model\Item>
     */
    protected $items;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->items = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the items
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwMaps\Domain\Model\Item> $items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Sets the items
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwMaps\Domain\Model\Item> $items
     * @return void
     */
    public function setItems(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $items)
    {
        $this->items = $items;
    }

    public function process()
    {
        $items = [];

        foreach ($this->getItems() as $item) {

            $district = $item->getDistrict()->current();

            $items[$district->getSlug()] = [
                'name' => $district->getName(),
                'content' => $item->getContent()
            ];

        }

        return json_encode($items);
    }

    public function getData()
    {
        //  get item data
        //  @todo: pre-render html in here

        //
//        $data = json_decode($this->settings['data'], true);
//
//
//        $renderedData = array_map()
//
//        exit();

        //  return $this->settings['data'];
    }

}