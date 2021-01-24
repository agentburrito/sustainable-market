<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('welcome');
        }

        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('categories.index')->with([
            'categories'  => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('welcome');
        }

        $validatedData = $this->validate($request, [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric'
        ]);

        Category::create($validatedData);

        return redirect()->route('category.index')->withSuccess('You have successfully added a category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->get();

        return view('categories.show', compact('category', 'parentCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('welcome');
        }

        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string'
        ]);

        $category->update($validatedData);

        return redirect()->route('category.index')->withSuccess('You have successfully updated a category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('welcome');
        }

        if ($category->children) {
            foreach ($category->children()->with('listings')->get() as $child) {
                foreach ($child->listings as $listing) {
                    $post->update(['category_id' => NULL]);
                }
            }
            
            $category->children()->delete();
        }

        foreach ($category->listings as $listing) {
            $listing->update(['category_id' => NULL]);
        }

        $category->delete();

        return redirect()->route('category.index')->withSuccess('You have successfully deleted a category!');
    }
}
