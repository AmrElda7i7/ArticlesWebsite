<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('permission:update_article')->only(['edit','update']) ;
        $this->middleware('permission:delete_article')->only(['destroy']) ;
        $this->middleware('permission:read_articles')->only(['index' , 'show']) ;
    }
    public function index()
    {
        $articles= Article::where('status','=','published')->get() ;
        return view('admin.articles.articles' ,compact('articles') );
    }

    public function show(string $id)
    {
        try
        {
            $article = Article::findOrFail($id) ;
            $categories = Category::all() ;
            return view('user.articles.article',compact('categories','article')) ;
        }catch(\Exception) 
        {
            abort(404) ;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $categories = Category::all();
            $article = Article::findOrFail($id);
            return view('admin.articles.edit', compact('article', 'categories'));
        } catch (\Exception $e) {
            return \generalException('articles.index');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        try {
            $article = Article::findOrFail($id);
            $image = $article->image->name;
            $article->update(
                [
                    'title' => $request->name,
                    'body' => $request->editor,
                    'category_id' => $request->category,
                ]
            );
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::disk('uploads')->delete($id . '/' . $image);
                $image = $request->file('image');
                $this->imageService->updateImage($image, $article->id);
            }
            return redirect()->route('articles.index')
                ->with('success', 'Article has been updated successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('articles.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $article = Article::findOrFail($id);
            Storage::disk('uploads')->deleteDirectory($id);
            $article->delete();
            return redirect()->route('articles.index')
                ->with('success', 'Role has been deleted successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('articles.index');
        }
    }
    public function waitingArticles()
    {
        $waitingArticles= Article::where('status','=','waiting')->get() ;
        return view('admin.articles.waiting_articles' ,compact('waitingArticles') );
    }
    public function acceptArticle($id)
    {
        try {
            $article = Article::findOrFail($id) ;
            $article->update(
                [
                    'status' => 'published'
                ]
            ) ;
            return redirect()->route('articles.index')
            ->with('success', 'article has been accepted successfully');
        }catch (\Throwable $e) {
            return \generalException('articles.index');
        }catch(ModelNotFoundException $e) 
        {
            abort(404) ;

        }
    }
    public function rejectArticle($id)
    {
        try {
            $article = Article::findOrFail($id);
            Storage::disk('uploads')->deleteDirectory($id);
            $article->delete();
            return redirect()->route('articles.index')
                ->with('success', 'article has been rejected successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('articles.index');
        }
    }
}