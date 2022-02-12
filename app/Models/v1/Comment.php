<?php

namespace App\Models\v1;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use function auth;

class Comment extends BaseModel
{
    use ApiResponse;
    use HasFactory;

    protected $fillable = [
        'text', 'likes', 'dislikes',
        'thread_id', 'comment_id', 'app_user_id',
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

    /* ============================== SCOPES ============================== */


    /* ============================== RELATIONS ============================== */

    public function creator()
    {
        return $this->belongsTo(AppUser::class, 'app_user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function parent_comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class)
            ->with('creator');
    }

    public function likes()
    {
        $userAction = Taxonomy::rateComment();
//        $userAction = 3;
        return $this->morphMany(UserAction::class, 'model')
            ->where('taxonomy_id', $userAction->id);
//            ->where('taxonomy_id', $userAction);
    }

    public function dislikes()
    {
        $userAction = Taxonomy::rateComment('dislike-comment');
//        $userAction = 4;
        return $this->morphMany(UserAction::class, 'model')
            ->where('taxonomy_id', $userAction->id);
//            ->where('taxonomy_id', $userAction);
    }

    public function actions()
    {
        return $this->morphMany(UserAction::class, 'model');
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

    public static function getCommentsByThread($request, $thread)
    {
        $q = self::query()
            ->where('thread_id', $thread->id)
            ->with([
                'creator'
            ])
            ->withCount('replies');

        return $q->paginate($request->paginate ?? 5);
    }
}
