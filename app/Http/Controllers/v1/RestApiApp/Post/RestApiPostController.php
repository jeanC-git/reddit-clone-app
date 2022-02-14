<?php

namespace App\Http\Controllers\v1\RestApiApp\Post;

use App\Http\Controllers\v1\BaseController;
use App\Http\Requests\v1\Post\PostListRequest;
use App\Http\Requests\v1\Post\PostStoreRequest;
use App\Http\Resources\v1\Post\PostCommentsResource;
use App\Http\Resources\v1\Post\PostListResource;
use App\Models\v1\Comment;
use App\Models\v1\Taxonomy;
use App\Models\v1\Post;
use Illuminate\Http\Request;

class RestApiPostController extends BaseController
{
    public function list(PostListRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $threads = Post::list($data);

        PostListResource::collection($threads);

        return $this->success(compact('threads'));
    }

    public function myPosts(PostListRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $threads = Post::list($data);

        PostListResource::collection($threads);

        return $this->success(compact('threads'));
    }

    public function store(PostStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        $data = Post::storeRequest($data);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new PostListResource($data['model'])
        ]);
    }

    public function update(PostStoreRequest $request, $post_id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $thread = Post::find($post_id);
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $data = Post::storeRequest($data, $thread);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new PostListResource($data['model'])
        ]);
    }

    public function show($slug): \Illuminate\Http\JsonResponse
    {
        $thread = Post::where('slug', $slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        return $this->success(compact('thread'));
    }

    public function like($slug): \Illuminate\Http\JsonResponse
    {
        $thread = Post::slug($slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $userAction = Taxonomy::rateThread();
        $thread->increment('likes');
        $thread->incrementAction($userAction->id);

        return $this->success([
            'likes' => $thread->likes,
            'dislikes' => $thread->dislikes,
        ]);
    }

    public function dislike($slug): \Illuminate\Http\JsonResponse
    {
        $thread = Post::slug($slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $userAction = Taxonomy::rateThread('dislike-thread');
        $thread->increment('dislikes');
        $thread->incrementAction($userAction->id);

        return $this->success([
            'likes' => $thread->likes,
            'dislikes' => $thread->dislikes,
        ]);
    }

    public function getComments(Request $request, $slug): \Illuminate\Http\JsonResponse
    {
        $thread = Post::slug($slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $comments = Comment::getCommentsByThread($request, $thread);
        PostCommentsResource::collection($comments);

        return $this->success(compact('comments'));
    }
}
