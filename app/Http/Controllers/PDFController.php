<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerarPDF(Request $request)
    {
        // $maquinas = Maquina::get();
        
        $relatorio = null;

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

        $data = [
            'title' => 'Relatório de Máquinas',
            'date' => date('d/m/Y H:i'),
            'maquinas' => $maquinas,
        ];

        $pdf = PDF::loadView('relatorio/pdf', $data);

        return $pdf->download('relatorio.pdf', compact('maquinas', 'listar'));
    }

    public function index(Request $request)
    {

        $listar = "all";

        return view('relatorio.index', compact('listar'));
    }
}
