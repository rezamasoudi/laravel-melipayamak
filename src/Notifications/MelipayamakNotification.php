<?php

namespace Masoudi\Melipayamak\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Masoudi\Melipayamak\Channels\MeliPayamakChannel;
use Masoudi\Melipayamak\Contracts\SMSNotification;

abstract class MelipayamakNotification extends Notification implements SMSNotification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [MeliPayamakChannel::class];
    }

}