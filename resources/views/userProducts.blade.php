@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col-lg-6 mt-4">
                <div class="product  bg-white">
                    <div class="main-image">
                        <img src="{{asset('images/product-images/'.$product->main)}}" width="100%" height="300px">
                    </div>
                    <div class="p-3">
                        <h3><a href="{{route('product.show',$product->id)}}"
                               class="text-black text-decoration-none">{{Str::limit($product->product_name,30)}}</a>
                        </h3>
                        <p>{{Str::limit($product->description,50)}}</p>
                        <p class="price">{{$product->price}}<sup class="price-sup"> 00</sup> $</p>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger delete-product" data-id="{{$product->id}}" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">Delete
                        </button>
                        <button class="btn btn-warning"><a href="{{route('product.edit',$product->id)}}"
                                                           class="text-white">Edit</a></button>
                    </div>

                </div>
            </div>
        @endforeach
        <div class="col-lg-6"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Are you sure delete todo</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger deleteModal" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.delete-product').click(function () {
            window.product_id = ($(this).data('id'));
        })

        $('#deleteModal').click(function () {

            $.ajax('/product/' + product_id, {
                method: 'DELETE',
                dataType: 'Json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data) {
                        // location.reload();
                        alert();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    console.log('error', jqXhr, textStatus, errorMessage);
                }
            })
        })
    </script>
@endsection
