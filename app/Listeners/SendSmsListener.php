<?php

namespace App\Listeners;

use App\Events\RecivedOrderEvent;

class SendSmsListener
{
    public function handle(RecivedOrderEvent $event)
    {
        if (!is_null(config('services.nexmo.secret'))) {
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
                'text' => 'Новый заказ от ' . $event->phone . ' |',
            ]);
        }
    }
}
