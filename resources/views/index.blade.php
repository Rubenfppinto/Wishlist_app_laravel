@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="pr-3">
                <h5><strong>Total items: </strong>{{ $products->count() }}</h5>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-sm-12 col-md-6 col-lg-4 pb-3">
                    <div class="card card-style">
                        <div class="card-body">
                            <h5 class="text-center">{{ $product->name }}</h5>
                            <hr>
                            <div class="text-center">
                                <img src="{{ $product->image }}" class="card-img-top" style="width: 170px; height: 150px;">
                            </div>
                            <p class="pt-2">Price: £{{ $product->price }}</p>
                            <p>Category: {{ $product->category }}</p>
                            <p>Priority: {{ $product->priority }}</p>
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <a href="{{ $product->url }}" target="_blank">Link</a>
                                </div>

                                <div class="d-flex">
                                    @canany(['update','delete'], $product)
                                        <a class="pr-1" href="/product/{{ $product->id }}/edit"><button class="btn btn-success btn-sm">Edit</button></a>

                                        <form action="/product/{{ $product->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf

                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endcanany
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
