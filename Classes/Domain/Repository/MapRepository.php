<?php

namespace RKW\RkwMaps\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

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
 * The repository for Maps
 */
class MapRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => QueryInterface::ORDER_ASCENDING,
    );
}
