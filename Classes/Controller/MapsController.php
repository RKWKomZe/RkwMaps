<?php

namespace RKW\RkwMaps\Controller;

use RKW\RkwMaps\Domain\Model\Map;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
 * MapsController
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
     * @var \RKW\RkwMaps\Domain\Model\Map
     */
    protected $map;

    /**
     * @var
     */
    protected $contentUid;

    /**
     * action show
     *
     * @return void
     */
    public function showAction()
    {
        $this->initializeAction();

        $this->pageRenderer = GeneralUtility::makeInstance( PageRenderer::class );

        $this->map = new Map($this->settings, $this->contentUid);

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
        
            // 2019 Belgian population by province
            const data_' . $this->contentUid . ' = ' . $this->map->getData() . '
            
            fetch(\'http://rkw-kompetenzzentrum.rkw.local/typo3conf/ext/rkw_maps/Resources/Public/Svg/germany-district-map-creative-commons-wiki.svg\')
                .then(response => response.text())
                .then((image) => {
                
                    let startOfSvg_' . $this->contentUid . ' = image.indexOf(\'<svg\')
                    startOfSvg_' . $this->contentUid . ' = startOfSvg_' . $this->contentUid . ' >= 0 ? startOfSvg_' . $this->contentUid . ' : 0
        
                    const draw_' . $this->contentUid . ' = SVG(image.slice(startOfSvg_' . $this->contentUid . '))
                        .addTo(\'#map_' . $this->contentUid . '\')
                        .size(\'100%\', 1000)
                        .panZoom()
        
                    for (const region of draw_' . $this->contentUid . '.find(\'#districts .district\')) {
        
                        const regionClass = region.classes()[1]
                        const associatedRegions = draw_' . $this->contentUid . '.find(\'.\' + regionClass);
                        const regionValue = data_' . $this->contentUid . '[regionClass]
        
                        region.on(\'mouseover\', () => {
        
                            for (const associatedRegion of associatedRegions) {
                                associatedRegion.addClass(\'primary\')
                            }
            
                            if (typeof regionValue !== \'undefined\') {
            
                                let companiesList = \'\';
            
                                regionValue.companies.forEach(function(company) {
                                    let string = \'\';
                                    string = `<p>${company.name}<br>`
                                        + `${company.employees} Angestellte<br>`
                                        + `<a href="${company.url}" target="_blank">${company.url}</a>`
                                        + `</p>`
        
                                    companiesList = companiesList + string
                                });
        
                                popperEl_' . $this->contentUid . '.innerHTML = `<strong>${region.attr(\'name\')}</strong><br>` + companiesList
            
                            } else {
        
                                popperEl_' . $this->contentUid . '.innerHTML = `<strong>${region.attr(\'name\')}</strong>`
        
                            }
        
                            popperEl_' . $this->contentUid . '.style.visibility = \'visible\'
                            popperInstance_' . $this->contentUid . ' = Popper.createPopper(region.node, popperEl_' . $this->contentUid . ', { placement: \'bottom\' })
                            
                        })
        
                        region.on(\'mouseleave\', () => {
        
                            for (const associatedRegion of associatedRegions) {
                                associatedRegion.removeClass(\'primary\')
                            }
            
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
		            border: 10px solid blue;
				}
			';

        $this->pageRenderer->addCssInlineBlock( 'mapCss_' . $this->contentUid, $mapCss, true );

        $this->view->assign( 'cUid', $this->contentUid );

//            $this->view->assignMultiple($this->graph->process());

//        $this->addRenderCallToFooter();

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

    /**
     * @return void
     */
    protected function addRenderCallToFooter()
    {
        $txRkwMapsElement = 'txRkwMapsElement' . $this->contentUid;

        $GLOBALS['TSFE']->additionalFooterData[$txRkwMapsElement] = '
            <script type="text/javascript">

            </script>

        ';

    }

}
