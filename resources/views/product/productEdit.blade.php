@extends('layouts.app')

@section('content')
    <div>
        <a href="{{route('home')}}" class="back"><i class="fa fa-long-arrow-left go-back" aria-hidden="true"></i><span class="back-text">back</span></a>
    </div>
    <div class="container">
        <h1>Edit Product</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('product',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Name" value="{{$product->product_name}}">
                        <span class="text-danger">@error('product_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Description:</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Description" value="{{$product->description}}">
                        <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Brand:</label>
                        <input type="text" name="brand" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Brand" value="{{$product->brand}}">
                        <span class="text-danger">@error('brand'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Price:</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Price" value="{{$product->price}}">
                        <span class="text-danger">@error('price'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Colors:</label>
                        <div class="w-50">
                            <ul>
                                @foreach ($colors as $color)
                                    <li class="d-inline-block check-color" data-id="{{$color->id}}"
                                        style="width: 35px; height: 35px; background-color: {{$color->color}}">
                                            @if (in_array($color->id,$productColors))
                                                <i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>
                                            @endif
                                        <input type="hidden" name="colors[]" value="{{ $color->id }}">
                                    </li>
                                @endforeach
                            </ul>
                            <span class="text-danger">@error('colors.*'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Size:</label>
                        <ul class="d-flex">
                            @foreach($sizes as $size)
                                <li data-id="{{$size->id}}" class="check-size">{{$size->size}}
                                        @if (in_array($size->id,$productSizes))
                                            <i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>
                                        @endif
                                    <input type="hidden" name="sizes[]" value="{{$size->id}}">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category" class="form-label">Choose Category:</label>
                        <select class="form-select" aria-label="Default select example" id="category">
                            <option value=null>Open this menu list</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @if($product->category_status == $category->id)
                                        selected value="{{$product->category_status}}" name="category_status"
                                    @endif>
                                    {{$category->category_name}}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('category_status'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Edit Product</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12 mt-5">
                <div class="row">
                    @foreach($images as $image)
                        <div class="col-lg-4 position-relative">
                            <img src="{{asset('images/product-images/'.$image->image_name)}}" height="300px"
                                 class="checked-image {{$product->main == $image->image_name ? 'checked-for-main opacity-50' : ''}}"
                                 data-image-name="{{$image->image_name}}" data-product-id="{{$product->id}}">
                            <i class="fa fa-times remove-image" data-image-id="{{$image->id}}"
                               data-product-id="{{$product->id}}"></i>
                        </div>
                    @endforeach
                </div>
                <form action="{{route('product.addProductImage',$product->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="formFile" class="form-label">Choose File</label>
                        <input class="form-control" type="file" id="product-images" name="images[]" multiple>
                        <span class="text-danger">@error('images'){{ $message }} @enderror</span>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Add image</button>
                    </div>
                </form>
            </div>
            <div class="row mt-4 gallery"></div>
            <div class="col-md-12">

            </div>
        </div>
    </div>
    <script>
        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input) {
                if (input.files) {
                    var filesAmount = input.files.length; // 3

                    for (let i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            $('.gallery').append('' +
                                '<div class="col-lg-4 position-relative">' +
                                '<img src="' + event.target.result + '" class="checked-image" data-id=' + i + ' >' +
                                '<i class="fa fa-times remove-product-image"></i>' +
                                '</div>'
                            )

                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#product-images').on('change', function () {
                imagesPreview(this);
            });

        });

        $(document).on('click', '.remove-product-image', function () {
            $(this).parent().fadeOut()
            setTimeout(function () {
                $(this).parent().remove();
            }, 500);
        })

        $(document).on('click', '.checked-image', function () {
            const product_id = $(this).data('product-id');
            const image_name = $(this).data('image-name');

            $('.checked-image').removeClass('checked-for-main');
            $('.checked-image').removeClass('opacity-50');
            $(this).addClass('checked-for-main');
            $(this).addClass('opacity-50')

            $.ajax('/main-image', {
                method: 'POST',
                dataType: 'Json',
                data: {product_id, image_name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data) {
                        location.reload();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    console.log('error', jqXhr, textStatus, errorMessage);
                }
            })
        })

        $(document).ready(function () {

            $('#category').each(function () {
                if ($(this).attr('selected', true)) {
                    $(this).attr('name', 'category_status');
                }
            })

            $('.check-color').each(function () {
                let value
                if ($(this).find('i').length) {
                    value = $(this).data('id')
                } else {
                    value = null
                }
                $(this).children().val(value)
            })

            $('.check-size').each(function () {
                let value
                if ($(this).find('i').length) {
                    value = $(this).data('id')
                } else {
                    value = null
                }
                $(this).children().val(value)
            })

            $('.remove-image').click(function () {
                const image_id = $(this).data('image-id');
                const product_id = $(this).data('product-id');
                $.ajax('/remove-image/' + image_id, {
                    method: 'DELETE',
                    dataType: 'Json',
                    data: {product_id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data) {
                            location.reload();
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) { // error callback
                        console.log('error', jqXhr, textStatus, errorMessage);
                    }
                })
            })

            $('#category').change(function () {
                $('option').removeAttr('category_status');
                $(this).attr('name', 'category_status');
            })

            $('.check-size').click(function () {

                if ($(this).find('i').length) {
                    $(this).find('i').remove()
                } else {
                    $(this).append('<i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>');
                }

                const value = $(this).children().val() ? null : $(this).data('id')
                $(this).children().val(value)

            })
            $('.check-color').click(function () {
                if ($(this).find('i').length) {
                    $(this).find('i').remove()
                } else {
                    $(this).append('<i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>');
                }
                const value = $(this).children().val() ? null : $(this).data('id')
                $(this).children().val(value)
            })
        })
    </script>
@endsection
