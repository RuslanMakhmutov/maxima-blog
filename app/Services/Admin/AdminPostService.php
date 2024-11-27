<?php

namespace App\Services\Admin;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Admin\Post\AdminPostResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminPostService
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/Post/Index', [
            'posts' => AdminPostResource::collection(Post::paginate(10))
        ]);
    }

    public function add(): \Inertia\Response
    {
        return Inertia::render('Admin/Post/Add', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = new Post($data);
        $post->user_id = Auth::id();
        $post->save();

        return to_route('admin.posts.index');
    }

    // public function update(Post $post, UpdatePostRequest $request): JsonResponse
    // {
    //     try {
    //         $post->update([
    //             'title' => $request->validated('title'),
    //             'content' => $request->validated('content'),
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    //
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Post updated successfully',
    //     ]);
    // }
    //
    // public function delete(Post $post): JsonResponse
    // {
    //     $post->delete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Post soft deleted successfully',
    //     ]);
    // }
    //
    // public function destroy(Post $post): JsonResponse
    // {
    //     $post->forceDelete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Post destroyed successfully',
    //     ]);
    // }
}
