<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxonomy extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'id', 'group', 'type', 'position', 'code', 'name', 'short_name',
        'active', 'icon', 'slug', 'desctiption', 'parent_taxonomy_id'
    ];

    /* ============================== SCOPES ============================== */

    public function scopeRatePost($q, $action = 'like-post')
    {
        return $q->where('group', 'user-actions')
            ->where('type', 'posts')
            ->where('code', $action);
    }

    public function scopeRateComment($q, $action = 'like-comment')
    {
        return $q->where('group', 'user-actions')
            ->where('type', 'comments')
            ->where('code', $action);
    }

    /* ============================== RELATIONS ============================== */


    /* ============================== METHODS ============================== */

}
