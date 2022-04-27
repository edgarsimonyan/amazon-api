@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach($products as $product)

            <div class="col-lg-6 mb-3">
                <div class="product">
                    <div class="main-image">
                        <img src="{{asset('images/product-images/'.$product->main)}}" width="100%" height="350px">
                    </div>
                    <div class="p-3 bg-white">
                        <h3><a href="{{route('product.show',$product->id)}}"
                               class="text-black text-decoration-none">{{Str::limit($product->product_name,25)}}</a>
                        </h3>
                        <p>{{Str::limit($product->description,50)}}</p>
                        <p class="price">{{$product->price}}<sup class="price-sup"> 00</sup> $</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
