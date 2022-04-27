@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h2>Create category</h2>
        <form action="{{url('admin')}}" method="POST">
            @method('POST')
            @csrf
            <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" name="category_name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ old('categories-name') }}">
                <span class="text-danger">@error('categories-name'){{$message}} @enderror</span>
            </div>
            <select class="form-select" aria-label="Default select example" id="category">
                <option selected name="category_status" value=null>Open this menu list</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-4 add-menu-item">Add</button>
        </form>
        <div>
            <a href="{{url('admin/back')}}"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
        </div>
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
