<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaquinaRequest;
use App\Models\Maquina;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;


class MaquinaController extends Controller
{


    public function index(Request $request)
    {
        if ($request->filter == "all") {
            $listar = "all";
            $maquinas = Maquina::all();
        } elseif ($request->filter == null) {
            $listar = "1";
            $maquinas = Maquina::where('status', '1')->get();
        } else {
            $listar = $request->filter;
            $maquinas = Maquina::where('status', $request->filter)->get();
        }

        return view('maquina.index', compact('maquinas', 'listar'));
    }

    public function create()
    {

        return view('maquina.create');
    }

    public function store(MaquinaRequest $request)
    {
        Maquina::create([
            'name' => $request->name,
        ]);

        // return view('maquina.create');

        return redirect()->route('cadastrar.maquina')->with('mensagem', 'Sucesso ao cadastrar!');
    }

    public function show($id)
    {

        $maquina = Maquina::findOrFail($id);
        return view('maquina.show', ['maquina' => $maquina]);
    }

    public function edit($id)
    {
        $maquina = Maquina::findOrFail($id);
        return view('maquina.edit', ['maquina' => $maquina]);
    }

    public function update(MaquinaRequest $request, $id)
    {

        $maquina = Maquina::findOrFail($id);

        $maquina->update([
            'name' => $request->name,
        ]);

        return redirect()->route('maquina.index')->with('mensagem', 'Sucesso ao Editar!');
        // return view('maquina.edit', ['maquina' => $maquina]);
    }

    public function delete($id)
    {
        $maquina = Maquina::findOrFail($id);
        return view('maquina.delete', ['maquina' => $maquina]);
    }

    public function destroy($id)
    {

        $maquinaPossuiTicket = Ticket::where('maquinas_id', $id)->exists();

        if ($maquinaPossuiTicket) {
            return redirect()->route('maquina.index')->with('error', 'Essa máquina não pode ser excluida, pois existem tickets vinculados a essa máquina.');
        }

        $maquina = Maquina::findOrFail($id);
        $maquina->delete();

        return redirect()->route('maquina.index')->with('mensagem', 'Sucesso ao excluir!');
    }

    public function cancel()
    {
        return view('maquina.index');
    }

    public function disable(Maquina $maquina, $id)
    {

        $maquinaPossuiTicket = Ticket::where('maquina_id', $id)->exists();

        if ($maquinaPossuiTicket) {
            return redirect()->back()->with('error', 'Esse maquina não pode ser desativado, pois existem tickets vinculados nesse maquina.');
        }

        $maquina = Maquina::findOrFail($id);
        $maquina->status = '0';
        $maquina->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Desativar!');
    }


    public function active($id)
    {
        $maquina = Maquina::findOrFail($id);

        $maquina->status = '1';
        $maquina->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Ativar!');
    }
}
