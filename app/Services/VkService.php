<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VkService
{
    public function getPosts(int $count = 12, int $offset = 0): array
    {
        $groupId = config('services.vk.group_id');
        $token   = config('services.vk.token');
        $version = config('services.vk.version', '5.199');

        $response = Http::get('https://api.vk.com/method/wall.get', [
            'owner_id'      => $groupId,
            'count'         => $count,
            'offset'        => $offset,
            'access_token' => $token,
            'v'             => $version,
        ]);

        $json = $response->json();

        if (
            !isset($json['response']['items']) ||
            !is_array($json['response']['items'])
        ) {
            return [];
        }

        return collect($json['response']['items'])
            ->map(fn ($post) => $this->normalizePost($post))
            ->filter()
            ->values()
            ->toArray();
    }


    private function normalizePost(array $post): ?array
    {
        return [
            'id'     => $post['id'],
            'date'   => $post['date'],
            'text'   => $post['text'] ?? '',
            'photos' => $this->extractPhotos($post['attachments'] ?? []),
        ];
    }

    private function extractPhotos(array $attachments): array
    {
        return collect($attachments)
            ->where('type', 'photo')
            ->map(function ($item) {
                $sizes = $item['photo']['sizes'] ?? [];

                if (empty($sizes)) {
                    return null;
                }

                // берём самое большое фото
                $max = collect($sizes)->sortByDesc(
                    fn ($s) => ($s['width'] ?? 0) * ($s['height'] ?? 0)
                )->first();

                return $max['url'] ?? null;
            })
            ->filter()
            ->values()
            ->toArray();
    }
}
