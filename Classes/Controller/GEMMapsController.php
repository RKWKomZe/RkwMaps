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

        $content = [
            'method' => [
                'href' => 'https://example.org?methods',
                'text' => 'Sie haben Fragen zur Methodik? Hier finden Sie alle Details.'
            ],
            'material' => [
                'quota' => [
                    'tabs' => [
                        [
                            'id' => 'gruendungsgeschehen',
                            'title' => 'Gründungsgeschehen',
                            'content' => [
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/latest-global-report',
                                    'text' => 'Global Entrepreneurship Monitor Global Report (2022)'
                                ],
                                [
                                    'href' => 'http://rkw.link/gem2022',
                                    'text' => 'Global Entrepreneurship Monitor Länderbericht Deutschland (2022)'
                                ],
                            ]
                        ],
                        [
                            'id' => 'migrantisches-unternehmertum',
                            'title' => 'Migrantisches Unternehmertum',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/faktenblatt/global-entrepreneurship-monitor-aktuell-gruendende-mit-einwanderungsgeschichte/',
                                    'text' => 'Global Entrepreneurship Monitor aktuell: Gründende mit Einwanderungsgeschichte (2022)'
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/migrantinnen-und-migranten-treiben-die-deutsche-gruendungsszene-an/',
                                    'text' => 'Migrantinnen und Migranten treiben die deutsche Gründungsszene an!(2022)'
                                ],
                            ]
                        ]
                    ]
                ],
                'attitudes' => [
                    'tabs' => [
                        [
                            'id' => '',
                            'title' => '',
                            'content' => [
                                [
                                    'href' => 'http://rkw.link/gem2022',
                                    'text' => 'Global Entrepreneurship Monitor Länderbericht Deutschland (2022)'
                                ],
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/latest-global-report',
                                    'text' => 'Global Entrepreneurship Monitor Global Report (2022)'
                                ],
                            ]
                        ],
                    ]
                ]
            ],
            'examples' => [
                'DE-BW' => [
                    'quota' => [
                        'tea' => [
                            [
                                'href' => 'http://example.org?bwtea1',
                                'text' => 'Link BW tea 1'
                            ],
                            [
                                'href' => 'http://example.org?bwtea2',
                                'text' => 'Link BW tea 2'
                            ]
                        ],
                        'female' => [
                            [
                                'href' => 'http://example.org?bwfemale1',
                                'text' => 'Link BW female 1'
                            ],
                            [
                                'href' => 'http://example.org?bwfemale2',
                                'text' => 'Link BW female 2'
                            ]
                        ],
                        'male' => [
                            [
                                'href' => 'http://example.org?bwmale1',
                                'text' => 'Link BW male 1'
                            ],
                            [
                                'href' => 'http://example.org?bwmale2',
                                'text' => 'Link BW male 2'
                            ]
                        ]
                    ]
                ],
                'DE-BY' => [
                    'quota' => [
                        'tea' => [
                            [
                                'href' => 'http://example.org?bytea1',
                                'text' => 'Link BY tea 1'
                            ],
                            [
                                'href' => 'http://example.org?bytea2',
                                'text' => 'Link BY tea 2'
                            ]
                        ],
                        'female' => [
                            [
                                'href' => 'http://example.org?byfemale1',
                                'text' => 'Link BY female 1'
                            ],
                            [
                                'href' => 'http://example.org?byfemale2',
                                'text' => 'Link BY female 2'
                            ]
                        ],
                        'male' => [
                            [
                                'href' => 'http://example.org?bymale1',
                                'text' => 'Link BY male 1'
                            ],
                            [
                                'href' => 'http://example.org?bymale2',
                                'text' => 'Link BY male 2'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->view->assignMultiple([
            'content' => json_encode($content)
        ]);
    }

}
