<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Order;


class AdminController extends Controller
{
    //
    public function home(){
        return view('admin.home');
    }

    public function addcat(){
        return view('admin.addcategory');
    }

    public function listcat(){
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }

    public function addslider(){
        return view('admin.addslider');
    }

    public function listslider(){
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function listproduct(){
        $produits = Product::get();
        return view('admin.products')->with('produits', $produits);
    }

    public function addproduct()
    {
        $cat = Category::get();
        return view('admin.addproduct')->with('categories', $cat);
    }

    public function listorder(){
        $orders = Order::get();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);

            return $order;
        });
        return view('admin.orders')->with('orders', $orders);
    }
}
