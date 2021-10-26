<?php

namespace App\Http\Controllers;
use App\Exports\ClientesExport;
Use Illuminate\Support\Facades\Mail;
use App\Mail\NovoClienteMail;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $cliente = Cliente::where('user_id', $user_id)->paginate(10);
        return view('cliente.index',['cliente' => $cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $dados = $request->all('nome','email', 'data_cadastro');
        if (isset(auth()->user()->id)) {
            $dados['user_id'] = auth()->user()->id;
        }

        $cliente = Cliente::create($dados);
        $destinatario = auth()->user()->email;  //usuario logado
        Mail::to($destinatario)->send(new NovoClienteMail($cliente) );
        return redirect()->route('cliente.show', ['cliente' => $cliente->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', ['cliente'=> $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $user_id = auth()->user()->id;

       if($cliente->user_id == $user_id){
           return view('cliente.edit', ['cliente' => $cliente]);

       }

       return view('acesso-negado');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {

        if (!$cliente->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }

            $cliente->update($request->all());
            return redirect()->route('cliente.show', ['cliente' => $cliente->id]);
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {

        if (!$cliente->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
       $cliente->delete();
        return redirect()->route('cliente.index');

    }

    public function exportacao($extensao){

        $nome_arquivo =  'lista_de_clientes';

        if ($extensao == 'xlsx'){
            $nome_arquivo .= '.'.$extensao;
        }else if ($extensao == 'csv'){
            $nome_arquivo .= '.'.$extensao;
        } else{
            return redirect()->route('cliente.index');

        }
        return Excel::download(new ClientesExport, $nome_arquivo);
    }


}
