<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebasePushController extends Controller
{
	public function toTopic(Request $request, string $token)
    {
        $messagingFirebase = Firebase::messaging();
        $a = $messagingFirebase->subscribeToTopic('all_users',$token);
        return response()->json([
            'success' => true, 
            'message' => 'Ok'
        ]);
    }

    public function testSending()
    {
        $topic = 'all_users';
        $messagingFirebase = Firebase::messaging();
        $title = getenv('APP_NAME');
        $url = getenv('APP_URL');
        $message = CloudMessage::new()
            ->withNotification([
                'title' => $title,
                'body' => 'Este mensaje llega a todos los usuarios',
                'icon' => 'https://rifasvinotinto.com/storage/logo/NuvbcEtNTIDfGqwq2zKNkvLPgpnbRaudRUJkwaDD.png',
                'click_action' => $url
            ])
            ->withData([
                'link' => $url,
                'url' => $url,
                'click_action' => $url
            ])
            ->toTopic($topic);

        $messagingFirebase->send($message);
    }
}