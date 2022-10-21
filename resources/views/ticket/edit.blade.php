@extends('layouts.master')

@section('title', 'Ticket - Técnico')

@section('page')

<div class="container" style="margin-top: 15px;margin-bottom: 10px;">
    <div class="row mt-4 mb-2" width="100%">
        <p style="font-size: 32px;font-weight: bold;">#{{ old('id', $ticket->id) }} - {{ old('titulo', $ticket->titulo)}} </p>
    </div>

    @include('layouts.mensagem')

    <form action="{{ route('atualiza.ticket', ['id'=>$ticket->id])}} " method="POST">
        @csrf
        @method('PUT')

        <div class="container row row-cols-2">
            <div class="col-md-6">
                <div class="row row-cols-1">
                    <div class="col d-flex mb-4 align-items-center">
                        <p style="margin-bottom:0px;font-weight: bold;">Requerente:&nbsp;&nbsp;</p>
                        <p style="margin-bottom:0px; color: rgb(117,117,117);">{{ old('name', $ticket->requerente->name) }} [ {{ old('email', $ticket->requerente->email) }} ] </p>
                    </div>

                    <div class="col d-flex align-items-center mb-4">
                        <p style="margin-bottom:0px;font-weight: bold;">Ramal:&nbsp;</p>
                        <input class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px" name="ramal" value="{{ old('ramal', $ticket->ramal)}}"></input>
                    </div>

                    <div class="col d-flex align-items-center mb-4">
                        <p style="margin-bottom:0px;font-weight: bold;">Setor:&nbsp;</p>

                        <select name="setor_id" class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px" required>
                            <option value="{{old('setor_id', $ticket->setor_id)}}">{{ $ticket->setor->name }}</option>

                            @foreach($setoresAtivos as $setor)
                            @if($setor->id != $ticket->setor_id && $setor->status===1)
                            <option value="{{ $setor->id }}" class="text-start">{{$setor->name}}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="col d-flex align-items-center mb-4">
                        <p style="margin-bottom:0px;font-weight: bold;">Máquina:&nbsp;</p>

                        <select name="maquina_id" class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px" required="ON">
                            <option value="{{old('maquina_id', $ticket->maquina_id)}}">{{ $ticket->maquina->name }}</option>

                            @foreach($maquinasAtivas as $maquina)
                            @if($maquina->id != $ticket->maquina_id && $maquina->status===1)
                            <option value="{{ $maquina->id }}" class="text-start">{{$maquina->name}}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col d-flex mb-1">
                    <p style="font-weight: bold;">Data de Abertura:&nbsp;&nbsp;</p>
                    <p style="color: rgb(117,117,117);">{{ old('created_at', $ticket->created_at) }}</p>
                </div>

                <div class="col d-flex align-items-center mb-4">
                    <p style="margin-bottom:0px;font-weight: bold;">Status:&nbsp;</p>

                    <select name="status" class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px" required>

                        <option value="{{old('status', $ticket->status)}}" @selected(old('status'))>
                            @if( $ticket->status === '1')
                            Aberto
                            @elseif ($ticket->status === '2')
                            Em Atendimento
                            @elseif ($ticket->status === '3')
                            Aguardando Terceiros
                            @elseif ($ticket->status === '0')
                            Encerrado
                            @endif
                        </option>

                        @if($ticket->status != '1')
                        <option value="1">Aberto</option>
                        @endif
                        @if($ticket->status != '2')
                        <option value="2">Em Atendimento</option>
                        @endif
                        @if($ticket->status != '3')
                        <option value="3">Aguardando Terceiros</option>
                        @endif
                        @if($ticket->status != '4')
                        <option value="4">Encerrado</option>
                        @endif
                    </select>
                </div>


                <div class="col d-flex align-items-center mb-4">
                    <p style="margin-bottom:0px;font-weight: bold;">Técnico:&nbsp;</p>

                    <select name="responsavel_user_id" class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px">

                        <option value="">Selecione...</option>

                        @foreach($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}" @selected(old('responsavel_user_id', $ticket->responsavel_user_id)==$tecnico->id)>
                            {{ $tecnico->name }} [ {{ $tecnico->email }} ]
                        </option>
                        @endforeach

                    </select>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p style="margin-bottom:7px; font-weight: bold;">Descrição:</p>
                    <textarea class="bg-light border rounded shadow-sm mb-4 p-2" style="width: 100%;min-height: 180px;" disabled="" readonly="">{{ old('demanda', $ticket->demanda)}}</textarea>
                </div>

                <div class="col-md-6">
                    <p style="margin-bottom: 5px;font-weight: bold;">Atividades:</p>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Editor</th>
                                    <th>Data / Hora</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->usuario->name }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->descricao }}</td>
                                    <td> @if( $log->status == '1')
                                        Aberto
                                        @elseif ($log->status == '2')
                                        Em Atendimento
                                        @elseif ($log->status == '3')
                                        Aguardando Terceiros
                                        @elseif ($log->status == '4')
                                        Encerrado
                                        @endif</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="container">
            <div class="col-md-6">

                @if(Auth::check() && Auth::user()->tecnico === 1 || Auth::check() && Auth::id() === $ticket->requerente_user_id)
                <!-- <button class="btn btn-success m-1" type="submit">Salvar</button> -->
                <a class="btn btn-primary m-1" role="button" data-bs-target="#modal-edit-{{ $ticket->id }}" data-bs-toggle="modal">Salvar</a>

                @if ($ticket->status != '4')

                @if(Auth::check() && Auth::user()->tecnico === 1 && $ticket->responsavel_user_id === null)
                <a class="btn btn-success m-1" role="button" href="{{ route('ticket.assumir-ticket', ['id'=>$ticket->id]) }}">Assumir</a>
                @endif

                <a class="btn btn-danger m-1" role="button" data-bs-target="#modal-delete-{{ $ticket->id }}" data-bs-toggle="modal">Encerrar</a>
                @endif
                @endif

                <a class="btn btn-secondary m-1" role="button" href="{{ route('ticket.visualizar', ['id'=>$ticket->id]) }}">Voltar</a>
            </div>
        </div>
    </form>
</div>
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

<div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $ticket->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin-right: 31px;">Colocar alguma observação? </h5>
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

<div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $ticket->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin-right: 31px;">Colocar alguma observação? </h5>
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
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" tabindex="-1" id="modal-edit-{{ $ticket->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin-right: 31px;">Colocar alguma observação? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">
                <span>ID: {{ $ticket->id }}</span></br>
                <span>Nome: {{ $ticket->titulo }}</span>
                </br></br>
                <div class="col">
                    <form action="{{ route('atualiza.ticket', ['id'=>$ticket->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <p style="margin-bottom:0px;">Observações&nbsp;no&nbsp;Log:&nbsp;</p>
                        <textarea class="form-control bg-light border rounded shadow-sm p-2 mb-4" style="width: 100%;min-height: 180px;height:80%;" name="obsLog" placeholder="Insira as observações necessárias" require value="{{ old('obsLog') }}"></textarea>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-secondary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection