<?php

namespace App\Listeners;

use App\Events\RecivedOrdeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmsListener
{
    /**
     * Handle the event
     * @param RecivedOrdeEvent $event
     * @return void
     */
    public function handle(RecivedOrdeEvent $event)
    {
        $client = new \Nexmo\Client(
			new \Nexmo\Client\Credentials\Basic(
				config('services.nexmo.key'),
				config('services.nexmo.secret')
			)
		);
	
		$client->message()->send([
			'type' => 'unicode',
			'from' => config('services.nexmo.sms_from'),
			'to' => config('services.nexmo.sms_to'),
			'text' => 'Сделан заказ от ' . $event->phone . "__"
		]);
    }
}
