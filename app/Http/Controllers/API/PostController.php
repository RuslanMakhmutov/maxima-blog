<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function list(PostService $postService): AnonymousResourceCollection
    {
        return $postService->list();
    }
}
