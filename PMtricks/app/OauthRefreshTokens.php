<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshTokens extends Model
{
    protected $table = 'oauth_refresh_tokens';
    public $timestamps = false;
}
