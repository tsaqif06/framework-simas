@extends('layouts.app')

@section('content')
    <h1>Tambah Data</h1>
    <form action="" method="post">
        @csrf
        <input type="text" name="name" id="name" {{ oldValue('name') }}>
        {{ errorValidate('name') }}>
        <input type="email" name="email" id="email" {{ oldValue('email') }}>
        {{ errorValidate('email') }}>
        <input type="password" name="password" id="password" {{ oldValue('password') }}>
        {{ errorValidate('password') }}>
        <button type="submit">Add</button>
    </form>
@endsection
