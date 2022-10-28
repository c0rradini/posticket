@extends('layouts.master')

@section('title', 'Equipamentos')

@section('page')
<div class="container" style="margin-top: 15px;margin-bottom: 10px;">

    <div class="row">
        <div class="mb-2col-md-12" style="margin-top: 10px;">
            <p style="font-size: 32px;font-weight: bold;">Lista de Equipamentos</p>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->tecnico == 1)
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" role="button" href="{{ route('cadastrar.maquina') }}">&nbsp;&nbsp;&nbsp;Cadastrar Novo Equipamento&nbsp;&nbsp;&nbsp;</a>
        </div>
    </div>
    @endif

    @include('layouts.mensagem')

    <div class="row">
        <div class="col" style="margin-top: 10px;">
            <div class="d-flex align-items-center mt-3">
                <p style="margin-top: 5px;">Filtrar por:&nbsp;&nbsp;</p>

                <form action=" {{ route('maquina.index') }} " method="get">
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
            <!-- <p class="mb-2" style="margin-top: 5px;">Lista de maquinas já cadastrados:</p>

            <form action=" {{ route('maquina.index') }} " method="get">
                <div class="mb-3 btn-group">
                    <button type="submit" value="all" name="filterUser" class="btn btn-primary">Todos</button>

                    <button type="submit" value="1" name="filterUser" class="btn-primary btn">Ativos</button>

                    <button type="submit" value="0" name="filterUser" class="btn-primary btn">Inativos</button>
                </div>
            </form> -->

            <div class="table-responsive">
                <table id="tabela" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Status</th>
                            @if(Auth::check() && Auth::user()->tecnico === 1)
                            <th class="text-end"> </th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($maquinas as $maquina)
                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-delete-{{ $maquina->id }}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente excluir?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <span>ID: {{ $maquina->id }}</span></br>
                                        <span>Nome: {{ $maquina->name }}</span>
                                        </br>
                                        <small>Por motivos de segurança, esses dados serão desativados.</small>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <form action="{{ route('desativa.maquina', $maquina->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning" type="submit">Desativar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-active-{{ $maquina->id }}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="margin-right: 31px;">Deseja realmente reativar?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <span>ID: {{ $maquina->id }}</span></br>
                                        <span>Nome: {{ $maquina->name }}</span>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary text-light" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <form action="{{ route('ativa.maquina', $maquina->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning" type="submit">Ativar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td>{{$maquina->id}}</td>
                            <td>{{$maquina->name}}</td>

                            <td>@if($maquina->status === 1)
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
                                        <li><a class="dropdown-item" role="button" href="{{ route('edit.maquina', $maquina->id )}} ">Editar</a></li>

                                        @if($maquina->status == '1')
                                        <li><a class="dropdown-item" type="button" data-bs-target="#modal-delete-{{ $maquina->id }}" data-bs-toggle="modal">Excluir</a></li>
                                        @else

                                        <li><a class="dropdown-item" type="button" data-bs-target="#modal-active-{{ $maquina->id }}" data-bs-toggle="modal">&nbsp;Ativar&nbsp;</a></li>
                                        @endif
                                    </ul>
                                </div>
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

<script>
    $('.dropdown-toggle').dropdown();
</script>