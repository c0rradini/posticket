@extends('layouts.master')

@section('title', 'Home - Posticket')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 10px;">
    <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">Lista de Tickets</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" role="button" href="{{ route('cadastrar.ticket') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cadastrar Novo Ticket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
    </div>

    @include('layouts.mensagem')

    <div class="row">
        <div class="col" style="margin-top: 10px;">
            <p style="margin-bottom: 5px;margin-top: 5px;">Listar:</p>

            <form action=" {{ route('ticket.index') }} " method="get">
                <div class="mb-4 btn-group">
                    <button type="submit" value="all" name="filter" class="btn btn-secondary">Todos</button>
                    <button type="submit" value="1" name="filter" style="color:white;" class="btn-primary btn">Abertos</button>
                    <button type="submit" value="2" name="filter" class="btn btn-success">Em Andamento</button>
                    <button type="submit" value="3" name="filter" style="color:white;" class=" btn btn-warning ">Aguardando Terceiros</button>
                    <button type="submit" value="4" name="filter" class=" btn btn-danger">Encerrados</button>
                </div>
            </form>

            <div class="table-responsive">
                <table id="tabela" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            @if (Auth::check() && Auth::user()->tecnico === 1)
                            <th>Requerente</th>
                            @endif
                            <th>Setor</th>
                            <th>Máquina</th>
                            <th>Tec. Responsável</th>
                            <th>Status</th>
                            <th>Data de Abertura</th>

                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ticket as $ticket)
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->titulo}}</td>
                            @if (Auth::check() && Auth::user()->tecnico === 1)
                            <td>{{$ticket->requerente->name}}</td>
                            @endif
                            <td>{{$ticket->setor->name}}</td>
                            <td>{{$ticket->maquina->name}}</td>
                            <td>
                            @if ($ticket->responsavel == null && $ticket->status == '4')
                            Encerrado pelo requerente
                            @elseif ($ticket->responsavel == null)    
                            Aguardando...
                            @else                            
                            {{ old('name', $ticket->responsavel->name) }}
                            @endif
                            </td>
                            <td> @if($ticket->status == '1')
                                Aberto
                                @endif
                                @if($ticket->status == '2')
                                Em Atendimento
                                @endif
                                @if($ticket->status == '3')
                                Aguardando Terceiros
                                @endif
                                @if($ticket->status == '4')
                                Encerrado
                                @endif
                            </td>
                            <td>{{$ticket->created_at}}</td>
                            <td class="text-end">
                                @if(Auth::check() && Auth::user()->tecnico === 1 && $ticket->responsavel_user_id === null && $ticket->status != '4')
                                <a class="btn btn-success m-1 btn-sm" role="button" href=" {{ route('ticket.assumir-ticket', ['id'=>$ticket->id]) }} ">Assumir</a>
                                @endif
                                <a href="{{ route('ticket.visualizar', ['id'=>$ticket->id]) }} " class="btn btn-warning m-1 btn-sm">Visualizar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabela').DataTable({
            "responsive": true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });
    });
</script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            $("#fadeOut").fadeOut().transition - duration('1000');
        }, 2000);
    }, true);
</script>

@endpush