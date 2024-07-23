@extends('layouts.app')

@section('content')
    <h1>Edit Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" value="{{ $product['name'] }}">
        <img class="img-preview" src="{{ BASEURL }}/assets/img/uploads/{{ $product['photo'] }}"
            alt="{{ $product['photo'] }}" width="200" style="display: block">
        <input type="file" name="photo" id="photo" accept="image/*" onchange="showPreview('photo')">
        <button type="submit">Update</button>
    </form>
@endsection
