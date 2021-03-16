<?php

namespace RKW\RkwMaps\Domain\Model;

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
 * Item
 */
class Item extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * district
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RKW\RkwMaps\Domain\Model\District>
     */
    protected $district;

    /**
     * content
     *
     * @var string
     * @validate NotEmpty
     */
    protected $content = '';

    /**
     * Returns the content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Returns the district
     *
     * @return string $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Sets the district
     *
     * @param string $district
     * @return void
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

}