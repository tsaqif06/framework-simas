@extends('layouts.app')

@section('content')
    <h1>Tambah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="{{ isInvalid('name') }}" name="name" id="name" {{ oldValue('name') }}>
        {{ errorValidate('name') }}
        <img class="img-preview" width="200" style="display: none;">
        <input type="file" class="{{ isInvalid('photo') }}" name="photo" id="photo" accept="image/*"
            onchange="showPreview('photo')">
        {{ errorValidate('photo') }}
        <button type="submit">Store</button>
    </form>
@endsection
