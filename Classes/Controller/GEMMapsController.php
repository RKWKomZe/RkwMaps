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
 * GEMMapsController
 *
 * @author Christian Dilger <c.dilger@addorange.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwMaps
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class GEMMapsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \RKW\RkwMaps\Domain\Repository\MapRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected ?MapRepository $mapRepository;


    /**
     * @param \RKW\RkwMaps\Domain\Repository\MapRepository $mapRepository
     */
    public function injectMailRepository(MapRepository $mapRepository)
    {
        $this->mapRepository = $mapRepository;
    }


    /**
     * @var int
     */
    protected int $contentUid = 0;


    /**
     * initializeAction
     *
     * @return void
     */
    public function initializeAction(): void
    {
        $this->getContentUid();
    }


    /**
     * @return void
     */
    protected function getContentUid(): void
    {
        // @extensionScannerIgnoreLine
        $this->contentUid = (int)$this->configurationManager->getContentObject()->data['uid'];
    }


    /**
     * action show
     *
     * @return void
     * @todo plain texts in php-code without translation. preparation for visual representation should be done elsewhere
     * @todo fixed pageUids in php-code. don't ever do this
     */
    public function gemAction(): void
    {
        $this->initializeAction();

        $content = [
            'method'   => [
                'href' => $this->uriBuilder->reset()
                    ->setTargetPageUid($this->settings['methodId'])
                    ->setCreateAbsoluteUri(true)
                    ->build(),
                'text' => 'Sie haben Fragen zur Methodik? Hier finden Sie alle Details.',
            ],
            'material' => [
                'quota'     => [
                    'tabs' => [
                        [
                            'id'      => 'gruendungsgeschehen',
                            'title'   => 'Gründungsgeschehen',
                            'content' => [
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/latest-global-report',
                                    'text' => 'Global Entrepreneurship Monitor Global Report (2022)',
                                ],
                                [
                                    'href' => 'http://rkw.link/gem2022',
                                    'text' => 'Global Entrepreneurship Monitor Länderbericht Deutschland (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/studie/powerpoint-folien-global-entrepreneurship-monitor-20212022/',
                                    'text' => 'Powerpoint-Folien zum GEM-Länderbericht (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/faktenblatt/global-entrepreneurship-monitor-aktuell-gruenden-als-familientradition-oder-als-notfallplan/',
                                    'text' => 'Global Entrepreneurship Monitor aktuell: Gründen als Familientradition oder als Notfallplan? (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/in-deutschland-gibt-es-immer-mehr-gruendende/',
                                    'text' => 'In Deutschland gibt es immer mehr Gründende (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/risikoaffin-und-selbstbewusst-so-sind-die-zukuenftigen-gruenderinnen-und-gruender-in-deutschland/',
                                    'text' => 'Risikoaffin und selbstbewusst – So sind die zukünftigen Gründerinnen und Gründer in Deutschland (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/wie-divers-ist-die-deutsche-gruendungsszene/',
                                    'text' => 'Wie divers ist die deutsche Gründungsszene? (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/immer-mehr-junge-menschen-gruenden-unternehmen/',
                                    'text' => 'Immer mehr junge Menschen gründen Unternehmen (2020)',
                                ],
                            ],
                        ],
                        [
                            'id'      => 'migrantisches-unternehmertum',
                            'title'   => 'Migrantisches Unternehmertum',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/faktenblatt/global-entrepreneurship-monitor-aktuell-gruendende-mit-einwanderungsgeschichte/',
                                    'text' => 'Global Entrepreneurship Monitor aktuell: Gründende mit Einwanderungsgeschichte (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/migrantinnen-und-migranten-treiben-die-deutsche-gruendungsszene-an/',
                                    'text' => 'Migrantinnen und Migranten treiben die deutsche Gründungsszene an!(2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/migrantinnen-und-migranten-wer-gruendet-was-motiviert-sie-und-wie-geht-es-weiter/',
                                    'text' => 'Migrantinnen und Migranten – wer gründet, was motiviert sie und wie geht es weiter? (2021)',
                                ],
                            ],
                        ],
                        [
                            'id'      => 'intrapreneurship',
                            'title'   => 'Intrapreneurship',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/faktenblatt/global-entrepreneurship-monitor-aktuell-intrapreneurship-und-gruendungen/',
                                    'text' => 'Global Entrepreneurship Monitor aktuell: Intrapreneurship und Gründungen (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/start-up-ideen-werden-haeufig-innerhalb-von-unternehmen-verwirklicht/',
                                    'text' => 'Start-up-Ideen werden häufig innerhalb von Unternehmen verwirklicht (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/intrapreneurship-its-all-about-people/',
                                    'text' => 'Intrapreneurship - It\'s all about people (2021)',
                                ],
                            ],
                        ],
                        [
                            'id'      => 'innovation',
                            'title'   => 'Innovation, Digitalisierung und Resilienz',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/trotz-oder-wegen-corona-wieder-bessere-gruendungschancen-in-deutschland/',
                                    'text' => 'Trotz oder wegen Corona: Wieder bessere Gründungschancen in Deutschland! (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/publikationen/faktenblatt/global-entrepreneurship-monitor-aktuell-resilienz-der-unternehmen-in-deutschland/',
                                    'text' => 'Global Entrepreneurship Monitor aktuell: Resilienz der Unternehmen in Deutschland (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruenden-in-krisenzeiten/',
                                    'text' => 'Gründen in Krisenzeiten. Die Gründungsaktivitäten in Deutschland insbesondere von Frauen und Männern im Vergleich (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/digitale-kompetenzen-ein-muss-fuer-potenzielle-entrepreneure/',
                                    'text' => 'Digitale Kompetenzen: ein Muss für potenzielle Entrepreneure? (2021)',
                                ],
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/covid-impact-report',
                                    'text' => 'Diagnosing COVID-19 Impacts on Entrepreneurship - Exploring Policy Remedies for Recovery (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruendungen-in-deutschland-digital-divers-und-hoffentlich-mutig/',
                                    'text' => 'Gründungen in Deutschland - digital, divers und hoffentlich mutig! (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/ist-die-corona-krise-eine-chance-fuer-tech-start-ups/',
                                    'text' => 'Ist die Corona-Krise eine Chance für (Tech-)Start-ups? (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/unterstuetzung-von-gruendungen-und-unternehmen-waehrend-der-corona-krise-ein-internationaler-vergleich/',
                                    'text' => 'Unterstützung von Gründungen und Unternehmen während der Corona-Krise: Ein internationaler Vergleich (2020)',
                                ],
                            ],
                        ],
                        [
                            'id'      => 'gruendung-regional',
                            'title'   => 'Gründung regional',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/startup-hochburg-berlin-ist-2020-nicht-spitzenreiter-bei-gruendungen/',
                                    'text' => '„Startup-Hochburg“ Berlin ist 2020 nicht Spitzenreiter bei Gründungen (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruendungsaktivitaeten-im-bundeslaender-vergleich/',
                                    'text' => 'Gründungsaktivitäten im Bundesländer-Vergleich (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/regional-statt-global-bei-gruendungen-in-deutschland-stehen-inlaendische-maerkte-im-fokus/',
                                    'text' => 'Regional statt global: Bei Gründungen in Deutschland stehen inländische Märkte im Fokus (2020)',
                                ],
                            ],
                        ],
                        [
                            'id'      => 'gruendung-frauen',
                            'title'   => 'Gründung durch Frauen',
                            'content' => [
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/frauen-oder-maenner-wer-gruendet-oekonomisch-nachhaltiger/',
                                    'text' => 'Frauen oder Männer – Wer gründet ökonomisch nachhaltiger? (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gender-gap/',
                                    'text' => 'Gender Gap (2022):',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruenderinnen-und-digitale-kompetenzen/',
                                    'text' => 'Gründerinnen und digitale Kompetenzen (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/gruenden-ist-nicht-mehr-nur-maennersache/',
                                    'text' => 'Gründen ist nicht mehr nur Männersache (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruenden-in-krisenzeiten/',
                                    'text' => 'Gründen in Krisenzeiten. Die Gründungsaktivitäten in Deutschland insbesondere von Frauen und Männern im Vergleich (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/digitale-kompetenzen-ein-muss-fuer-potenzielle-entrepreneure/',
                                    'text' => 'Digitale Kompetenzen: ein Muss für potenzielle Entrepreneure? (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/warum-gibt-es-in-deutschland-so-wenige-gruenderinnen/',
                                    'text' => 'Warum gibt es in Deutschland so wenige Gründerinnen? (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/warum-gruenderinnen-jetzt-durchstarten-sollten/',
                                    'text' => 'Warum Gründerinnen jetzt durchstarten sollten (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/gruendungsquote-unter-frauen-im-vergleich/',
                                    'text' => 'Gründungsquote unter Frauen im Vergleich (2018)',
                                ],
                            ],
                        ],
                    ],
                ],
                'attitudes' => [
                    'tabs' => [
                        [
                            'id'      => '',
                            'title'   => '',
                            'content' => [
                                [
                                    'href' => 'http://rkw.link/gem2022',
                                    'text' => 'Global Entrepreneurship Monitor Länderbericht Deutschland (2022)',
                                ],
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/latest-global-report',
                                    'text' => 'Global Entrepreneurship Monitor Global Report (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/trotz-oder-wegen-corona-wieder-bessere-gruendungschancen-in-deutschland/',
                                    'text' => 'Trotz oder wegen Corona: Wieder bessere Gründungschancen in Deutschland! (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/gruendungsklima-in-deutschland-wird-immer-besser/',
                                    'text' => 'Gründungsklima in Deutschland wird immer besser! (2020)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/gruendungseinstellungen-im-internationalen-vergleich/',
                                    'text' => 'Gründungseinstellungen im internationalen Vergleich (2018)',
                                ],
                            ],
                        ],
                    ],
                ],
                'images'    => [
                    'tabs' => [
                        [
                            'id'      => '',
                            'title'   => '',
                            'content' => [
                                [
                                    'href' => 'http://rkw.link/gem2022',
                                    'text' => 'Global Entrepreneurship Monitor Länderbericht Deutschland (2022)',
                                ],
                                [
                                    'href' => 'https://www.gemconsortium.org/reports/latest-global-report',
                                    'text' => 'Global Entrepreneurship Monitor Global Report (2022)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/gruendung/blog/hohes-gesellschaftliches-ansehen-und-steigende-medienaufmerksamkeit-fuer-gruendende/',
                                    'text' => 'Hohes gesellschaftliches Ansehen und steigende Medienaufmerksamkeit für Gründende (2021)',
                                ],
                                [
                                    'href' => 'https://www.rkw-kompetenzzentrum.de/das-rkw/presse/gesellschaftliches-ansehen-unternehmerisch-selbststaendiger-nimmt-zu/',
                                    'text' => 'Gesellschaftliches Ansehen unternehmerisch Selbstständiger nimmt zu (2019)',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'examples' => [
                'DE-BW' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9655)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Durch Dekarbonisierung, Demografie und Digitalisierung ergeben sich spannende Geschäftschancen.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9652)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Es wird Zeit, nachhaltiges Wirtschaften als gesellschaftlich existenzsichernd zu verstehen.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9585)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'In einer Welt der Digitalisierung sind unsere Daten das Kapital von morgen',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9654)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wir müssen eine Fehlerkultur etablieren und aufzeigen, dass ein Scheitern auch Chancen bietet.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9653)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Gründerinnen als Vorbilder eine Bühne geben und Vernetzungsmöglichkeiten schaffen!',
                        ],
                    ],
                ],
                'DE-BY' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9532)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Bereits in der Schule müssen Grundlagen der Entrepreneurship-Ausbildung vermittelt werden',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9582)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wir in den Gründungszentren stellen einen anhaltenden Trend zur Gründung fest',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9572)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'In Bayreuth werden Startups auch in ihrer Wachstums- und Etablierungsphase unterstützt',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9566)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Das Allgäu ist ein attraktiver Unternehmensstandort mit vielen Hidden Champions im Mittelstand',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9534)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Den Menschen muss die Angst genommen werden',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9583)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Menschen in der Region Niederbayern stehen dem Unternehmertum sehr positiv gegenüber',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9577)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Für die Gründung ist das soziale Umfeld und das Vertrauen in die eigenen Fähigkeiten essenziell',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9567)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Das Verbessern und Erfinden ist Teil des Selbstverständnisses im Allgäu',
                        ],
                    ],
                    'images'    => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9584)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Gründende finden in Niederbayern viel Zuspruch, Unterstützung und Angebote',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9578)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wir fördern gründungsinteressierte Studierende durch interaktive Lehr- & Weiterbildungsformate',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9570)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Der Blick muss auf den Mut des Gründens und nicht auf Erfolg oder Misserfolg gelenkt werden',
                        ],
                    ],
                ],
                'DE-BB' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9649)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Potsdam ist Ideenschmiede, Traumfabrik und Zukunftslabor!',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9561)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Nachbarschaft zu Berlin und zum polnischen Wachstumsmarkt bietet Chancen für Gründende',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9586)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Brandenburg bietet einen Rund-um-sorglos-Service',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9643)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Gründerinnen und Gründer von Startups gelten weniger als verrückt, sondern als hip und cool',
                        ],
                    ],
                ],
                'DE-BE' => [
                    'quota' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9535)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wir glauben nicht, dass man Entrepreneurship im klassischen Sinne ausbilden oder lehren kann',
                        ],
                    ],
                ],
                'DE-HB' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9568)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Studierende werden in Kontakt mit dem regionalen Gründungsökosystem gebracht',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9571)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Einstellung zum Thema Gründen ist nicht schwarz-weiß, sondern meistens im Graubereich',
                        ],
                    ],
                    'images'    => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9569)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Es ist wichtig, auch über nicht so erfolgreiche Unternehmen zu berichten',
                        ],
                    ],
                ],
                'DE-HE' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9360)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Für mich gibt\'s nur eine Antwort - Netzwerk, Netzwerk, Netzwerk!',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9544)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Einbindung von regionalen Mitgestaltern der Wirtschaft und des Entrepreneurship ist wichtig.',
                        ],
                    ],
                ],
                'DE-NI' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9546)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Es ist wichtig, passgenaue Angebote für Gründerinnen und Gründer und deren Vielfalt zu schaffen.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9658)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Alle Studierenden sollten sich mindestens einmal mit Entrepreneurship auseinandergesetzt haben.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9549)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wir begleiten Gründungsinteressierte während der gesamten Gründungsphase',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9550)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Region Hildesheim hat ein hervorragend funktionierendes institutionelles Netzwerk',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9648)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Ein breit gefächertes, transparentes Unterstützungsangebot und ein gründungsfreundliches Klima!',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9671)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Unternehmerisches Denken und Handeln sollte insgesamt sichtbarer werden',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9547)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Oft sind es auch unbewusste Muster, die wir im Kopf haben.',
                        ],
                    ],
                ],
                'DE-NW' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9644)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Hochschulen bilden einen Großteil der Gründerinnen und Gründer von morgen aus',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9536)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Hochschule kann der ideale Ort sein, um für das Thema Gründung zu sensibilisieren',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9562)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Act local, shine global',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9558)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Unser großes Anliegen ist es, das Innovations- und Start-up-Mindset in die Region zu tragen',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9560)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Positive Einstellungen sind sicherlich notwendig, aber nicht hinreichend dafür, zu gründen',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9674)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Gerade Studierende sind in einer großartigen Position, um zu gründen',
                        ],
                    ],
                ],
                'DE-RP' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9556)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Systematisches Ideen-Scouting ermöglicht Gründungspotential zu identifizieren und zu unterstützen',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9557)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Auch die Fehlerkultur sollte „zelebriert“ werden. Denn aus Fehlern kann man lernen!',
                        ],
                    ],
                ],
                'DE-SN' => [
                    'quota'     => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9595)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Der Abbau von Risikoaversion & dem Stigma des Scheiterns steigert die Gründungsrahmenbedingungen',
                        ],
                    ],
                    'attitudes' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9673)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wichtig ist es, den guten Gründungsideen Mut zu machen',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9597)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die Gründungseinstellung & -rahmenbedingungen sind wesentliche Einflussfaktoren der Gründungsquote',
                        ],
                    ],
                ],
                'DE-TH' => [
                    'quota' => [
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9563)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Unsere Gründungsförderung basiert auf einem ganzheitlichen Ansatz',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9646)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Die meisten Tech-Gründungen sind noch am Standort, eine Motivation für neue Gründungsgenerationen.',
                        ],
                        [
                            'href' => $this->uriBuilder->reset()
                                ->setTargetPageUid(9650)
                                ->setCreateAbsoluteUri(true)
                                ->build(),
                            'text' => 'Wichtig sind verlässliche Strukturen - mit Freiräume für Entwicklung, Wachstum und Sichtbarkeit.',
                        ],
                    ],
                ],
            ],
        ];

        $this->view->assign('content', json_encode($content));
    }

}
