<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function add(Request $request){

        $this->validate($request, [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_category'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        //Gestion de l'img
        //Nom avec Extension
        $nomAvecExt = $request->file('image')->getClientOriginalName();

        //Nom sans Extension
        $nomSansExt = pathinfo($nomAvecExt, PATHINFO_FILENAME);

        //Extension
        $ext = pathinfo($nomAvecExt, PATHINFO_EXTENSION);

        //Nouveau nom unique a mettre dans la BD
        $nouveauNom = $nomSansExt.'_'.time().'.'.$ext;

        //Uploader l'img
        $chemin = $request->file('image')->storeAs('public/products_img', $nouveauNom);

        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');


        $product->product_image = $nouveauNom;
        $product->save();

        return back()->with('status', 'Le produit a ete ajoute avec success');
    }

    public function delprod($id){
        $prod = Product::find($id);
        Storage::delete("public/products_img/$prod->product_image");
        $prod->delete();

        return back()->with("status", 'Votre produit a ete supprime avec succes.');
    }

    public function editprod($id){
        $product = Product::find($id);
        $cate = Category::get();
        return view('admin.editproduct')->with('product', $product)->with("categories", $cate);
    }

    public function updateprod($id, Request $request) {
        $this->validate($request, [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_category'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        $product = Product::find($id);
        $product->product_name = $request->input('product_name');
        $product->product_category = $request->input('product_category');
        $product->product_price = $request->input('product_price');

        if (($request->file('image'))){
            //Nom avec Extension
            $nomAvecExt = $request->file('image')->getClientOriginalName();

            //Nom sans Extension
            $nomSansExt = pathinfo($nomAvecExt, PATHINFO_FILENAME);

            //Extension
            $ext = pathinfo($nomAvecExt, PATHINFO_EXTENSION);

            //Nouveau nom unique a mettre dans la BD
            $nouveauNom = $nomSansExt.'_'.time().'.'.$ext;

            //Uploader l'img
            $chemin = $request->file('image')->storeAs('public/products_img', $nouveauNom);
            Storage::delete("storage/products_img/$product->image");
            $product->product_image = $nouveauNom;
        }
         $product->save();

        return redirect('admin/products')->with('status', 'Le produit a ete modifie avec succes');
    }

    public function unactivate($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->update();

        return back()->with("status", 'Modifier avec succes');
    }

    public function activate($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->update();

        return back()->with("status", 'Modifier avec succes');
    }
}
