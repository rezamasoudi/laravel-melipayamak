<?php

namespace Masoudi\Melipayamak\Channels;

use Masoudi\Melipayamak\Contracts\SMSNotification;
use Masoudi\Melipayamak\MeliPayamak;

class MeliPayamakChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Masoudi\Melipayamak\Contracts\SMSNotification  $notification
     * @return void
     */
    public function send($notifiable, SMSNotification $notification)
    {
        $melipayamak = resolve(MeliPayamak::class);
        $notification->toSMS($notifiable, $melipayamak);
    }
}
