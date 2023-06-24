<?php

namespace Masoudi\Melipayamak\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Masoudi\Melipayamak\Channels\MeliPayamakChannel;

class MelipayamakNotification extends Notification
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