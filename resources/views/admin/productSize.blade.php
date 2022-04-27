@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <ul class="admin-routes">
            <li>
                <a href="{{url('/admin')}}" class="text-black">Categories</a>
            </li>
            <li>
                <a href="{{url('/adminColor')}}">Colors</a>
            </li>
        </ul>
    </div>
    <div>
        <h2>Size list</h2>
        <div>
            <a href="{{route('adminSize.create')}}"><button class="btn btn-primary mt-4 add-menu-item">Create Size</button></a>
        </div>
    <div class="mt-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">size</th>
                <th scope="col">Details</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sizes as $size)
            <tr>
                <th scope="row">{{$size->id}}</th>
                <th scope="row">{{$size->size}}</th>
                <th scope="row">
                    <a href="{{route('adminSize.edit',$size->id)}}"><button class="btn btn-primary">Edit</button></a>
                    <button class="btn btn-danger delete-size" data-bs-toggle="modal" data-bs-target="#deleteSizeModal"
                            data-id="{{ $size->id }}">delete</button>
                </th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteSizeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger SizeModal" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('.delete-size').click(function () {
            window.size_id = $(this).data('id');
        })

        $('.SizeModal').click(function () {
            $.ajax('/adminSize/' + size_id, {
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
