@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{url('admin',$edit_category->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" name="category_name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ $edit_category->category_name }}">
            <span class="text-danger">@error('categories-name'){{$message}} @enderror</span>
        </div>
        <select class="form-select" aria-label="Default select example" id="category">
            <option name="category_status" value=null>Open this menu list</option>

            @foreach($categories as $category)
                <option value="{{$category->id}}" name="category_status"
                        @if($edit_category->parent_id === $category->id) selected value="{{$edit_category->parent_id}}"
                        @endif>{{$category->category_name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-4 add-menu-item">Edit</button>
    </form>
        <div>
            <a href="{{route('admin.index')}}"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#category').change(function () {
                $('option').removeAttr('category_status');
                $(this).attr('name', 'category_status');
            })
        })
    </script>
@endsection
