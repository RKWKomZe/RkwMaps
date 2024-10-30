<?php

namespace RKW\RkwMaps\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use RKW\RkwMaps\Domain\Repository\MapRepository;

/**
 * AbstractMapsController
 *
 * @author Christian Dilger <c.dilger@addorange.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwMaps
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AbstractMapsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var int
     */
    protected int $contentUid = 0;


    /**
     * @var \RKW\RkwMaps\Domain\Repository\MapRepository|null
     */
    protected ?MapRepository $mapRepository = null;


    /**
     * @param MapRepository $mapRepository
     */
    public function __construct(
        MapRepository $mapRepository
    ) {
        $this->mapRepository = $mapRepository;
    }


    /**
     * @return void
     */
    protected function getContentUid(): void
    {
        // @extensionScannerIgnoreLine
        $this->contentUid = (int)$this->configurationManager->getContentObject()->data['uid'];
    }

}
