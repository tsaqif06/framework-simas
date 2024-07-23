@extends('layouts.app')

@section('content')
    <form action="" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="name" {{ oldValue('name') }}><br>
        {{ errorValidate('name') }}
        <input type="email" name="email" id="email" placeholder="email" {{ oldValue('email') }}><br>
        {{ errorValidate('email') }}
        <input type="password" name="password" id="password" placeholder="password" {{ oldValue('password') }}><br>
        {{ errorValidate('password') }}
        <button type="submit">Register</button>
    </form>
@endsection
