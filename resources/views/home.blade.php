@extends('layouts.app')

@section('content')

<main role="main">

    <section class="py-5 text-center ">
        <div class="container bg-info bg-opacity-25  border-info my-2 border border-4  my-3" >
            <h1 class="jumbotron-heading">buy and wear <br><span class="badge badge-light text-warning">NEW</span> <br>Clothes <span class="badge badge-primary text-danger ">good bands and cheap !</span></h1>
            <p class="lead text-muted"> be elegant</p>

        </div>
    </section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header"> lastest product</h3>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-6 mb-2 shadow-sm">
                                    <div class="card" style="width:18rem,height:100%">
                                        <div class="card-img-top">
                                            <img class="img-fluid rounded" src="{{asset($product->image)}}" alt="{{$product->title}}">
                                        </div> 
                                            <div class="card-body">
                                                <h5 class="card-title">{{$product->name}}</h5>
                                                <p class="d-flex flex-row justify-content-between align-items-center">
                                                    <span class="text-muted">{{ $product->price}} $</span> 
                                                    <span class="text-danger"> <strike> {{ $product->old_price}} $</strike></span> 
                                                </p>
                                                <p class="card-text">
                                                    {{Str::limit($product->description,100)}}
                                                </p>
                                                <a href="{{route ("products.show",$product->slug)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </div>
                           
                        </div>
                     @endforeach
                    </div>
                    <hr>
                    <div class="justify-content-center d-flex">
                        {{$products->links()}}
                    </div>
            </div>
        </div>
        
    </div>
</div>
    <div class="col-md-4">
        <div class="list-group">
           <li class="list-group-item active">
                 <h3>Categories</h3>    
                 @foreach($categories as $category)
                    <a href="{{ route("category.products",$category->slug) }}" 
                        class="list-group-item list-group-item-action" >

                    {{$category->products->count()}} {{$category->name}}
                    </a>
                @endforeach
           </li>
        </div>
        <div class="navbar navbar-expand-lg navbar-light bg-red">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
               @foreach($genders as $gender ) 
                <li class="nav-item">
                    <a class="nav-link" href="#">{{$gender->name}}</a>
                </li>
                 @endforeach
                
            </ul>
        </div> --}}
    </div>
    </div>

    </div>
</div>
@endsection
