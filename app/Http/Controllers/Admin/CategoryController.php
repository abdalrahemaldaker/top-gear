<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\updateCategoryRequest;
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
       // $categories=Category::all();
        $categories=Category::paginate(3);
        $categories->withquerystring();
       return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //$validated=$request->validate([   ]);

        //dd($request);
        /*$category= new Category();
        $category->name=$request->name;
        $category->capacity=$request->capacity;
        $category->save();
        */
        $validated=$request->validated();
        $category=Category::create($validated);
        session()->flash('message' , 'Added succesfuly');
        session()->flash('message-color' , 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoryRequest $request, Category $category)
    {

       $category->update($request->validated());
       session()->flash('message' , 'updated succesfuly');
        session()->flash('message-color' , 'success');
       return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message' , 'Deleted succesfuly');
        session()->flash('message-color' , 'warning');
        return redirect()->route('admin.categories.index');

    }
}
