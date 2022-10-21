@extends('layouts.master')

@section('title', 'Editar Setor')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">
        <div class="col-md-12" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">Cadastro de Setor</p>
        </div>
    </div>

    @include('layouts.mensagem')


    <div class="row">
        <div class="col-md-6" style="margin-top: 15px;">
            <form action="{{ route('atualiza.setor', ['id'=>$setor->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <p style="margin-bottom: 5px;margin-top: 5px;">Editar Setor*</p>
                <input class="form-control bg-light border rounded shadow-sm p-2 mb-4" type="text" id="name" name="name" value=" {{old('name', $setor->name)}} " style="width: 100%;">

                <button class="btn btn-primary m-1 mt-3" type="submit">Editar</button>
                <a class="btn-secondary btn m-1 mt-3" role="button" href="{{ route('setor.index') }}">Voltar</a>
            </form>
        </div>

        <div class="col-md-6" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;margin-top: 5px;">Lista de setores já cadastrados:</p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Models\Setor::all() as $setor)
                        <tr>
                            <td>{{$setor->name}}</td>
                            <td>@if($setor->status === 1)
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
</div>
@endsection