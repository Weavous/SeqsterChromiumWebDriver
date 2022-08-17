<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\WebDriver\Network\QuestNetwork;
use App\Services\WebDriver\Network\User;
use Exception;
use HeadlessChromium\Exception\OperationTimedOut;

class UserDocumentFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:document-fetch {--login= :} {--secret= :} {--network= :}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve all user documents from network';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $login = $this->option('login') ?? die();
        $secret = $this->option('secret') ?? die();
        $network = $this->option('network') ?? die();

        try {
            switch ($network) {
                case 'quest':
                    try {
                        QuestNetwork::create()->documents(new User($login, $secret));
                    } catch (Exception | OperationTimedOut $e) {
                        return $e->getMessage();
                    }
            }
        } finally {
            //
        }

        return 0;
    }
}
