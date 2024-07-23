@extends('layouts.app')

@section('content')
    <h1>Halo</h1>
    {!! flasher() !!}

    <a href="{{ BASEURL }}/product/create">Tambah</a>
    <table>
        @php $i = 1; @endphp
        @foreach ($products as $product)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $product['name'] }}</td>
                <td><img src="{{ BASEURL }}/assets/img/uploads/{{ $product['photo'] }}" alt="{{ $product['photo'] }}"
                        width="300"></td>
                @if (auth()->role === 'admin')
                    <td><a href="{{ BASEURL }}/product/edit/{{ $product['id'] }}">EDIT</a></td>
                    <td><a href="{{ BASEURL }}/product/delete/{{ $product['id'] }}"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a></td>
                @endif
            </tr>
            @php $i++; @endphp
        @endforeach
    </table>
@endsection
