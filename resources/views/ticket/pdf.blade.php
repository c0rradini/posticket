<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div>

        <h2>Posticket</h2>
        <h5>{{ $title }}</h5>

    </div>

    <p>Relatório gerado em: {{ $date }}</p>

    <table class="table table-bordered">
        <tr>
            <th>Código</th>
            <th>Requerente</th>
            <th>Setor</th>
            <th>Máquina</th>
            <th>Data de Abertura</th>
            <th>Ramal</th>
            <th>Status</th>
            <th>Responsavel</th>
        </tr>

        @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->requerente->email }}</td>
            <td>{{ $ticket->setor->name }}</td>
            <td>{{ $ticket->maquina->name }}</td>
            <td>{{ $ticket->created_at }}</td>
            <td>{{ $ticket->ramal }}</td>
            <td>@if( $ticket->status == '1')
                Ativo
                @else
                Inativo
                @endif</td>
            <td>{{ $ticket->responsavel->email }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>