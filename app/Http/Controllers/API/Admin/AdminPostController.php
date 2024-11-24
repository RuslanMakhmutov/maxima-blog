<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Services\API\Admin\AdminPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminPostService $postService): AnonymousResourceCollection
    {
        return $postService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, AdminPostService $postService): JsonResponse
    {
        return $postService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            "success" => true,
            "post" => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, UpdatePostRequest $request, AdminPostService $postService): JsonResponse
    {
        return $postService->update($post, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Post $post, AdminPostService $postService): JsonResponse
    {
        return $postService->delete($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, AdminPostService $postService): JsonResponse
    {
        return $postService->destroy($post);
    }
}
