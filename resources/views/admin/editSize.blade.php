@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{url('adminSize',$edit_size->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" name="size" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ $edit_size->size }}">
                <span class="text-danger">@error('size'){{$message}} @enderror</span>
            </div>
            <button type="submit" class="btn btn-primary mt-4 add-menu-item">Edit</button>
        </form>
        <div>
            <a href="{{ route('adminSize.index') }}"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
        </div>
    </div>
@endsection
