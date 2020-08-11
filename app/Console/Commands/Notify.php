<?php

namespace App\Console\Commands;

use App\Notifications\BuyEvent;
use App\Shopping;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification sent successfully!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $client = \App\Client::findOrFail($this->ask('Enter the id of client'));
            $shopping = Shopping::findOrFail($this->ask('Enter the id of product'));
//        $channel = BuyEvent::via;
            $defaultIndex = 'mail';
            $channel = $this->choice(
                'Enter the channel',
                ['mail', 'database', 'nexmo'],
                $defaultIndex,
                $maxAttempts = null,
                $allowMultipleSelections = false
            );
            $client->notify(new \App\Notifications\BuyEvent($channel, $shopping));

            echo "Notification sent successfully!" . "\n";

        } catch (\Exception $e) { // Using a generic exception
            dump('Error! Notification not sent! ' . $e->getMessage()
            );
             Log::error($e->getMessage());

        }

    }
}
