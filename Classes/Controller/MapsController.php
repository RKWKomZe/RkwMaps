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

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * MapsController
 *
 * @author Christian Dilger <c.dilger@addorange.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwMaps
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class MapsController extends \RKW\RkwMaps\Controller\AbstractMapsController
{

    /**
     * @var \TYPO3\CMS\Core\Page\PageRenderer|null
     */
    protected ?PageRenderer $pageRenderer = null;


    /**
     * action show
     *
     * @param \RKW\RkwMaps\Domain\Model\Map|null $map
     * @return void
     */
    public function showAction(\RKW\RkwMaps\Domain\Model\Map $map = null)
    {
        $this->getContentUid();

        if (!$map) {
            $map = $this->mapRepository->findByUid($this->settings['map']);
        }

        /** @todo: loading external script which may cause issues with data privacy! */
        $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $this->pageRenderer->addJsFooterLibrary(
            'popperJS', /* name */
            'https://unpkg.com/@popperjs/core@2',
            'text/javascript', /* type */
            false, /* compress*/
            false, /* force on top */
            '', /* allwrap */
            true /* exlude from concatenation */
        );

        $this->pageRenderer->addJsFooterLibrary(
            'tippyJS', /* name */
            'https://unpkg.com/tippy.js@6',
            'text/javascript', /* type */
            false, /* compress*/
            false, /* force on top */
            '', /* allwrap */
            true /* exlude from concatenation */
        );

        /** @todo Mixture of frontend-code with backend-code. Bad habits */
        $mapScript = '
            const data_' . $this->contentUid . ' = ' . $map->getData() . '
            const map_' . $this->contentUid . ' = $(\'#map_' . $this->contentUid . '\')

            for (let region of map_' . $this->contentUid . '.find(\'#districts .district\')) {

                const regionClass = region.classList[1]
                const regionValue = data_' . $this->contentUid . '[regionClass]
                const regionName = $(region).attr(\'name\')
                const associatedRegions = map_' . $this->contentUid . '.find(\'.\' + regionClass);

                for (const associatedRegion of associatedRegions) {

                    let $associatedRegion = $(associatedRegion)

                    if (typeof regionValue !== \'undefined\') {
                        $associatedRegion.addClass(\'primary\')
                        $associatedRegion.addClass(\'is-marked\')
                    }

                }

                let innerHtml = `<strong>${regionName}</strong>`

                if (typeof regionValue !== \'undefined\') {
                    innerHtml = `<strong>${regionName}</strong><br>` + regionValue.content
                }

                tippy(region, {
                    trigger: \'mouseenter click\',
                    theme: \'rkw\',
                    content: innerHtml,
                    allowHTML: true,
                    interactive: true,
                    appendTo: document.body,
                    offset: [0, -1],
                });

                $(region).on(\'mouseover\', () => {

                    for (const associatedRegion of associatedRegions) {

                        let $associatedRegion = $(associatedRegion)
                        $associatedRegion.addClass(\'primary\')

                    }

                })

                $(region).on(\'mouseleave\', () => {

                    for (const associatedRegion of associatedRegions) {

                        let $associatedRegion = $(associatedRegion)

                        if (! $associatedRegion.hasClass(\'is-marked\')) {
                            $associatedRegion.removeClass(\'primary\')
                        }

                    }

                })

            }

        ';

        $this->pageRenderer->addJsFooterInlineCode('mapScript' . $this->contentUid, $mapScript, true);

        // Inject External Caption Menu CSS
        $this->pageRenderer->addFooterData(
            '<link rel="stylesheet" href="/typo3conf/ext/rkw_maps/Resources/Public/Css/Map.css" />'
        );

        $this->view->assign('cUid', $this->contentUid);

    }
}
