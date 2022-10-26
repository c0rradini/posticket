@extends('layouts.master')

@section('title', 'Relatórios')

@section('page')


<div class="container" style="margin-top: 15px;margin-bottom: 10px;">

    <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <p style="font-size: 32px;font-weight: bold;">Gerar Relatórios</p>
        </div>
    </div>

    @include('layouts.mensagem')



    <div class="row align-items-center mt-4 " style="background:rgba(196,222,243,0.20);">
        <div class="col-2 d-flex align-items-end" style="margin-bottom: 0px;">
            <h4 style="margin-bottom: 0px; height:100%; text-align:end;">Tickets</h4>
        </div>
        <div class="col d-flex">
            <p class="d-flex align-items-center" style="margin-bottom:0px;">Status: </p>
            <select id="ticketStatus" name="ticketStatus" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                <option value="all">Todos</option>
                <option value="1">Aberto</option>
                <option value="2">Em Andamento</option>
                <option value="3">Aguardando Terceiros</option>
                <option value="4">Encerrado</option>
            </select>

            <p class="d-flex align-items-center " style="margin-bottom:0px;">Máquina: </p>
            <select id="maquinaStatus" name="maquinaStatus" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                <option value="all">Todos</option>
                @foreach(App\Models\Maquina::all() as $maquina)
                <option value="{{ $maquina->id }}" class="text-start">{{$maquina->name}}</option>
                @endforeach
            </select>

            <p class="d-flex align-items-center" style="margin-bottom:0px;">Setor: </p>
            <select id="setorStatus" name="setorStatus" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                <option value="all">Todos</option>
                @foreach(App\Models\Setor::all() as $setor)
                <option value="{{ $setor->id }}" class="text-start">{{$setor->name}}</option>
                @endforeach

            </select>
        </div>

    </div>

    <div class="row align-items-center " style="background:rgba(196,222,243,0.20);">
        <div class="col-2 d-flex align-items-end" style="margin-bottom: 0px;">
        </div>
        <div class="col d-flex">
            <p class="d-flex align-items-center" style="margin-bottom:0px;">Requerente: </p>
            <select id="ticketStatus" name="ticketStatus" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                <option value="all">Todos</option>
                @foreach(App\Models\User::all() as $user)
                <option value="{{ $user->id }}" class="text-start">{{ $user->name }} [ {{ $user->email }} ]</option>
                @endforeach
            </select>

            <p class="d-flex align-items-center " style="margin-bottom:0px;">Responsável: </p>
            <select id="maquinaStatus" name="maquinaStatus" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                <option value="all">Todos</option>
                @foreach(App\Models\User::all() as $user)
                <option value="{{ $user->id }}" class="text-start">{{ $user->name }} [ {{ $user->email }} ] </option>
                @endforeach
            </select>

            <button class="btn btn-primary m-2 " role="button">Gerar</button>
        </div>

    </div>



</div>







@endsection