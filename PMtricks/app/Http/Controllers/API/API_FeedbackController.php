<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Feedback\FeedbackCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class API_FeedbackController extends Controller
{
    public function index(Request $req){
        return FeedbackCollection::collection(\App\Feedback::orderBy('created_at', 'desc')->paginate($req->per_page) );
    }
}
