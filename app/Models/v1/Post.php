<?php

namespace App\Models\v1;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use function auth;

class Post extends BaseModel
{
    use ApiResponse;
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'text', 'slug',
        'app_user_id',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    /* ============================== SLUG CONFIG ============================== */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
                'onUpdate' => true,
                'unique' => true,
            ]
        ];
    }

    /* ============================== SCOPES ============================== */

    public function scopeCreator($q, $app_user_id)
    {
        return $q->where('app_user_id', $app_user_id);
    }

    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    /* ============================== RELATIONS ============================== */

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->with(['creator'])
            ->withCount('replies')
            ->where('comment_id', null);
    }

    public function creator()
    {
        return $this->belongsTo(AppUser::class, 'app_user_id');
    }

    public function actions()
    {
        return $this->morphMany(UserAction::class, 'model');
    }

    public function likes()
    {
        $userAction = Taxonomy::ratePost()->first();
        return $this->morphMany(UserAction::class, 'model')
            ->where('taxonomy_id', $userAction->id);
    }

    public function dislikes()
    {
        $userAction = Taxonomy::ratePost('dislike')->first();
        return $this->morphMany(UserAction::class, 'model')
            ->where('taxonomy_id', $userAction->id);
    }

    public function incrementAction($taxonomy_id, $quantity = 1)
    {
        $app_user_id = auth()->user()->id;

        $row = $this->actions()
            ->firstOrCreate(compact('app_user_id', 'taxonomy_id'));

        $row->increment('score', $quantity);

        return $row;
    }

    /* ============================== METHODS ============================== */

    public static function list($request)
    {
        $q = self::query()
            ->with([
                'creator'
            ]);

        $q->withCount('comments');

        if (key_exists('app_user_id', $request) && $request['app_user_id'])
            $q->creator($request['app_user_id']);

        if (key_exists('no_paginate', $request))
            return $q->get();

        return $q->paginate($request['paginate'] ?? 20);
    }
}
