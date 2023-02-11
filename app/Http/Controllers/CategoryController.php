<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::when(request('searchdata'),function($q){
            $key=request('searchdata');
            $q->where('category_name','like','%'.$key.'%');
        })->orderBy('id','desc')->paginate(4);
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
       return redirect()->route('admin#categorylist')->with(['message'=>'Created Successfully']);
    }
    //do delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['message'=>'Delete Successfully']);
    }

    //direct edit page
    public function editPage($id){
        $data=Category::where('id',$id)->get();
        return view('admin.category.edit',compact('data'));
    }

    //do update category
    public function update(Request $request)
    {
        $this->categoryValidation($request);
        $data = $this->requestCategoryData($request);
        $id= $request->categoryId;
        Category::where('id',$id)->update($data);
        return redirect()->route('admin#categorylist')->with(['message' => 'Updated Successfully']);
    }



    //category Validation Check
    private function categoryValidation($request){
        Validator::make($request->all(),[
            'categoryName'=> 'required|unique:categories,category_name,'. $request->categoryId,
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
