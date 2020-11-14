<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
use \App\User;
use Illuminate\Support\Facades\Redirect;
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
            'image' => ['required','url'],
        ]);

        //fetches the autheticated user and adds the product through the relationship with User
        auth()->user()->products()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'priority' => $data['priority'],
            'category' => $data['category'],
            'url' => $data['url'],
            'image' => $data['image'],
        ]);

        return redirect('/user/' . auth()->user()->id);//->with('variable', 'message to output in the view")
        //This could be use to pass a message into the view with the redirect
    }

    public function edit(Product $product, User $user)
    {
        $this->authorize('update', $product);

        $categories = [
            'Home',
            'Office',
            'Kitchen',
            'Other'
        ];

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(User $user, Product $product)
    {
        $user = auth()->user();

        $product = Product::where([
            'user_id' => $user->id,
            'id' => $product->id,
        ])->first();

        $this->authorize('update', $product);
        $data = request()->validate([
            'name' => 'required',
            'price' => 'required',
            'priority' => 'required',
            'category' => 'required',
            'url' => ['required', 'url'],
            'image' => '',
        ]);

        $product->update($data);

        return redirect("/user/" . $user->id);
    }

    public function destroy(Product $product)
    {

        $user = auth()->user();

        $product = Product::where([
            'user_id' => $user->id,
            'id' => $product->id,
        ])->first();

        $this->authorize('delete', $product);
        $product->delete();

        return back();
    }
}
