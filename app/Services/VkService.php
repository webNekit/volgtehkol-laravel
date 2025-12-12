<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VkService {

    public function getPosts(int $count = 10) {
        $groupId = config('services.vk.group_id');
        $token   = config('services.vk.token');
        $version = config('services.vk.version', '5.199');

        $response = Http::get("https://api.vk.com/method/wall.get", [
            'owner_id' => $groupId,
            'count' => $count,
            'access_token' => $token,
            'v' => $version,
        ]);

        $json = $response->json();

        if (!isset($json['response']['items'])) {
            return [];
        }

        return $json['response']['items'];
    }

}
