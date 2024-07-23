@extends('layouts.app')

@section('content')
    <h1>Edit Data</h1>
    <form action="" method="post">
        @csrf
        <input type="text" name="name" id="name" value="{{ $data['user']['name'] }}">
        <input type="email" name="email" id="email" value="{{ $data['user']['email'] }}">
        <input type="password" name="password" id="password" value="{{ $data['user']['password'] }}">
        <button type="submit">Add</button>
    </form>
@endsection
