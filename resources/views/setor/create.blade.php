@extends('layouts.master')

@section('title', 'Cadastrar Setor')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">
        <div class="col-md-12" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">Cadastro de Setor</p>
        </div>
    </div>

    @include('layouts.mensagem')


    <form action="{{ route('register_setor') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Nome do setor*</p>
                <input required class="form-control bg-light border rounded shadow-sm p-2 mb-4" type="text" name="name" placeholder="Nome do Setor" value="{{old('name')}}" style="width: 100%;">
                <button class="btn btn-primary m-1 mt-3" type="submit">Concluir</button>
                <a class="btn-secondary btn m-1 mt-3" role="button" href="{{ route('setor.index') }}">Voltar</a>
            </div>

            <div class="col-md-6" style="margin-top: 15px;">
                <p style="margin-bottom: 2px;margin-top: 5px;">Lista de setores já cadastrados:</p>
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
    </form>
</div>
@endsection