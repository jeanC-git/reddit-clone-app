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

    public function scopeGroup($q, $group)
    {
        return $q->where('group', $group);
    }

    public function scopeType($q, $type)
    {
        return $q->where('type', $type);
    }

    public function scopeCode($q, $code)
    {
        return $q->where('code', $code);
    }

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
