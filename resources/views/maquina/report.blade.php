@extends('layouts.master')

@section('title', 'Relatórios')

@section('page')

<div class="container" style="margin-top: 15px;margin-bottom: 10px;">

    <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <p style="font-size: 32px;font-weight: bold;">Relatórios de Máquinas</p>
        </div>
    </div>

    @include('layouts.mensagem')

    <div class="row align-items-center ">
        <div class="col d-flex align-items-end" style="margin-bottom: 0px;">
            <h4 style="margin-bottom: 0px; height:100%; text-align:end;">Máquinas</h4>
        </div>

        <div class="col d-flex">
            <p class="d-flex align-items-center" style="margin-bottom:0px;">Status: </p>
            <form class="col d-flex" action="{{ route('gerarPDF.maquina'); }}" style="margin-bottom:0px;margin-top:0px;">
                <select id="filter" name="filter" class="m-2 form-control bg-light border rounded shadow-sm p-2">
                    <option value="all">Todos</option>
                    <option value="1">Ativos</option>
                    <option value="0">Inativos</option>
                </select>
                <button class="btn btn-primary m-2" type="submit">Gerar</a>
            </form>
        </div>
    </div>
</div>
@endsection