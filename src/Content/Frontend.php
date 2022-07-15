<?php

namespace Blomstra\FontAwesome\Content;

use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;

class Frontend
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(Document $document)
    {
        $faType = $this->settings->get('blomstra-fontawesome.type');

        if ($faType === 'kit') {
            $kitUrl = htmlspecialchars($this->settings->get('blomstra-fontawesome.kitUrl'));

            $document->head[] = "<script src='$kitUrl' crossorigin='anonymous'></script>";
        }
    }
}
