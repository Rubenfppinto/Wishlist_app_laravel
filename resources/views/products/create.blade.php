@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Add a new product</h1>
        <form action="/product" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row pt-3">
                <div class="col-8">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Product Name</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label">Price</label>

                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label">Category</label>

                        <select class="form-control" id="category" type="text" @error('category') is-invalid @enderror name="category" value="{{ old('category') }}">
                                <option value="" disabled selected hidden>Choose a category</option>
                                <option>Home</option>
                                <option>Office</option>
                            </select>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="priority" class="col-md-4 col-form-label">Priority</label>

                        <select class="form-control" id="priority" type="text" @error('priority') is-invalid @enderror name="priority" value="{{ old('priority') }}">
                                <option value="" disabled selected hidden>Choose a priority</option>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Highest</option>
                            </select>
                        @error('priority')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label">Link</label>

                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" autocomplete="url" autofocus>

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">Upload a product image</label>

                        <input type="file" class="form-control-file" id="image" name="image">

                        @error('image')

                                <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="row pt-3">
                        <input type="submit" value="Add product" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
