<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div>

        <h2> Posticket</h2>
        <h5>{{ $title }}</h5>

    </div>

    <p>Gerado em: {{ $date }}</p>

    <table class="table table-bordered">
        <tr>
            <th>Código</th>
            <th>Name</th>
            <th>Status</th>
            <th>Criada em</th>
        </tr>

        @foreach($maquinas as $maquina)
        <tr>
            <td>{{ $maquina->id }}</td>
            <td>{{ $maquina->name }}</td>
            <td>@if( $maquina->status == '1')
                Ativo
                @else
                Inativo
                @endif</td>
            <td>{{ $maquina->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>