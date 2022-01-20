<?php

namespace App\Http\Controllers;

use App\Traits\MakeComponentsTrait;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Longman\TelegramBot\Telegram;

class TelegramController extends Controller
{
    use RequestTrait;
    use MakeComponentsTrait;

    public function index() {
        $result = json_decode(file_get_contents("php://input"));
        $action = $result->message->text;
        $userId = $result->message->from->id;
        if ($action == "/start") {
            $text = "Please choose city that can see time";
            $option = [
                ["City 1", "City 2"],
                ["City 3", "City 4"],
                ["City 5", "City 6"]
            ];
            $this->apiRequest("sendMessage", [
                "chat_id" => $userId,
                "text" => $text,
                "reply_markup" => $this->keyboardBtn($option)
            ]);
        }
    }

    // public function webhook() {
    //     return $this->apiRequest("setWebhook", [
    //         "url" => url(route("webhook")),
    //     ]);
    // }

    public function demo() {
        return $this->apiRequest("setWebhook", [
            "url" => url(route("webhook")),
        ]);
    }

    public function webhook() {
        try {
            // Create Telegram API object
            $telegram = new Telegram(env("TELEGRAM_TOKEN"), "@laravel_duydd25031999_demo1_bot");
        
            // Set webhook
            // $result = $telegram->setWebhook($hook_url);
            $telegram->handle();
            dd($telegram);
            if ($result->isOk()) {
                return $result->getDescription();
            }
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // log telegram errors
            // echo $e->getMessage();
        }
    }
}
