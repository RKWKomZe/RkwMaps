<?php

namespace RKW\RkwMaps\Controller;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
class MapsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
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
     * action show
     *
     * @param \RKW\RkwMaps\Domain\Model\Map $map
     * @return void
     */
    public function showAction(\RKW\RkwMaps\Domain\Model\Map $map = null)
    {
        $this->initializeAction();

        if (!$map) {
            $map = $this->mapRepository->findByUid($this->settings['map']);
        }

        $this->pageRenderer = GeneralUtility::makeInstance( PageRenderer::class );

        // Inject necessary js libs
        $this->pageRenderer->addJsFooterLibrary(
            'svgJS', /* name */
            'https://unpkg.com/@svgdotjs/svg.js@3.0.16/dist/svg.min.js',
            'text/javascript', /* type */
            false, /* compress*/
            true, /* force on top */
            '', /* allwrap */
            true /* exlude from concatenation */
        );
        $this->pageRenderer->addJsFooterLibrary(
            'svgPanzoomJS', /* name */
            'https://unpkg.com/@svgdotjs/svg.panzoom.js@2.1.1/dist/svg.panzoom.min.js',
            'text/javascript', /* type */
            false, /* compress*/
            false, /* force on top */
            '', /* allwrap */
            true /* exlude from concatenation */
        );
        $this->pageRenderer->addJsFooterLibrary(
            'popperJS', /* name */
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js',
            'text/javascript', /* type */
            false, /* compress*/
            true, /* force on top */
            '', /* allwrap */
            true /* exlude from concatenation */
        );

        $mapScript = '
            const popperEl_' . $this->contentUid . ' = document.getElementById(\'popper\')
            let popperInstance_' . $this->contentUid . '
        
            const data_' . $this->contentUid . ' = ' . $map->getData() . '
            
            fetch(\'http://rkw-kompetenzzentrum.rkw.local/typo3conf/ext/rkw_maps/Resources/Public/Svg/germany-district-map-creative-commons-wiki.svg\')
                .then(response => response.text())
                .then((image) => {
                
                    let startOfSvg_' . $this->contentUid . ' = image.indexOf(\'<svg\')
                    startOfSvg_' . $this->contentUid . ' = startOfSvg_' . $this->contentUid . ' >= 0 ? startOfSvg_' . $this->contentUid . ' : 0
        
                    const draw_' . $this->contentUid . ' = SVG(image.slice(startOfSvg_' . $this->contentUid . '))
                        .addTo(\'#map_' . $this->contentUid . '\')
                        .size(\'100%\', 1000)
                        .panZoom({
                            zoomMin: 0.5,
                            zoomMax: 10, 
                            zoomFactor: 0.00000001
                        })
        
                    for (const region of draw_' . $this->contentUid . '.find(\'#districts .district\')) {
        
                        const regionClass = region.classes()[1]
                        const associatedRegions = draw_' . $this->contentUid . '.find(\'.\' + regionClass);
                        const regionValue = data_' . $this->contentUid . '[regionClass]
        
                        for (const associatedRegion of associatedRegions) {
                            if (typeof regionValue !== \'undefined\') {
                                associatedRegion.addClass(\'primary\')
                            }
                        }
                        
                        region.on(\'mouseover\', () => {
        
                            if (typeof regionValue !== \'undefined\') {
                                popperEl_' . $this->contentUid . '.innerHTML = `<strong>${region.attr(\'name\')}</strong><br>` + regionValue.content
                            } else {
                                popperEl_' . $this->contentUid . '.innerHTML = `<strong>${region.attr(\'name\')}</strong>`
                            }
        
                            popperEl_' . $this->contentUid . '.style.visibility = \'visible\'
                            popperInstance_' . $this->contentUid . ' = Popper.createPopper(region.node, popperEl_' . $this->contentUid . ', { placement: \'bottom\' })
                            
                        })
        
                        region.on(\'mouseleave\', () => {
        
                            popperEl_' . $this->contentUid . '.style.visibility = \'hidden\'
                            
                        })
                        
                    }
                    
                })
                    
        ';

        $this->pageRenderer->addJsFooterInlineCode( 'mapScript' . $this->contentUid, $mapScript, true );

        // Inject External Caption Menu CSS
        $this->pageRenderer->addFooterData(
            '<link rel="stylesheet" href="/typo3conf/ext/rkw_maps/Resources/Public/Css/Map.css" />'
        );

        // Inject map css
        $mapCss = '
		        #map_' . $this->contentUid . ' {
				}
			';

        $this->pageRenderer->addCssInlineBlock( 'mapCss_' . $this->contentUid, $mapCss, true );

        $this->view->assign( 'cUid', $this->contentUid );

    }

    /**
     * @return void
     */
    protected function initializeAction()
    {
        $this->getContentUid();
    }

    /**
     * @return void
     */
    protected function getContentUid()
    {
        $this->contentUid = (int)$this->configurationManager->getContentObject()->data['uid'];
    }

}
