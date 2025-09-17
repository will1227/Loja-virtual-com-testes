<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Define a URL base para os testes Dusk.
     */
    protected function baseUrl()
    {
        return 'http://127.0.0.1:8000';
    }

    /**
     * Configura o driver para usar o Chromium.
     */
    protected function driver(): RemoteWebDriver
    {
        $options = new ChromeOptions();

        // Caminho para o Chromium instalado no sistema
        $options->setBinary('/usr/bin/chromium');

        $options->addArguments([
            '--disable-gpu',
            '--window-size=1920,1080',
            '--no-sandbox',
            //'--headless=new', // descomente se quiser rodar sem abrir janela
        ]);

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL', 'http://localhost:9515'),
            [
                'browserName' => 'chrome',
                'goog:chromeOptions' => $options->toArray(),
            ]
        );
    }
}
