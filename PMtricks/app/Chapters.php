<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    protected $table = 'chapters';
    public $primaryKey = 'id';
    public $timestamps = true;
}
