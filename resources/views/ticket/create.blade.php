@extends('layouts.master')

@section('title', 'Novo Ticket')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">

        <div class="col-md-12" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">Abrir novo Ticket</p>
        </div>

    </div>

    @include('layouts.mensagem')

    <form action="{{ route('register_ticket') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Titulo</p>
                <input required class="form-control bg-light border rounded shadow-sm p-2" type="text" style="width: 100%;" name="titulo" placeholder="Exemplo: Teclado não funciona">
            </div>
            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Requerente</p>
                @if(Auth::check() && Auth::user()->tecnico == '1')
                <select name="requerente_user_id" class="form-control bg-light border rounded shadow-sm p-2" style="margin-bottom:0px">

                    @foreach($tecnicos as $user)
                    <option value="{{ $user->id }}" @selected(old($user->id))>
                        {{ $user->name }} [ {{ $user->email }} ]
                    </option>
                    @endforeach

                </select>

                @else
                <input disabled class="form-control bg-light border rounded shadow-sm p-2" type="text" style="width: 100%; " name="requerente_user_id" placeholder=" {{ Auth::user()->name }} [ {{  Auth::user()->email }} ] ">
                @endif
            </div>
        </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p style="margin-bottom: 5px;margin-top: 5px;">Descrição</p>
            <textarea class="form-control bg-light border rounded shadow-sm p-2 mb-4" style="width: 100%;min-height: 180px;height:80%;" name="demanda" placeholder="Detalhe ao máximo seu problema."></textarea>
        </div>
        <div class="col-md-6">
            <p style="margin-bottom: 5px;margin-top: 5px;">Ramal</p>
            <input class="form-control bg-light border rounded shadow-sm p-2 mb-4" name="ramal" value="{{ Auth::user()->ramal }}" type="text" style="width: 100%;margin-bottom: 15px;">

            <p style="margin-bottom: 5px;margin-top: 5px;">Setor
                <select required name="setor_id" class="form-control bg-light border rounded shadow-sm p-2 mb-4" style="width: 100%;">
                    <option value="{{ Auth::user()->setores_id }}" selected="">{{ Auth::user()->setor->name}}</option>
                    @foreach($setoresAtivos as $setor)
                    <option value="{{ $setor->id }}" class="text-start">{{$setor->name}}</option>
                    @endforeach
                </select>
            </p>
            <p style="margin-bottom: 5px;margin-top: 5px;">Equipamento
                <select required class="form-control bg-light border rounded shadow-sm p-2 mb-4" name="maquina_id" style="width: 100%;">
                    <option value="">Selecione...</option>
                    
                    @foreach($maquinasAtivas as $maquina)
                    <option value="{{ $maquina->id }}" class="text-start">
                        {{$maquina->name}}
                    </option>
                    @endforeach
                 
                </select>
            </p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <button class="btn m-1 mt-3" type="submit" style="background: #097ec1;color: rgb(255,255,255);">Concluir</button>
            <a class="btn m-1 mt-3" role="button" href="{{ route('ticket.index') }}" style="background: #b1b1b1;color: rgb(255,255,255);;">Voltar</a>
        </div>
    </div>
</div>
@endsection