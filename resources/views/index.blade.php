@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="pr-3">
            <p><strong>Total items: </strong>{{ $user->products->count() }}</p>
        </div>
        <div class="pr-3">
            <p><strong>Opened items: </strong>0</p>
        </div>
        <div class="pr-3">
            <p><strong>Closed items: </strong>0</p>
        </div>
    </div>
    <hr>
    <div class="row">
        @foreach ($user->products as $product)
        <div class="col-sm-12 col-md-6 col-lg-4 pb-3">
                <div class="card card-style">
                    <div class="card-body">
                        <h5 class="text-center">{{ $product->name }}</h5>
                        <hr>
                        <img src="/storage/{{ $product->image }}" class="card-img-top w-200 h-50">
                        <p class="pt-2">Price: £{{ $product->price }}</p>
                        <p>Category: {{ $product->category }}</p>
                        <p>Priority: {{ $product->priority }}</p>
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <a href="{{ $product->url }}" target="_blank">Link</a>
                            </div>
                            <div class="d-flex">
                                <a class="pr-1" href="/product/{{ $product->id }}/edit"><button class="btn btn-success btn-sm">Edit</button></a>

                                <form action="/product/{{ $product->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
