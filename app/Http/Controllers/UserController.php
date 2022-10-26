<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{

    public function login()
    {
        return view('welcome');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'E-mail é obrigatório.',
            'password.required' => 'Senha é obrigatória.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        } else {
            return redirect()->back()->with('danger', 'E-mail ou Senha inválida');
        }
    }


    public function index(Request $request)
    {
        if ($request->filter == "all") {
            $listar = "all";
            $users = User::all();
        } elseif ($request->filter == null) {
            $listar = "1";
            $users = User::where('status', '1')->get();
        } else {
            $listar = $request->filter;
            $users = User::where('status', $request->filter)->get();
        }

        return view('user.index', compact('users', 'listar'));
    }

    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ramal' => $request->ramal,
            'tecnico' => $request->tecnico,
            'setores_id' => $request->setores_id,
        ]);

        return redirect()->route('cadastrar.user')->with('mensagem', 'Sucesso ao cadastrar!');
        // return view('user.create');
    }

    public function show($id)
    {

        $user = User::findOrFail($id);
        return view('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'ramal' => $request->ramal,
            'password' => Hash::make($request->password),
            'setores_id' => $request->setores_id,
            'tecnico' => $request->tecnico,
        ]);


        return redirect()->route('user.index')->with('mensagem', 'Sucesso ao Editar!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return view('user.delete', ['user' => $user]);
    }

    public function destroy($id)
    {

        /*$userPossuiUsuarios = User::where('users_id', $id)->exists();

        if ($userPossuiUsuarios) {
            return redirect()->route('user.index')->with('error', 'Esse user não pode ser excluido, pois existem usuários nesse user.');
        }*/

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('mensagem', 'Sucesso ao excluir!');
    }

    public function cancel()
    {
        return view('user.index');
    }

    public function perfil(Request $request)
    {
        $usuarioEmail = User::where('email', '=', $request->input('email'))->first();
        if ($usuarioEmail) {
            if ($usuarioEmail->email != Auth::user()->email)
                dd('email ja cadastrado');
        } else {
            User::where('userId', Auth::user()->userId)->update(['email' => $request->input('email')]);
        }
    }

    public function disable(Ticket $user, $id)
    {

        $userPossuiTicket = Ticket::where('requerente_user_id', $id)->exists();

        if ($userPossuiTicket) {
            return redirect()->back()->with('error', 'Esse usurário não pode ser desativado, pois existem tickets vinculados nesse usuário.');
        }

        $userTecPossuiTicket = Ticket::where('responsavel_user_id', $id)->exists();

        if ($userTecPossuiTicket) {
            return redirect()->back()->with('error', 'Esse usurário não pode ser desativado, pois existem tickets vinculados nesse usuário.');
        }

        $user = User::findOrFail($id);
        $user->status = '0';
        $user->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Desativar!');
    }


    public function active($id)
    {
        $user = User::findOrFail($id);

        $user->status = '1';
        $user->update();

        return redirect()->back()->with('mensagem', 'Sucesso ao Ativar!');
    }

    public function report(Request $request)
    {

        $status = "all";
        $tecnico = "all";
        $setores = "all";

        return view('user.report', compact('status', 'tecnico', 'setores'));
    }

    public function gerarPDF(Request $request)
    { 
        // if ($request->status == "*" && $request->tecnico == "*" && $request->setores == "*")
        //  {
        
        //     $users = User::all();

        // } else {

            $users = User::select('*')->status($request->status)->tecnico($request->tecnico)->setores($request->setores)->get();

            
        // $users = User::where('status', $request->status)->where('tecnico', $request->tecnico)->where('setores_id', $request->setores)->get();

        // }

        // if ($request->status == "all" && $request->tecnico == "all" && $request->setores == "all") {

        //     $users = User::all();

        // } elseif ($request->status != "all" && $request->tecnico == "all" && $request->setores == "all") {

        //     $users = User::where('status', $request->status)->get();

        // } elseif ($request->status != "all" && $request->tecnico != "all" && $request->setores == "all") {

        //     $users = User::where('status', $request->status)->where('tecnico', $request->tecnico)->get();
            
        // } else {

        //     $users = User::where('status', $request->status, 'tecnico', $request->tecnico, 'setores', $request->setores)->get();
        // } 


        // if ($request->status == "all") {
        //     $listar = "all";
        //     $users = User::all();
        // } elseif ($request->status == null) {
        //     $listar = "1";
        //     $users = User::where('status', '1')->get();
        // } else {
        //     $listar = $request->status;
        //     $users = User::where('status', $request->status)->get();
        // }


        $data = [
            'title' => 'Relatório de Usuário',
            'date' => date('H:i d/m/Y'),
            'users' => $users,
        ];

        $pdf = PDF::loadView('user/PDF', $data)->setPaper('A4', 'landscape');;

        return $pdf->download('reportUsuarios.pdf', compact('users'));
    }
}
