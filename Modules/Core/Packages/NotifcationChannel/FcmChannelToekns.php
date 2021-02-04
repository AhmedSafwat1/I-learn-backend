<?php

namespace Modules\Core\Packages\NotifcationChannel;

use Illuminate\Notifications\Notification;
use Modules\DeviceToken\Traits\FCMTraitUserToekens;

class FcmChannelToekns
{
    use FCMTraitUserToekens;
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFcm($notifiable);

      
        $this->sendForUser($notifiable, $message);
    }
}
