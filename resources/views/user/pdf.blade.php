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
            <th>ID</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Ramal</th>
            <th>Setor</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Criada:</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ramal }}</td>
            <td>{{ $user->setor->name }}</td>
            <td>@if( $user->tecnico == '1')
                Técnico
                @else
                Usuário
                @endif</td>
            <td>@if( $user->status == '1')
                Ativo
                @else
                Inativo
                @endif</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>