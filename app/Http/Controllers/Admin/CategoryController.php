<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:create_category')->only(['create','store']) ;
        $this->middleware('permission:update_category')->only(['edit','update']) ;
        $this->middleware('permission:delete_category')->only(['destroy']) ;
        $this->middleware('permission:read_categories')->only(['index']) ;
    }
    public function index()
    {
        $categories = Category::all() ;
        return view ('admin.categories.categories' ,compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.categories.add' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
      

             Category::create(
                $request->only('name')
            );
            return redirect()->route('categories.index')
                ->with('success', 'Category has been created successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category= Category::findOrFail($id) ;
            return view('admin.categories.edit', compact("category"));
        } catch (\Exception $e) {
            return \generalException('categories.index');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = Category::FindOrFail($id);
            $category->update($request->only(['name']));
            return redirect()->route('categories.index')
                ->with('success', 'Category has been updated successfully');
        } catch (\Exception $e) {
            return \generalException('categories.index');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('categories.index')
                ->with('success', 'Category has been deleted successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('category.index');
        }
    }
}
