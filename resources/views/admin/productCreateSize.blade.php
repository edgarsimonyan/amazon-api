@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-5">
            <h2>Create Size</h2>
            <form action="{{url('adminSize')}}" method="POST">
                @method('POST')
                @csrf
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" name="size" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ old('size') }}">
                    <span class="text-danger">@error('size'){{$message}} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary mt-4 add-menu-item">Add size</button>
            </form>
            <div>
                <a href="{{ url('adminSize/back') }}" class="d-inline-block"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
            </div>
        </div>
    </div>
@endsection
