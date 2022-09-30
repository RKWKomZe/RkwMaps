<?php

namespace RKW\RkwMaps\Controller;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3Fluid\Fluid\View\TemplateView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

/**
 * MapsController
 *
 * @author Christian Dilger <c.dilger@addorange.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwMaps
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GEMMapsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Expose the pageRenderer
     *
     * @var $pageRenderer
     */
    protected $pageRenderer;

    /**
     * mapRepository
     *
     * @var \RKW\RkwMaps\Domain\Repository\MapRepository
     * @inject
     */
    protected $mapRepository;

    /**
     * @var integer
     */
    protected $contentUid;

    /**
     * initializeAction
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function initializeAction(): void
    {
        parent::initializeAction();
        $this->getContentUid();
    }

    /**
     * @return void
     */
    protected function getContentUid()
    {
        $this->contentUid = (int)$this->configurationManager->getContentObject()->data['uid'];
    }

    /**
     * Method overrides is base method as base method relies
     * on objectManager to instantiate PageRenderer::class.
     * But PageRenderer::class is initially instantiated by
     * GeneralUtility::makeInstance, so the base method does not
     * append the assets. This function may be removed, if the
     * installation is upgraded to TYPO3 9.5.
     *
     * see https://forge.typo3.org/issues/89445
     *
     * @deprecated
     *
     * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request
     * @return void
     */
    protected function renderAssetsForRequest($request)
    {
        if (!$this->view instanceof TemplateView) {
            return;
        }
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $variables = ['request' => $request, 'arguments' => $this->arguments];
        $headerAssets = $this->view->renderSection('HeaderAssets', $variables, true);
        $footerAssets = $this->view->renderSection('FooterAssets', $variables, true);
        if (!empty(trim($headerAssets))) {
            $pageRenderer->addHeaderData($headerAssets);
        }
        if (!empty(trim($footerAssets))) {
            $pageRenderer->addFooterData($footerAssets);
        }
    }


    /**
     * action show
     *
     * @return void
     */
    public function gemAction()
    {
        $this->initializeAction();
    }

}
