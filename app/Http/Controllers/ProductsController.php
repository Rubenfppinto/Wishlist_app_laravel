<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
use \App\User;
use Intervention\Image\Facades\Image;

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

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(200, 200);
        $image->save();

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

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Product $product)
    {
        $data = request()->validate([
            'name' => 'required',
            'price' => 'required',
            'priority' => 'required',
            'category' => 'required',
            'url' => ['required', 'url'],
            'image' => '',
        ]);

        auth()->user()->products->id->update($data);

        return redirect("/profile/" . auth()->user()->id);
    }
}
