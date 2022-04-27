@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5">
                <div class="main-image">
                    <img src="{{asset('images/product-images/'.$product->main)}}" width="100%" class="product-main-img"
                         height="350px">
                </div>
                <div class="mt-3">
                    <div class="all-images">
                        @foreach($images as $image)
                            <div><img src="{{asset('images/product-images/'.$image->image_name)}}" width="100px"
                                      height="100px" class="product-img" style="cursor: pointer"></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7">

                <h2>{{$product->product_name}}</h2>
                <p>{{$product->description}}</p>

                <ul class="product-show-attributes">
                    <li class="d-block mt-3"><b>Brand:</b><span class="ms-4">{{$product->brand}}</span></li>
                    @if(count($colors))
                        <li class="mt-3"><b>Color:</b>
                            <ul class="d-inline-block ms-4">
                                @foreach($colors as $color)
                                    <li style="background-color: {{$color->color}}; width: 20px;height: 20px"
                                        value="{{$color->id}}"></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    <li class="d-block mt-3"><b>Price:</b><span class="ms-4 price">{{$product->price}}<sup
                                class="price-sup"> 00</sup> $</span></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        $('.all-images').slick({
            slidesToShow: 3,
        });

        $('.product-img').click(function () {
            const src = $(this).attr('src');
            $('.product-main-img').attr('src', src);
        })
    </script>
@endsection

