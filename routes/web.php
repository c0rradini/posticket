<?php

use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TicketController;
use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tickets');
Route::redirect('/ticket.index', '/tickets');

Route::get('/login', [LoginController::class, 'login'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');


Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

    Route::get('/setor/cadastrar', [SetorController::class, 'create'])->name('cadastrar.setor')->middleware('isTec');
    Route::post('/setor/cadastrar', [SetorController::class, 'store'])->name('register_setor')->middleware('isTec');
    Route::get('/setor/show/{id}', [SetorController::class, 'show'])->middleware('isTec');
    Route::get('/setores', [SetorController::class, 'index'])->name('setor.index');
    Route::get('/setor/editar/{id}', [SetorController::class, 'edit'])->name('edit.setor')->middleware('isTec');
    Route::put('/setor/update/{id}', [SetorController::class, 'update'])->name('atualiza.setor')->middleware('isTec');;
    Route::get('/setor/delete/{id}', [SetorController::class, 'delete'])->middleware('isTec');
    Route::delete('/setor/delete/{id}', [SetorController::class, 'destroy'])->name('destroy.setor')->middleware('isTec');
    Route::put('/setor/desativa/{id}', [SetorController::class, 'disable'])->name('desativa.setor')->middleware('isTec');
    Route::put('/setor/ativa/{id}', [SetorController::class, 'active'])->name('ativa.setor')->middleware('isTec');
    Route::get('/setor/relatorio', [SetorController::class, 'report'])->name('report.setor');
    Route::get('/setor/gerarPDF', [SetorController::class, 'gerarPDF'])->name('gerarPDF.setor');

    Route::get('/usuario/cadastrar', [UserController::class, 'create'])->name('cadastrar.user')->middleware('isTec');
    Route::post('/usuario/cadastrar', [UserController::class, 'store'])->name('register_user')->middleware('isTec');
    Route::get('/usuario/show/{id}', [UserController::class, 'show']);
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuario/editar/{id}', [UserController::class, 'edit'])->name('edit.user')->middleware('isTec');
    Route::put('/usuario/update/{id}', [UserController::class, 'update'])->name('atualiza.user')->middleware('isTec');
    Route::get('/usuario/delete/{id}', [UserController::class, 'delete'])->middleware('isTec');
    Route::delete('/usuario/delete/{id}', [UserController::class, 'destroy'])->name('destroy.user')->middleware('isTec');
    Route::put('/usuario/desativa/{id}', [UserController::class, 'disable'])->name('desativa.user')->middleware('isTec');
    Route::put('/usuario/ativa/{id}', [UserController::class, 'active'])->name('ativa.user')->middleware('isTec');
    Route::get('/usuario/relatorio', [UserController::class, 'report'])->name('report.user');
    Route::get('/usuario/gerarPDF', [UserController::class, 'gerarPDF'])->name('gerarPDF.user');

    Route::get('/maquina/cadastrar', [MaquinaController::class, 'create'])->name('cadastrar.maquina')->middleware('isTec');
    Route::post('/maquina/cadastrar', [MaquinaController::class, 'store'])->name('register_maquina')->middleware('isTec');
    Route::get('/maquina/show/{id}', [MaquinaController::class, 'show'])->middleware('isTec');
    Route::get('/maquinas', [MaquinaController::class, 'index'])->name('maquina.index');
    Route::get('/maquina/editar/{id}', [MaquinaController::class, 'edit'])->name('edit.maquina')->middleware('isTec');
    Route::put('/maquina/update/{id}', [MaquinaController::class, 'update'])->name('atualiza.maquina')->middleware('isTec');
    Route::get('/maquina/delete/{id}', [MaquinaController::class, 'delete'])->middleware('isTec');
    Route::delete('/maquina/delete/{id}', [MaquinaController::class, 'destroy'])->name('destroy.maquina')->middleware('isTec');
    Route::put('/maquina/desativa/{id}', [MaquinaController::class, 'disable'])->name('desativa.maquina')->middleware('isTec');
    Route::put('/maquina/ativa/{id}', [MaquinaController::class, 'active'])->name('ativa.maquina')->middleware('isTec');
    Route::get('/maquina/relatorio', [MaquinaController::class, 'report'])->name('report.maquina');
    Route::get('/maquina/gerarPDF', [MaquinaController::class, 'gerarPDF'])->name('gerarPDF.maquina');

    Route::get('/home', [TicketController::class, 'index'])->name('ticket.index');

    Route::get('/ticket/cadastrar', [TicketController::class, 'create'])->name('cadastrar.ticket');
    Route::post('/ticket/cadastrar', [TicketController::class, 'store'])->name('register_ticket');
    Route::get('/ticket/show/{id}', [TicketController::class, 'show']);
    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/editar/{id}', [TicketController::class, 'edit'])->name('edit.ticket');
    Route::get('/ticket/visualizar/{id}', [TicketController::class, 'show'])->name('ticket.visualizar-user');
    Route::get('/ticket/visualizar/{id}', [TicketController::class, 'show'])->name('ticket.visualizar');
    Route::put('/ticket/update/{id}', [TicketController::class, 'update'])->name('atualiza.ticket');
    Route::get('/ticket/delete/{id}', [TicketController::class, 'delete']);
    Route::delete('/ticket/delete/{id}', [TicketController::class, 'destroy'])->name('destroy.ticket');
    Route::get('/ticket/assumir/{id}', [TicketController::class, 'assumirTicket'])->name('ticket.assumir-ticket');
    Route::put('/ticket/encerrar/{id}', [TicketController::class, 'encerrarTicket'])->name('ticket.encerrar-ticket');
    Route::get('/ticket/relatorio', [TicketController::class, 'report'])->name('report.ticket');
    Route::get('/ticket/gerarPDF', [TicketController::class, 'gerarPDF'])->name('gerarPDF.ticket');


    Route::get('/relatorios', [PDFController::class, 'index'])->name('relatorio.index');
    Route::get('gerarPDF', [PDFController::class, 'gerarPDF'])->name('gerarPDF');
});
