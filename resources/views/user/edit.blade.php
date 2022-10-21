@extends('layouts.master')

@section('title', 'Editar Usuário')

@section('page')

<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">
        <div class="col-md-12" style="margin-top: 15px;">
            <p style="font-size: 32px;font-weight: bold;">Editar Usuário</p>
        </div>
    </div>

    @include('layouts.mensagem')

    <form action="{{ route('atualiza.user', ['id'=>$user->id])}} " method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6" style="margin-top: 10px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Nome</p>
                <input required class="form-control bg-light border rounded shadow-sm p-2 mb-4" value=" {{old('name', $user->name)}}" type=" text" id="name" name="name" style="width: 100%;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Email</p>
                <input required class="form-control bg-light border rounded shadow-sm p-2 mb-4" value=" {{old('email', $user->email)}}" type="email" id="email" name="email" style="width: 100%;" placeholder="example@posticket.com">
                <p style="margin-bottom: 5px;margin-top: 5px;">Senha</p>
                <input class="bg-light border rounded shadow-sm p-2 mb-4" type="password" id="password" name="password" style="width: 100%;" placeholder="••••••••••">
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Ramal</p>
                <input required class="form-control bg-light border rounded shadow-sm p-2 mb-4 w-5" value=" {{old('ramal', $user->ramal)}} " type="text" id="ramal" name="ramal" style="width: 100%;">
                <p style="margin-bottom: 5px;margin-top: 5px;">Setor</p>
                <select name="setores_id" class="form-control bg-light border rounded shadow-sm p-2 mb-4" required="ON">
                    <option value="{{old('setor_id', $user->setores_id)}}">{{$user->setor->name}}</option>
                    @foreach(App\Models\Setor::where('status', '<>', '0')->get() as $setor)
                    <option value="{{ $setor->id }}" class="text-start">{{$setor->name}}</option>
                    @endforeach
                </select>
                <p style="margin-bottom: 5px;margin-top: 5px;">Tipo</p>

                <select required class="form-control bg-light border rounded shadow-sm p-2 mb-4" value=" {{old('tecnico', $user->tecnico)}} " id="tecnico" name="tecnico" style="width: 100%;">
                    <option value="{{old('tecnico', $user->tecnico)}}" selected>
                        @if( $user->tecnico === 1)
                        Técnico
                        @else
                        Usuário
                        @endif</option>
                    <option value="1">Técnico</option>
                    <option value="0">Usuário</option>
                </select>
            </div>
        </div>

        <div class="container" style="margin-top:10px">
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary m-1 mt-3" type="submit" href="{{ route('user.index') }}">Concluir</button>
                    <a class="btn-secondary btn m-1 mt-3" role="button" href="{{ route('user.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="col mt-5">
        <p style="margin-bottom: 2px;margin-top: 5px;">Lista de usuários já cadastrados:</p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\User::all() as $user)
                    <tr>
                        <td>{{$user->name}} [ {{$user->email}} ]</td>
                        <td> @if( $user->tecnico === 1)
                            Técnico
                            @else
                            Usuário
                            @endif
                        </td>
                        <td>@if($user->status === 1)
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
@endsection