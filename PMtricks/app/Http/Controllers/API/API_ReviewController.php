<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Review\FeedbackCollection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class API_ReviewController extends Controller
{
    public function reviewByPackage(Request $req){
        $reviews = \App\Rating::where('package_id', $req->package_id)->orderBy('crated_at', 'desc')->paginate($req->per_page);
        return FeedbackCollection::collection($reviews);
    }
}
