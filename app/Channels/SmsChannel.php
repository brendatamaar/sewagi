<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use GuzzleHttp;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        $client = new GuzzleHttp\Client();
        $username = config('constants.tcastsmsUsername');
        $password = config('constants.tcastsmsPassword');
        $phone_number = $notifiable->phone_number_full;
        $base_url = config('constants.tcastsmsUrl');
        $url = "{$base_url}?username={$username}&password={$password}&type=0&dlr=1&destination={$phone_number}&source=TCASTSMS&message={$message}";
        $res = $client->request('GET', $url);
    }
}

