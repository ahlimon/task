<?php

namespace App\Http\Controllers;

use App\Category;
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
        $categories=Category::whereNull('parent_id')->paginate(5);
        return view('welcome',compact('categories'));

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
      // return $request->all();
      $request->validate([
        'name'=>'required|string|max:191'
      ]);

    $instertedCategory=Category::create([
        'name'=>$request->name
      ]);

    if(count($request->sub_categories)>0){
      foreach($request->sub_categories as $subCategory){
        if($subCategory!=''){
          Category::create([
              'name'=>$subCategory,
              'parent_id'=>$instertedCategory->id,
            ]);
        }
      }
    }
    return back()->with('success','Category and SubCategories are added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('editCategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      // return $request->all();

      $category->update([
          'name'=>$request->name
        ]);
      if(isset($request->sub_categories)){
        foreach($request->sub_categories as $key=>$value){
          $isExist=Category::where('id',$key)->first();
          if($isExist!=''){
            $isExist->name=$value;
            $isExist->save();
          }else{
            Category::create([
              'name'=>$value,
              'parent_id'=>$category->id,
            ]);
          }
        }
      }
      return redirect(route('crud.categories.index'))->with('success','Category and SubCategories are updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();
      return back()->with('success','Categories and SubCategories are deleted successfully');
    }
}
