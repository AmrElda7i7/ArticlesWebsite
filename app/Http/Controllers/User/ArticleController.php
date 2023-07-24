<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {   
        $categories = Category::all() ;
        $articles = Article::all();
        return view('user.index', compact('articles' , 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('user.articles.add_article', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->name = $request->title;
            $article->body = $request->editor;
            $article->category_id = $request->category;
            $article->user_id = auth()->user()->id ;
            if (!auth()->user()->hasAnyRole(['admin', 'moderator'])) {
                $article->status = 'waiting';
            } else {
                $article->status = 'published';
            }
            $article->save();
            $image = $request->file('image');
            $this->imageService->storeImage($image, $article->id);
          return  response('your article is created successfully and wait us until we review and then accept it') ;
        } catch (\Exception $e) {
            abort(404);
        } 
    }
    public function show($id)
    {
        try
        {
            $article = Article::findOrFail($id) ;
            $article->increment('views') ;
            $categories = Category::all() ;
            return view('user.articles.article',compact('categories','article')) ;
        }catch(\Exception) 
        {
            abort(404) ;
        }
    }
}
