<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'exam_num' => 'array',
    ];
}
