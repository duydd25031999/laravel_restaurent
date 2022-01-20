<?php

namespace App\Traits;

trait MakeComponentsTrait {
    private function keyboardBtn($option) {
        $keyboard = [
            "keyboard" => $option,
            "resize_key" => true,
            "one_time_keyboard" => false,
            "selective" => true
        ];
        $keyboardJson = json_encode($keyboard);
        return $keyboardJson;
    }
}
