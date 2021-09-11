<?php

namespace App\Http\Controllers;
use App\Exports\ProdutosExport;
Use Illuminate\Support\Facades\Mail;
use App\Mail\NovoProdutoMail;
use App\Models\Produto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $produto = Produto::where('user_id', $user_id)->paginate(10);
        return view('produto.index',['produto' => $produto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $dados = $request->all('nome','valor', 'data_cadastro');
        if (isset(auth()->user()->id)) {
            $dados['user_id'] = auth()->user()->id;
        }

        $produto = Produto::create($dados);
        $destinatario = auth()->user()->email;  //usuario logado
        Mail::to($destinatario)->send(new NovoProdutoMail($produto) );
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('produto.show', ['produto'=> $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $user_id = auth()->user()->id;

       if($produto->user_id == $user_id){
           return view('produto.edit', ['produto' => $produto]);

       }

       return view('acesso-negado');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {

        if (!$produto->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }

            $produto->update($request->all());
            return redirect()->route('produto.show', ['produto' => $produto->id]);
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {

        if (!$produto->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
       $produto->delete();
        return redirect()->route('produto.index');

    }

    public function exportacao(){
        return Excel::download(new ProdutosExport, 'lista_de_produtos.xlsx');
    }


}
