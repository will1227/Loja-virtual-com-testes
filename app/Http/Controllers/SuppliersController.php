<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\Type;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        return view('suppliers.index', [
            'suppliers' => Suppliers::all()
        ]);
    }

    public function create()
    {
        return view('suppliers.create', [
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:F,J',
            'name' => 'required|min:2|max:100 ',
            'cpf_cnpj' => 'required|string|min:11|max:20',
            'telefone' => 'required|string|min:11|max:20'
        ]);
        
        Suppliers::create([
            'tipo' => $request->tipo,
            'name' => $request->name,
            'cpf_cnpj' => $request->cpf_cnpj,
            'telefone' => $request->telefone
        ]);
        return redirect('/suppliers')->with('success', 'Fornecedor Adicionado
        com sucesso!');
    }

    public function edit($id){
        $supplier = Suppliers::find($id);

        return view('suppliers.edit', ['supplier' => $supplier]);
    }
    public function update(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);
        $request->validate([
            'tipo' => 'required|in:F,J',
            'name' => 'required|min:2|max:100 ',
            'cpf_cnpj' => 'required|string|min:11|max:20',
            'telefone' => 'required|string|min:11|max:20'
        ]);
        $supplier->update([
            'tipo' => $request->tipo,
            'name' => $request->name,
            'cpf_cnpj' => $request->cpf_cnpj,
            'telefone' => $request->telefone
        ]);
        return redirect('/suppliers')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id){
        $supplier = Suppliers::find($id);
        $supplier->delete();
        return redirect('/suppliers')->with('success', 'Fornecedor excluido com sucesso!');
    }
}
