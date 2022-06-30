@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include("layouts.sidebar")
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h3 class="card-title">modify the product {{$product->name}}</h3>
                <div class="card-body">
                    <form method="post" action="{{ route("products.update",$product->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group m-1">
                            <input type="text"
                            name="name"
                            value="{{$product->name}}"
                            placeholder="name"
                            class="form-control">
                        </div>
                        <div class="form-group m-1">

                            <textarea name="description" placeholder="description"
                                cols="30" rows="10" class="form-control" >{{$product->description}}</textarea>
                        </div>
                        <div class="form-group m-1">
                            <input type="number"
                                name="price"
                                value="{{$product->price}}"
                                placeholder="Price"
                                class="form-control">
                        </div>
                        <div class="form-group m-1">
                            <input type="number"
                            name="old_price"
                            value="{{$product->old_price}}"
                            placeholder="Old Price"
                            class="form-control">
                        </div>
                        <div class="form-group m-1">
                            <input type="number"
                            name="in_stock"
                            value="{{$product->in_stock}}"
                            placeholder="In Stock"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset($product->image) }}"
                            width="200"
                            height="200"
                            alt="{{ $product->title }}">
                        </div>
                        <div class="form-group m-1">
                            <input type="file"
                            name="image"
                            class="form-control">
                        </div>
                        <div class="form-group m-1">
                            <select name="category_id" class="form-control">
                                <option value="" selected disabled>
                                    Choose a category
                                </option>
                                @foreach ($categories as $category)
                                    <option
                                    {{ $product->category_id === $category->id ? "selected" : "" }}
                                    value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-1">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection