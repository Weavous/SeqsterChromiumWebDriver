<?php

declare(strict_types=1);

namespace App\Services\WebDriver\Network;

use HeadlessChromium\Page;
use App\Traits\Create;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Browser\ProcessAwareBrowser;

abstract class Network
{
    protected Page $page;
    protected ProcessAwareBrowser $browser;

    use Create;

    protected const TIMEOUT = 100000;

    public function __construct(array $options = [])
    {
        $options = $options + [
            'windowSize' => [1280, 980],
            'headless' => true,
            'debugLogger' => 'php://stdout',
            'ignoreCertificateErrors' => true,
            'sendSyncDefaultTimeout' => 20000
        ];

        $browserFactory = new BrowserFactory();

        $this->browser = $browserFactory->createBrowser($options);
        $this->page = $this->browser->createPage();
    }
}
