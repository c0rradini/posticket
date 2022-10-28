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

            <div class="d-flex align-items-center mt-3">
                <p style="margin-top: 5px;">Filtrar por:&nbsp;&nbsp;</p>

                <form action=" {{ route('ticket.index') }} " method="get">
                    <div class="dropdown ">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            &nbsp;&nbsp;
                            @if($listar == 'all')
                            Todos
                            @elseif($listar == '1')
                            Abertos
                            @elseif($listar == '2')
                            Em Andamento
                            @elseif($listar == '3')
                            Aguardando Terceiros
                            @else
                            Encerrados
                            @endif
                            &nbsp;&nbsp;
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" value="all" name="filter" class="dropdown-item">Todos</button></li>
                            <li><button type="submit" value="1" name="filter" class="dropdown-item">Abertos</button></li>
                            <li><button type="submit" value="2" name="filter" class="dropdown-item">Em Andamento</button></li>
                            <li><button type="submit" value="3" name="filter" class="dropdown-item">Aguardando Terceiros</button></li>
                            <li><button type="submit" value="4" name="filter" class="dropdown-item">Encerrados</button></li>
                        </ul>
                    </div>
                </form>
            </div>

            <!-- <form action=" {{ route('ticket.index') }} " method="get">
                    <div class="mb-4 btn-group">
                        <button type="submit" value="all" name="filter" class="btn btn-secondary">Todos</button>
                        <button type="submit" value="1" name="filter" style="color:white;" class="btn-primary btn">Abertos</button>
                        <button type="submit" value="2" name="filter" class="btn btn-success">Em Andamento</button>
                        <button type="submit" value="3" name="filter" style="color:white;" class=" btn btn-warning ">Aguardando Terceiros</button>
                        <button type="submit" value="4" name="filter" class=" btn btn-danger">Encerrados</button>
                    </div>
                </form> -->

            <div class="table-responsive">
                <table id="tabela" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>Código</th>
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

                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $ticket->id }}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente encerrar?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body text-start">
                                        <span>ID: {{ $ticket->id }}</span></br>
                                        <span>Nome: {{ $ticket->titulo }}</span>
                                        </br></br>
                                        <div class="col">
                                            <form action="{{ route('ticket.encerrar-ticket', ['id'=>$ticket->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <p style="margin-bottom:0px;">Observações&nbsp;no&nbsp;Log:&nbsp;</p>
                                                <textarea class="form-control bg-light border rounded shadow-sm p-2 mb-4" style="width: 100%;min-height: 180px;height:80%;" name="obsLog" placeholder="Motivo de encerramento" require value="{{ old('obsLog') }}"></textarea>

                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-secondary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <button class="btn btn-danger" type="submit">Encerrar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Ações
                                        </button>
                                    <ul class="dropdown-menu">

                                        @if(Auth::check() && Auth::user()->tecnico === 1 && $ticket->responsavel_user_id === null && $ticket->status != '4')
                                        <li><a class="dropdown-item" role="button" href=" {{ route('ticket.assumir-ticket', ['id'=>$ticket->id]) }} ">Assumir</a></li>
                                        @endif
                                        <li><a href="{{ route('ticket.visualizar', ['id'=>$ticket->id]) }} " class="dropdown-item">Visualizar</a></li>
                                        @if ($ticket->status != '4')
                                        <li> <a class="dropdown-item" role="button" data-bs-target="#modal-delete-{{ $ticket->id }}" data-bs-toggle="modal">Encerrar</a></li>
                                        <!-- <li><a class="dropdown-item" role="button" href="{{ route('ticket.encerrar-ticket', ['id'=>$ticket->id]) }}" style="color: black;">Encerrar</a></li> -->
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection