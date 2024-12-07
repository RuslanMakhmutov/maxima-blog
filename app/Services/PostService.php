<?php

namespace App\Services;

use App\Http\Resources\Post\PostsListResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostService
{

    public function indexList(): AnonymousResourceCollection
    {
        $posts = $this->listQuery()->paginate(12)->onEachSide(0);
        return PostsListResource::collection($posts);
    }

    public function listQuery(): Builder
    {
        return Post::query()
            ->select([
                'id',
                'title',
                'description',
                'image',
                'category_id',
                'user_id',
                'created_at'
            ])
            ->whereNotNull('published_at')
            ->with([
                'category:id,title',
                'user:id,name',
            ]);
    }

    public function categoryList(Category $category): AnonymousResourceCollection
    {
        $posts = $this->listQuery()
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->paginate(12)
            ->onEachSide(0);
        return PostsListResource::collection($posts);
    }
}
