@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <ul class="admin-routes">
                <li>
                    <a href="{{url('/admin')}}" class="text-black">Categories</a>
                </li>
                <li>
                    <a href="{{url('/adminSize')}}">Sizes</a>
                </li>
            </ul>
        </div>
    <div>
        <h2>Colors list</h2>
        <div class="mt-5">
            <a href="{{route('adminColor.create')}}"><button class="btn btn-primary">Add Color</button></a>
        </div>
    <divcl
    mt-2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Color name</th>
                <th scope="col">Color</th>
                <th scope="col">Details</th>

            </tr>
            </thead>
            <tbody>
            @foreach($colors as $color)
                <tr>
                    <th scope="row">{{$color->id}}</th>
                    <th scope="row">{{$color->color}}</th>
                    <th scope="row"><span style="display: inline-block;width: 20px; height: 20px; background-color: {{$color->color}};"></span></th>
                    <th scope="row">
                        <a href="{{route('adminColor.edit',$color->id)}}"><button class="btn btn-primary">Edit</button></a>
                        <button class="btn btn-danger delete-color" data-bs-toggle="modal" data-bs-target="#deleteColorModal"
                                data-id="{{ $color->id }}">delete</button>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </divcl>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-danger colorModal" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){

            $('.delete-color').click(function () {
                window.color_id = $(this).data('id');
            })

            $('.colorModal').click(function () {
                $.ajax('/adminColor/' + color_id, {
                    method: 'DELETE',
                    dataType: 'Json',
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

        });
    </script>
@endsection
