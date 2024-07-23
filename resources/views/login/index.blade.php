@extends('layouts.app')

@section('content')
    {!! flasher() !!}
    <form action="" method="POST">
        @csrf
        <input type="email" name="email" id="email" placeholder="email" {{ oldValue('email') }}><br>
        {{ errorValidate('email') }}
        <input type="password" name="password" id="password" placeholder="password" {{ oldValue('password') }}><br>
        {{ errorValidate('password') }}
        <button type="submit">Login</button>
    </form>
@endsection
