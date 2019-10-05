<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;

class ProductsController extends Controller
{
    //it only allows anything in this controller and respective route to be seen if authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'price' => ['required', 'numeric'],
            'priority' => 'required',
            'category' => 'required',
            'url' => ['required', 'url'],
            'image' => ['required','image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        //fetches the autheticated user and adds the product through the relationship with User
        auth()->user()->products()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'priority' => $data['priority'],
            'category' => $data['category'],
            'url' => $data['url'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
}
