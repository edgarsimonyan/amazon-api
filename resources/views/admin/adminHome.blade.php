@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>menu list</h2>
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <select class="form-select" aria-label="Default select example">
            <option selected>Open this menu list</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <button class="btn btn-primary mt-4 add-menu-item">Add</button>
    </div>
    <script>
        $('.add-menu-item').click(function () {
            alert();
        })
    </script>
@endsection
