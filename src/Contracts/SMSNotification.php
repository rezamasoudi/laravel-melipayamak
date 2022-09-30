<?php

namespace Masoudi\Melipayamak\Contracts;

use Masoudi\Melipayamak\MeliPayamak;

interface SMSNotification
{
    /**
     * A method that is called when the notification is sent.
     *
     * @param  mixed  $notifiable
     * @param  \Masoudi\Melipayamak\MeliPayamak  $meliPayamak
     */
    public function toSMS(mixed $notifiable, MeliPayamak $meliPayamak);
}
