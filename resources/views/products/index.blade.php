@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>
                <div class="card-body">                    
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>{{ $product->name }}</h5>
                                        <h5>&#x20b9; {{ number_format($product->price, 2) }} monthly</h5>
                                        <h5>{{ $product->description }}</h5>
                                        <a href="{{ route('products.show', $product->name) }}" class="btn btn-success btn-outline-dark pull-right">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection