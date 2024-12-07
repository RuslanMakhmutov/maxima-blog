<?php

namespace App\Http\Controllers\API;

use App\Events\PostVisitEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function list(PostService $postService): AnonymousResourceCollection
    {
        return $postService->indexList();
    }

    public function item(Post $post): \Illuminate\Http\JsonResponse
    {
        PostVisitEvent::dispatch($post);

        $post->load(['categories:id,title']);
        return response()->json([
            'post' => new PostResource($post),
        ]);
    }
}
