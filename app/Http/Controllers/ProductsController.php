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

        //$imagePath = request('image');

        //dd($imagePath);

        //$image = Image::make($imagePath)->resize(200, 100);
        //$image->save();

        //fetches the autheticated user and adds the product through the relationship with User
        auth()->user()->products()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'priority' => $data['priority'],
            'category' => $data['category'],
            'url' => $data['url'],
            'image' => $data['image'],
            //'image' => $image,
        ]);

        return redirect('/user/' . auth()->user()->id);//->with('variable', 'message to output in the view")
        //This could be use to pass a message into the view with the redirect
    }

    public function edit(Product $product, User $user)
    {
        //$this->authorize('update', $user->product);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request)
    {
        // dd($request->priority, $request->category, $request->toArray());

        $data = request()->validate([
            'name' => 'required',
            'price' => 'required',
            'priority' => 'required',
            'category' => 'required',
            'url' => ['required', 'url'],
            'image' => '',
        ]);

        $productId = $request->productId;
        $user = auth()->user();

        $product = new Product();
        $thisProduct = $product->where([
            'user_id' => $user->id,
            'id' => $productId,
        ])->first();

        if (!$thisProduct)
        {
            $errors = ['errors' => 'The product you are trying to edit belongs to other user'];
            return Redirect::back()->withErrors($errors);
        }

        $thisProduct->update($data);

        return redirect("/user/" . $user->id);
    }

    public function destroy(Request $request)
    {
        $productId = $request->productId;
        $user = auth()->user();

        $product = new Product();
        $thisProduct = $product->where([
            'user_id' => $user->id,
            'id' => $productId,
        ])->first();

        $thisProduct->delete();

        return back();
    }
}