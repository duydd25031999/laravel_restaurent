<?php

namespace App\Http\Controllers;

use App\Traits\MakeComponentsTrait;
use App\Traits\RequestTrait;
use Exception;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

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

    public function webhook() {
        return $this->apiRequest("setWebhook", [
            "url" => url(route("webhook")),
        ]);
    }

    public function demo() {
        return $this->apiRequest("setWebhook", [
            "url" => url(route("webhook")),
        ]);
    }

    public function getUpdates() {
        $activity = Telegram::getUpdates();
        return $activity;
    }

    public function sendMessage(Request $request) {
        try {
            $param = $request->all();
            $res = Telegram::sendMessage([
                "chat_id" => $param["chat_id"],
                "parse_mode" => "HTML",
                "text" => $param["text"],
            ]);
            return $res;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        

    }
}
