@extends('layouts.master')

@section('title', 'Novo Ticket')

@section('page')

@include('layouts.mensagem')

<div class="container" style="margin-top: 15px;margin-bottom: 15px;">
    <div class="row">
        <div class="col-md-6" style="margin-top: 15px;">
            <p style="margin-bottom: 5px;font-size: 32px;font-weight: bold;">#{{ old('id', $ticket->id) }} - {{ old('titulo', $ticket->titulo)}} </p>
            <div>
                <div class="row row-cols-1">
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Status:&nbsp;&nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">Pendente</p>
                    </div>
                    
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Requerente:&nbsp; &nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">{{ old('name', $ticket->requerente->email)}}</p>
                    </div>
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Ramal:&nbsp;&nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">{{ old('ramal', $ticket->ramal)}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 15px;padding-top: 54px;">
            <div>
                <div class="row row-cols-1">
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Solicitante:&nbsp;&nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">jose@posticket.com</p>
                    </div>
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Ramal:&nbsp;&nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">3060</p>
                    </div>
                    <div class="col d-flex">
                        <p style="margin-bottom: 5px;font-weight: bold;">Setor:&nbsp;&nbsp;</p>
                        <p style="margin-bottom: 5px;color: rgb(117,117,117);">Contabilidade</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p style="margin-bottom: 5px;font-weight: bold;">Descrição:</p><textarea class="bg-light border rounded shadow-sm" style="width: 100%;min-height: 180px;" disabled="" readonly="" placeholder="Ao iniciar o Windows, aprenseta uma tela azul, possívelmente algum arquivo de inicialização corrompeu, precisa ser formatado.  Não precisa de backup. "></textarea>
        </div>
        <div class="col-md-6">
            <p style="margin-bottom: 5px;font-weight: bold;">Atividades:</p>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Editor</th>
                            <th>Data / Hora</th>
                            <th>Descrição</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gabriel</td>
                            <td>06/06 - 10:12</td>
                            <td>Recebido</td>
                            <td>Andamento</td>
                        </tr>
                        <tr>
                            <td>Jose</td>
                            <td>06/06 - 09:44</td>
                            <td>Abertura</td>
                            <td>Aberto</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection