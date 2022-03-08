<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Site2Controller extends Controller {
    private $produtos;
    private $categorias;

    public function __construct(Produto $produtos, Categoria $categorias) {
        $this->produtos = $produtos;
        $this->categorias = $categorias;
    }

    //Preciso modificar essa rota para poder carregar minha página
    public function index() {
        $produtos = $this->produtos->all();
        return view('layouts.page_templates.site');
        // return view('produto.index', compact('produtos'));
    }


    public function create() {
        $categorias = $this->categorias->all();
        return view('produto.crud', compact('categorias'));
    }


    public function store(ProdutoRequest $request) {
        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->descricao = $request->input('descricao');
        $produto->quantidade = $request->input('quantidade');
        $imagem = $request->file('imagem')->store('produtos', 'public');
        $produto->imagem = $imagem;
        $produto->categoria_id = $request->input('categoria_id');

        $produto->save();

        return redirect(route('produto.index'));
    }


    public function show($id) {
        $produto = $this->produtos->find($id);
        $categoria = $this->categorias->find($produto->categoria_id);
        $produto->categoria = $categoria->categoria;
        return json_encode($produto);
    }


    public function edit($id) {
        $produto = $this->produtos->find($id);
        $categorias = $this->categorias->all();
        return view('produto.crud', compact('produto', 'categorias'));
    }


    public function update(ProdutoRequest $request, $id) {
        $data = $request->all();
        $produto = $this->produtos->find($id);

        if ($request->hasFile('imagem')) {
            Storage::delete('public/' . $produto->imagem);
            $data['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }
        $produto->update($data);
        return redirect(route('produto.index'));
    }

    public function destroy($id) {
        $produto = $this->produtos->find($id);
        Storage::drive('public')->delete($produto->imagem);
        $produto->delete();

        return redirect(route('produto.index'));
    }
}
