@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="pr-2">
            <p><strong>Total items: </strong>20</p>
        </div>
        <div class="pr-2">
            <p><strong>Opened items: </strong>20</p>
        </div>
        <div class="pr-2">
            <p><strong>Closed items: </strong>20</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card card-style">
                <div class="card-body">
                    <h5 class="text-center">Item 1</h5>
                    <hr>
                    <p>Price: £22</p>
                    <p>Category: home</p>
                    <p>Priority: high</p>
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <a href="#" target="_blank">Link</a>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
