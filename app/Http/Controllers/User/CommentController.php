<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function addComment(StoreCommentRequest $request,$id) 
    {
        try 
        {

            comment::create(
                [
                    'body'=> $request->comment ,
                    'article_id' => $id ,
                    'user_id' => auth()->user()->id
                    ]
                    )  ;
                    return response('done') ;
                }catch(\Exception $e)
                {
                    abort(404) ;
                }
    }
}
