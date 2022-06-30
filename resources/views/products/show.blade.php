@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">{{ $product->name }}</h3>
                <div class="card-img-top">
                    <img class="img-fluid w-100" src="{{ asset($product->image) }}"
                        alt="{{ $product->name }}">
                </div>
                <div class="card-body">
                    <h5 class="card-name">
                        {{ $product->name }}
                    </h5>
                    <p class="text-dark font-weight-bold">
                        {{ $product->category->name }}
                    </p>
                    <p class="d-flex flex-row justify-content-between align-items-center">
                        <span class="text-muted">
                            {{ $product->price }} $
                        </span>
                        <span class="text-danger">
                            <strike>
                                {{ $product->old_price }} $
                            </strike>
                        </span>
                    </p>
                    <p class="card-text">
                        {{ $product->description }}
                    </p>
                    <p class="font-weight-bold">
                        @if($product->in_stock > 0)
                            <span class="text-success">
                                In Stock
                            </span>
                        @else
                            <span class="text-danger">
                                Out of Stock
                            </span>
                        @endif
                    </p>
                </div>
                <div class="col-md-4 m-3 ">
                    <form action="{{route("add.cart",$product->slug)}}" class="action" method="post">
                        @csrf
                        <div class="form-group m-2">
                            <label for="quantity" class="label-input">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" placeholder="quantity" 
                            max="{{ $product->in_stock }}"
                            min="1">
                        </div>
                        <div class="form-group m-2 ">
                            <button type="submit" class="btn text-white btn-block bg-primary">
                                <i class="fa fa-shopping-cart"></i>
                                add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection