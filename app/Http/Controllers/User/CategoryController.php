<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id) ;
            $categories = Category::all() ;
            return view('user.category' ,compact('category' ,'categories')) ;
        }catch(ModelNotFoundException $e) 
        {
            abort(404) ;
        }
    }
}
