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
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Criada em</th>
        </tr>

        @foreach($setores as $setor)
        <tr>
            <td>{{ $setor->id }}</td>
            <td>{{ $setor->name }}</td>
            <td>@if( $setor->status == '1')
                Ativo
                @else
                Inativo
                @endif</td>
            <td>{{ $setor->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>