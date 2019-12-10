<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process_group extends Model
{
    protected $table = 'process_groups';
    public $primaryKey = 'id';
    public $timestamps = true;
}
