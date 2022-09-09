@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="width:24rem;margin:auto;">
        <div class="card-body">
            <form action="{{route('store.product')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="product name">Product Name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Product Name">
                    @if($errors)
                        <p class="text-danger mb-0">{{$errors['name']}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter Cost">
                    @if($errors)
                        <p class="text-danger mb-0">{{$errors['price']}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <label for="price">Product Description:</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description">
                    @if($errors)
                        <p class="text-danger mb-0">{{$errors['description']}}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary mt-2">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection