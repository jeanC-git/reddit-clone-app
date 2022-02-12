<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAction extends BaseModel
{
    use HasFactory;

    protected $fillable = [
      'app_user_id', 'taxonomy_id', 'model_type', 'model_id', 'score'
    ];

}
