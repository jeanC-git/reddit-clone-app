<?php

namespace App\Http\Controllers\v1\RestApiApp\Thread;

use App\Http\Controllers\BaseController;
use App\Http\Requests\v1\Thread\ThreadListRequest;
use App\Http\Requests\v1\Thread\ThreadStoreRequest;
use App\Http\Resources\v1\Thread\ThreadCommentsResource;
use App\Http\Resources\v1\Thread\ThreaListResource;
use App\Models\v1\Comment;
use App\Models\v1\Taxonomy;
use App\Models\v1\Thread;
use Illuminate\Http\Request;

class RestApiThreadController extends BaseController
{
    public function list(ThreadListRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $threads = Thread::list($data);

        ThreaListResource::collection($threads);

        return $this->success(compact('threads'));
    }

    public function myThreads(ThreadListRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $threads = Thread::list($data);

        ThreaListResource::collection($threads);

        return $this->success(compact('threads'));
    }

    public function store(ThreadStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        $data = Thread::storeRequest($data);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new ThreaListResource($data['model'])
        ]);
    }

    public function update(ThreadStoreRequest $request, $thread_id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $thread = Thread::find($thread_id);
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $data = Thread::storeRequest($data, $thread);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new ThreaListResource($data['model'])
        ]);
    }

    public function show($slug): \Illuminate\Http\JsonResponse
    {
        $thread = Thread::where('slug', $slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        return $this->success(compact('thread'));
    }

    public function like($slug): \Illuminate\Http\JsonResponse
    {
        $thread = Thread::slug($slug)->first();
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
        $thread = Thread::slug($slug)->first();
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
        $thread = Thread::slug($slug)->first();
        if (!$thread)
            return $this->error('Thread not found.', 404, 404);

        $comments = Comment::getCommentsByThread($request, $thread);
        ThreadCommentsResource::collection($comments);

        return $this->success(compact('comments'));
    }
}
