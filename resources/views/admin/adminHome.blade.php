@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <ul class="admin-routes">
                <li>
                    <a href="{{url('/adminSize')}}" class="text-black">Sizes</a>
                </li>
                <li>
                    <a href="{{url('/adminColor')}}">Colors</a>
                </li>
            </ul>

        </div>
        <div>
            <h2>menu list</h2>
            <div class="mt-5">
                <a href="{{route('admin.create')}}"><button class="btn btn-primary">Create Category</button> </a>
            </div>
        </div>
        <div class="mt-2">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">category name</th>
                    <th scope="col">parent id</th>
                    <th scope="col">details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                @csrf
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->parent_id}}</td>
                    <td>
                        <a href="{{route('admin.edit',$category->id)}}"><button class="btn btn-info">Edit</button></a>
                        <button class="btn btn-danger delete-category" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                data-id="{{ $category->id }}">delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        $(document).ready(function(){
            $('#category').change(function() {
                $('option').removeAttr('category_status');
                $(this).attr('name','category_status');
            })

            $('.delete-category').click(function () {
                window.category_id = $(this).data('id');
            })

            $('.deleteModal').click(function () {
                $.ajax('/admin/' + category_id, {
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
