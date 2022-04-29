@extends('layouts.app')

@section('content')
    <div>
        <a href="{{route('home')}}" class="back"><i class="fa fa-long-arrow-left go-back" aria-hidden="true"></i><span class="back-text">back</span></a>
    </div>
    <div class="container">
        <h1>Create Product</h1>
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-12">
                <form action="{{url('product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Name" value="{{old('product_name')}}">
                        <span class="text-danger">@error('product_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Description:</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Description" value="{{old('description')}}">
                        <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Brand:</label>
                        <input type="text" name="brand" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Brand" value="{{old('brand')}}">
                        <span class="text-danger">@error('brand'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Price:</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter Product Price" value="{{old('price')}}">
                        <span class="text-danger">@error('price'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Colors:</label>
                        <div class="w-50">
                            <ul>
                                @foreach($colors as $color)
                                    <li class="d-inline-block check-color" data-id="{{$color->id}}" style="width: 35px; height: 35px; background-color: {{$color->color}}">
                                        <input type="hidden" name="colors[]">
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
                                    <input type="hidden" name="sizes[]">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category" class="form-label">Choose Category:</label>
                        <select class="form-select" aria-label="Default select example" id="category">
                            <option selected name="category_status" value=null>Open this menu list</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('category_status'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formFile" class="form-label">Choose File</label>
                        <input class="form-control" type="file" id="product-images" name="images[]" multiple>
                        <input type="hidden" class="main" name="main">
                        <span class="text-danger">@error('images'){{ $message }} @enderror</span>
                        <span class="text-danger">@error('main'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Add Product</button>
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
                                    '<img src="' + event.target.result + '" class="checked-image" data-id='+i+' >' +
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
        $(document).on('click','.checked-image',function(){
            $('.checked-image').removeClass('checked-for-main');
            $('.checked-image').css({"opacity" : '1'})
            $(this).addClass('checked-for-main');
            $(this).css({"opacity" : '0.5'})
            $('.main').val($(this).data('id'));
        })

        $(document).ready(function() {
            $('#category').change(function () {
                $('option').removeAttr('category_status');
                $(this).attr('name', 'category_status');
            })

            $('.check-size').click(function () {
                const value = $(this).children().val() ? null : $(this).data('id')

                $(this).children().val(value)
                if (value) {
                    $(this).append(' <i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>');
                }
                else {
                    $(this).find('.checked-icon').remove();
                }

            })
            $('.check-color').click(function () {
                const value = $(this).children().val() ? null : $(this).data('id')
                $(this).children().val(value)
                if (value) {
                    $(this).append(' <i class="fa fa-check-square-o checked-icon" aria-hidden="true"></i>');
                }
                else {
                    $(this).find('.checked-icon').remove();
                }
            })
        })
    </script>
@endsection
