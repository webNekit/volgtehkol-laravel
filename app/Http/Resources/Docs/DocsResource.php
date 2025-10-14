<?php

namespace App\Http\Resources\Docs;

use App\Models\CategoryDocument;
use App\Models\Document;

class DocsResource {
    public static function docsCollection()
    {
        return CategoryDocument::with(['documents' => function($query) {
            $query->where('is_active', true)
                ->orderBy('created_at', 'desc');
        }])
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
    }
}
