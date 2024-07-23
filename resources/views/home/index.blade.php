@extends('layouts.app')

@section('content')
    <h1>{{ lang('welcome') }}</h1>
    <h1>{{ lang('greeting', ['name' => auth()->name]) }}</h1>
    {!! flasher() !!}

    @if (auth()->role === 'admin')
        <a href="{{ BASEURL }}/user/create">{{ lang('add') }}</a>
    @endif

    <table>
        @php $i = 1; @endphp
        @foreach ($users as $user)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['password'] }}</td>
                @if (auth()->role === 'admin')
                    <td><a href="{{ BASEURL }}/user/edit/{{ $user['id'] }}">EDIT</a></td>
                    <td>
                        <a href="{{ BASEURL }}/user/delete/{{ $user['id'] }}"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a>
                    </td>
                @endif
            </tr>
            @php $i++; @endphp
        @endforeach
    </table>
@endsection
