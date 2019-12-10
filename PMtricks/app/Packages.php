<?php

namespace App;

use App\QuestionRoles;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';
    public $primaryKey = 'id';
    public $timestamps = true;
}
