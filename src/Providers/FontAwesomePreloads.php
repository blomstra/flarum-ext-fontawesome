<?php

/*
 * This file is part of blomstra/fontawesome.
 *
 *  Copyright (c) 2022 Blomstra Ltd.
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 */

namespace Blomstra\FontAwesome\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;

class FontAwesomePreloads extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        /**
         * @var SettingsRepositoryInterface
         */
        $settings = $this->container[SettingsRepositoryInterface::class];

        /**
         * @var UrlGenerator
         */
        $url = $this->container[UrlGenerator::class];

        $this->container->extend('flarum.frontend.default_preloads', function (array $preloads) use ($settings, $url) {
            // Filter out FontAwesome preloads|
            $preloads = array_filter($preloads, function ($preload) {
                return ! str_contains($preload['href'], 'fonts/fa-');
            });

            $faType = $settings->get('blomstra-fontawesome.type');

            if ($faType === 'free') {
                $preloads[] = [
                    'href' => $url->to('forum')->base().'/assets/extensions/blomstra-fontawesome/fontawesome-6-free/fa-brands-400.woff2',
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
                $preloads[] = [
                    'href' => $url->to('forum')->base().'/assets/extensions/blomstra-fontawesome/fontawesome-6-free/fa-regular-400.woff2',
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
                $preloads[] = [
                    'href' => $url->to('forum')->base().'/assets/extensions/blomstra-fontawesome/fontawesome-6-free/fa-solid-900.woff2',
                    'as' => 'font',
                    'type' => 'font/woff2',
                    'crossorigin' => ''
                ];
            } elseif ($faType === 'kit') {
                $preloads[] = [
                    'href' => $settings->get('blomstra-fontawesome.kitUrl'),
                    'as' => 'script',
                ];
            }

            return $preloads;
        });
    }
}
