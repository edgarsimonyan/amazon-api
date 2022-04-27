@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{url('adminColor',$edit_color->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control colorpicker" name="color" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ $edit_color->color }}">
                <span class="text-danger">@error('color'){{$message}} @enderror</span>
            </div>
            <button type="submit" class="btn btn-primary mt-4 add-menu-item">Edit</button>
        </form>
        <div>
            <a href="{{ url('adminColor/back') }}" class="d-inline-block"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
        </div>
    </div>
    <script type="text/javascript">
        $('.colorpicker').colorpicker({});
    </script>
@endsection
