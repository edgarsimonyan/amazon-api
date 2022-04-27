@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-5">
            <h2>Create Color</h2>
            <form action="{{url('adminColor')}}" method="POST">
                @method('POST')
                @csrf
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control colorpicker" name="color" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{ old('color') }}">
                    <span class="text-danger">@error('color'){{$message}} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary mt-4 add-menu-item">Add Color</button>
            </form>
            <div>
                <a href="{{ url('adminColor/back') }}" class="d-inline-block"><button class="btn btn-warning mt-4 add-menu-item">Cancel</button></a>
            </div>
        </div>
        <script type="text/javascript">
            $('.colorpicker').colorpicker({});
        </script>
    </div>
@endsection
