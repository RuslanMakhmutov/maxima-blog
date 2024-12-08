<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Post;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post, CommentService $commentService)
    {
        return $commentService->store($request, $post);
    }
}
