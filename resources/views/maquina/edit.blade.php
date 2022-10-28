@extends('layouts.master')

@section('title', 'Editar Equipamento')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">
        <div class="col-md-12" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">Editar Equipamentos</p>
        </div>
    </div>

    @include('layouts.mensagem')

    <form action="{{route('atualiza.maquina', ['id'=>$maquina->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Editar Equipamento*</p>
                <input class="form-control bg-light border rounded shadow-sm p-2" type="text" id="name" name="name" placeholder="Nome da Maquina" value=" {{old('name', $maquina->name)}}" style="width: 100%;">
                <button class="btn btn-primary m-1 mt-3" type="submit">Editar</button>
                <a class="btn-secondary btn m-1 mt-3" role="button" href="{{ route('maquina.index') }}">Voltar</a>
            </div>

            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Lista de equipamentos já cadastrados:</p>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Maquina::all() as $maquina)
                            <tr>
                                <td>{{$maquina->name}}</td>
                                <td>@if($maquina->status === 1)
                                    Ativo
                                    @else
                                    Inativo
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection