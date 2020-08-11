<?php

namespace App\Http\Controllers;

use App\Client;
use App\Notifications\BuyEvent;
use Illuminate\Http\Request;

class BuyEventController extends Controller
{
    public function notify()
    {
        $client = Client::find(1);

        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is our example notification tutorial',
            'thanks' => 'Thank you for visiting codechief.org!',
        ];

        $client->notify(new BuyEvent($details));

        return dd("Done");
    }
}
