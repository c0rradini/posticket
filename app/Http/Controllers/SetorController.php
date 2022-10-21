<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorRequest;
use App\Models\Setor;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;


class SetorController extends Controller
{


    public function index(Request $request)
    {

        if ($request->filter == "all") {
            $listar = "all";
            $setores = Setor::all();
        } elseif ($request->filter == null) {
            $listar = "1";
            $setores = Setor::where('status', '1')->get();
        } else {
            $listar = $request->filter;
            $setores = Setor::where('status', $request->filter)->get();
        }

        return view('setor.index', compact('setores', 'listar'));
    }

    public function create()
    {

        return view('setor.create');
    }

    public function store(SetorRequest $request)
    {
        Setor::create([
            'name' => $request->name,
        ]);

        return redirect()->route('cadastrar.setor')->with('mensagem', 'Sucesso ao cadastrar!');

        // return view('setor.create');
    }

    public function show($id)
    {

        $setor = Setor::findOrFail($id);
        return view('setor.show', ['setor' => $setor]);
    }

    public function edit($id)
    {
        $setor = Setor::findOrFail($id);
        return view('setor.edit', ['setor' => $setor]);
    }

    public function update(Request $request, $id)
    {

        $setor = Setor::findOrFail($id);


        $setor->update([
            'name' => $request->name,
        ]);

        return redirect()->route('setor.index')->with('mensagem', 'Sucesso ao Editar!');

        // return view('setor.edit', ['setor' => $setor]);
    }

    public function delete($id)
    {
        $setor = Setor::findOrFail($id);
        return view('setor.delete', ['setor' => $setor]);
    }

    public function destroy($id)
    {

        $setorPossuiUsuarios = User::where('setores_id', $id)->exists();

        if ($setorPossuiUsuarios) {
            return redirect()->route('setor.index')->with('error', 'Esse setor não pode ser excluido, pois existem usuários vinculados nesse setor.');
        }

        $setor = Setor::findOrFail($id);
        $setor->delete();

        return redirect()->route('setor.index')->with('mensagem', 'Sucesso ao excluir!');
    }

    public function cancel()
    {
        return view('setor.index');
    }

    public function disable(Setor $setor, $id)
    {

        $setorPossuiTicketAtivo = Ticket::where('maquina_id', $id)->exists();

        if ($setorPossuiTicketAtivo) {
            return redirect()->back()->with('error', 'Esse setor não pode ser desativado, pois existem tickets vinculados nesse setor.');
        }

        $setorPossuiUsuarios = User::where('setores_id', $id)->exists();

        if ($setorPossuiUsuarios) {
            return redirect()->back()->with('error', 'Esse setor não pode ser desativado, pois existem usuários vinculados nesse setor.');
        }

        $setor = Setor::findOrFail($id);
        $setor->status = '0';
        $setor->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Desativar!');
    }


    public function active($id)
    {

        $setor = Setor::findOrFail($id);

        $setor->status = '1';
        $setor->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Ativar!');
    }
}
