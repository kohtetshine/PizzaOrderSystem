<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::orderBy('category_id','desc')->get();
        return view('admin.category.list',compact('categories'));
    }
    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }
    //do create category
    public function create(Request $request){
       $this->categoryValidation($request);
       $data=$this->requestCategoryData($request);
       Category::create($data);
       return redirect()->route('admin#categorylist');
    }
    //category Validation Check
    private function categoryValidation($request){
        Validator::make($request->all(),[
            'categoryName'=> 'required|unique:categories,category_name'
        ],[
            'categoryName.required' => 'The category name field is required.You Need To Fill',
            'categoryName.unique' => 'The category name field is already created.',

    ])->validate();
    }

    private function requestCategoryData($request){
        return[
            'category_name'=>$request->categoryName,
        ];
    }
}
