<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxonomy extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'group', 'type', 'position', 'code', 'name', 'short_name',
        'active', 'icon', 'slug', 'desctiption', 'parent_taxonomy_id'
    ];

    /* ============================== SCOPES ============================== */

    public function scopeRateThread($q, $action = 'like-thread')
    {
        return $q->where('group', 'user-actions')
            ->where('type', 'threads')
            ->where('code', $action)
            ->first();
    }

    public function scopeRateComment($q, $action = 'like-comment')
    {
        return $q->where('group', 'user-actions')
            ->where('type', 'comments')
            ->where('code', $action)
            ->first();
    }

    /* ============================== RELATIONS ============================== */


    /* ============================== METHODS ============================== */

}
