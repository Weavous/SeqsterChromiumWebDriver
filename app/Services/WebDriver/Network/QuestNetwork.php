<?php

declare(strict_types=1);

namespace App\Services\WebDriver\Network;

use App\Services\WebDriver\JavascriptCallable;
use App\Services\DirectoryResolver\File\FileExtension;
use App\Services\DirectoryResolver\File\RandomFile;
use App\Traits\Create;
use Carbon\Carbon;
use HeadlessChromium\Page;

class QuestNetwork extends Network
{
    use Create;

    public function documents(User $user)
    {
        $this->page->navigate('https://myquest.questdiagnostics.com/web/home')->waitForNavigation(Page::LOAD, self::TIMEOUT);
        $this->page->mouse()->find('#pl_SignIn_btn')->click();
        $this->page->waitForReload(Page::LOAD, self::TIMEOUT);
        $this->page->evaluate(JavascriptCallable::create(resource_path('js/web-driver/login.js'))->with([
            'username' => $user->login,
            'password' => $user->secret
        ])->call());
        $this->page->waitForReload(Page::LOAD, self::TIMEOUT);
        $this->page->navigate(
            sprintf("https://myquest.questdiagnostics.com/results?fromLabDate=%s&%s", $this->urlDateParser(Carbon::parse('2016/01/01')), $this->urlDateParser(Carbon::now()))
        )->waitForNavigation();
        $content = $this->page->evaluate(JavascriptCallable::create(resource_path('js/web-driver/document-links.js'))->call())->waitForResponse(self::TIMEOUT);
        foreach ($content->getReturnValue() as $link) {
            $navigation = $this->page->navigate($link);
            $navigation->waitForNavigation(Page::LOAD, self::TIMEOUT);
            $this->page->pdf(['printBackground' => false])->saveToFile(
                RandomFile::create()->fromArray(['app', 'public', 'users', $user->login, 'documents'], FileExtension::PDF)
            );
        }
    }

    protected function urlDateParser(Carbon $date): string
    {
        return urlencode($date->format('d m Y'));
    }
}
