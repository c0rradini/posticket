@extends('layouts.master')

@section('title', 'Usuários')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 10px;">

    <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <p style="font-size: 32px;font-weight: bold;">Lista de Usuários</p>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->tecnico == 1)
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" role="button" href="{{ route('cadastrar.user') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cadastrar Novo Usuário&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
    </div>
    @endif

    @include('layouts.mensagem')

    <div class="row">
        <div class="col" style="margin-top: 10px;">

            <div class="d-flex align-items-center mt-3">
                <p style="margin-top: 5px;">Filtrar por:&nbsp;&nbsp;</p>

                <form action=" {{ route('user.index') }} " method="get">
                    <div class="dropdown ">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            &nbsp;&nbsp;
                            @if($listar == 'all')
                            Todos
                            @elseif($listar == '1')
                            Ativos
                            @else
                            Inativos
                            @endif
                            &nbsp;&nbsp;
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" value="all" name="filter" class="dropdown-item">Todos</button></li>
                            <li><button type="submit" value="1" name="filter" class="dropdown-item">Ativos</button></li>
                            <li><button type="submit" value="0" name="filter" class="dropdown-item">Inativos</button></li>
                        </ul>
                    </div>
                </form>
            </div>
            <!-- <p style="margin-bottom: 5px;margin-top: 5px;">Lista de usuários já cadastrados:</p> -->

            <!-- <form action=" {{ route('user.index') }} " method="get">
                <div class="row ">
                    <div class="col">
                        <div class="btn-group">
                            <button type="submit" value="all" name="filter" class=" btn btn-info">Todos</button>

                            <button type="submit" value="1" name="filter" class=" btn btn-info">Tecnicos</button>

                            <button type="submit" value="0" name="filter" class=" btn btn-info">Usuarios</button>
                        </div>
                    </div>
                </div>
            </form> -->

            <!-- <form action=" {{ route('user.index') }} " method="get">
                <div class="mb-4 btn-group">
                    <button type="submit" value="all" name="filter" class="btn btn-primary">Todos</button>

                    <button type="submit" value="1" name="filter" class="btn btn-primary">&nbsp;&nbsp;Ativos&nbsp;&nbsp;</button>

                    <button type="submit" value="0" name="filter" class="btn btn-primary">&nbsp;&nbsp;Inativos&nbsp;</button>


                </div>
            </form> -->
            <div class="table-responsive">

                <table id="tabela" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ramal</th>
                            <th>Setor</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            @if(Auth::check() && Auth::user()->tecnico == 1)
                            <th class="text-end">Ação</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)

                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $user->id }}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente excluir?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <span>ID: {{ $user->id }}</span></br>
                                        <span>Nome: {{ $user->name }}</span>
                                        </br>
                                        <small>Por motivos de segurança, esses dados serão desativados.</small>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <form action="{{ route('desativa.user', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning" type="submit">Desativar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-active-{{ $user->id }}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente reativar?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <span>ID: {{ $user->id }}</span></br>
                                        <span>Nome: {{ $user->name }}</span>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <form action="{{ route('ativa.user', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning" type="submit">Ativar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->ramal }}</td>
                            <td>{{ $user->setor->name }}</td>
                            <td>
                                @if( $user->tecnico === 1)
                                Técnico
                                @else
                                Usuário
                                @endif
                            </td>
                            <td>@if($user->status == 1)
                                Ativo
                                @else
                                Inativo
                                @endif
                            </td>


                            @if(Auth::check() && Auth::user()->tecnico == '1')
                            <td class="text-end">

                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" role="button" href="{{ route('edit.user', $user->id )}} ">Editar</a></li>

                                        @if($user->status == '1')
                                        <li> <a class="dropdown-item" type="button" data-bs-target="#modal-delete-{{ $user->id }}" data-bs-toggle="modal">Excluir</a></li>
                                        @else

                                        <li> <a class="dropdown-item" type="button" data-bs-target="#modal-active-{{ $user->id }}" data-bs-toggle="modal">&nbsp;Ativar&nbsp;</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </td>

                            <!-- @if(Auth::check() && Auth::user()->tecnico == 1)
                            <td class="text-end d-flex justify-content-end ">
                                <a class="btn btn-success m-1" role="button" href="{{ route('edit.user', $user->id) }} ">Editar</a>

                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $user->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente
                                                    excluir?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <span>ID: {{ $user->id }}</span></br>
                                                <span>Nome: {{ $user->name }}</span>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn btn-primary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                                <form action="{{ route('destroy.user', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-danger m-1" type="button" data-bs-target="#modal-delete-{{ $user->id }}" data-bs-toggle="modal">Excluir</a>
                            </td>
                            @endif -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection