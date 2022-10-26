@extends('layouts.master')

@section('title', 'Relatórios')

@section('page')

<div class="container" style="margin-top: 15px;margin-bottom: 10px;">

    <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <p style="font-size: 32px;font-weight: bold;">Relatórios de Usuário</p>
        </div>
    </div>

    @include('layouts.mensagem')

    <div class="row align-items-center mt-4">
        <div class="col-2 d-flex align-items-end" style="margin-bottom: 0px;">
            <h4 style="margin-bottom: 0px; height:100%; text-align:end;">Usuários</h4>
        </div>


        <div class="col d-flex">
            <p class="d-flex align-items-center" style="margin-bottom:0px; margin-left:15px;">Status: </p>
            <form class="col d-flex" action="{{ route('gerarPDF.user'); }}" style="margin-bottom:0px;margin-top:0px;">
                <select id="status" name="status" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                    <option value="">Todos</option>
                    <option value="1">Ativos</option>
                    <option value="0">Inativos</option>
                </select>

                <p class="d-flex align-items-center " style="margin-bottom:0px;margin-left:15px;">Tipo: </p>
                <select id="tecnico" name="tecnico" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                    <option value="">Todos</option>
                    <option value="1">Técnicos</option>
                    <option value="0">Usuários</option>
                </select>

                <p class="d-flex align-items-center" style="margin-bottom:0px;margin-left:15px;">Setor: </p>
                <select id="setores" name="setores" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                    <option value="">Todos</option>
                    @foreach(App\Models\Setor::all() as $setor)
                    <option value="{{ $setor->id }}" class="text-start">{{$setor->name}}</option>
                    @endforeach

                </select>
                <button class="btn btn-primary m-2 " role="button">Gerar</button>
            </form>
        </div>
    </div>
</div>
@endsection