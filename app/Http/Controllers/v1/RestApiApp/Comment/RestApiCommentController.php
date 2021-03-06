<?php

namespace App\Http\Controllers\v1\RestApiApp\Comment;

use App\Http\Controllers\v1\BaseController;
use App\Http\Requests\v1\Comment\CommentStoreRequest;
use App\Http\Resources\v1\Comment\CommentRepliesResource;
use App\Http\Resources\v1\Post\PostCommentsResource;
use App\Models\v1\Comment;
use App\Models\v1\Taxonomy;

class RestApiCommentController extends BaseController
{

    public function show(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $comment = new PostCommentsResource($comment);

        return $this->success(compact('comment'));
    }

    public function store(CommentStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $data = Comment::storeRequest($data);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new PostCommentsResource($data['model'])
        ]);
    }

    public function update(CommentStoreRequest $request, Comment $comment): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $data = Comment::storeRequest($data, $comment);

        return $this->success([
            'msg' => $data['message'],
            'comment' => new PostCommentsResource($data['model'])
        ]);
    }

    public function like(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $userAction = Taxonomy::rateComment();
        $comment->increment('likes');
        $comment->incrementAction($userAction->id);

        return $this->success([
            'likes' => $comment->likes,
            'dislikes' => $comment->dislikes,
        ]);
    }

    public function dislike(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $userAction = Taxonomy::rateComment('dislike-comment');
        $comment->increment('dislikes');
        $comment->incrementAction($userAction->id);

        return $this->success([
            'likes' => $comment->likes,
            'dislikes' => $comment->dislikes,
        ]);
    }

    public function replies(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $replies = $comment->replies;

        $replies = CommentRepliesResource::collection($replies);

        return $this->success(compact('replies'));
    }

}
