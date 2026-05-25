<!DOCTYPE html>
<html>

<head>
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="{{ asset('css/boton.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resultado.css') }}">
</head>

<body>

    @if($filas->isEmpty())
    <span>Sin resultados</span>
    @else

    <table>
        <thead>
            <tr>
                <th colspan="{{ count($columnas) - 1 }}" id="descarga"><a href="{{ route('export.resultados', ['busqueda' => $nombre]) }}">
                        Descargar Excel
                    </a></th>
            </tr>
            <tr>
                <th colspan="{{ count($columnas) - 1 }}" id="cabecera">
                    Resultados de búsqueda para: {{ $nombre }}
                </th>
            </tr>
            <tr>
                @foreach($columnas as $col)
                @if(!$loop->first)
                <th>
                    {{ ucfirst(str_replace('.', ' ', $col)) }}
                </th>
                @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($filas as $fila)
            <tr>
                @foreach($columnas as $col)
                @if(!$loop->first)
                <td>
                    {{ $fila[$col] }}
                </td>
                @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>

</html>