<?php

# openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout docker/nginx.selfsigned.key -out docker/nginx.selfsigned.crt

namespace App\Traits;
use Telegram\Bot\Laravel\Facades\Telegram;

trait RequestTrait
{
    private function apiRequest($method, $parameters = []) {
        $url = "https://api.telegram.org/bot" . env("TELEGRAM_TOKEN") . "/" . $method;

        // dd($url);

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($parameters));

        $responseString = curl_exec($handle);

        if ($responseString == false) {
            curl_close($handle);
            return false;
        }

        curl_close($handle);

        $response = json_decode($responseString, true);

        dd($response);

        if ($response['ok'] == false) {
            return false;
        }

        $result = $response;
        return $result;
    }

    private function sendMessage($chatId, $text) {
        dd(Telegram::class);
        $response = Telegram::sendMessage([
            "chat_id" => $chatId,
            "parse_mode" => "HTML",
            "text" => $text
        ]);

        

        return $response;
    }
}
