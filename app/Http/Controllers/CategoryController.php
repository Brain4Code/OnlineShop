<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class  CategoryController extends Controller
{
    //
    public function savecat(Request $request){

        $cate = new Category;
        $cate->category_name = $request->input('category_name');
        $cate->save();
        return redirect('admin/categories')->with('status', 'La categorie '.$request->input('category_name').' a ete cree avec succes.');
    }

    public function delcat($id)
    {
        $cate = Category::find($id);
        $cate->delete();

        return back()->with("status", "La categorie ".$cate->category_name.' a ete supprime avec succes.');
    }

    public function editcat($id)
    {
        $cate = Category::find($id);

        return view('admin.editcategory')->with('category', $cate);
    }

    public function update($id, Request $request)
    {
        $cate = Category::find($id);
        $cate->category_name = $request->input("category_name");
        $cate->save();
        return redirect('admin/categories')->with('status', 'La categorie a ete modifie avec success.');
    }
}
