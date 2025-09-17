<?php

namespace App\Http\Controllers;

use App\Models\Type;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index()
    {

        return view('types.index', ['types' => Type::all()]);
    }
    
    
    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        Type::create(['name' => $request->name,]);
        return redirect('/');
    }

    public function edit($id)
    {
        $type = Type::find($id);
        return view('types.edit', ['type' => $type]);
    }
    public function update(Request $request)
    {
        $product = Type::find($request->id);
        $product->update([
            'name' => $request->name,
        ]);
        return redirect('/types')->with('success', 'tipo atualizado
        com sucesso!');
    }
    public function destroy($id)
    {
        try{
            $type = Type::find($id);
            $type->delete();
            return redirect('/types')->with('success', 'tipo excluído com sucesso!');
        }catch(QueryException $e){
            if($e->getCode() === '23000'){
                return redirect('/types')->with('error', 'Não é possivel excluir, exitem produtos com esse tipo');

            }
                return redirect('/types')->with('error', 'Erro inesperado');

        } catch(\Throwable $e){
                return redirect('/types')->with('error', 'Erro inesperado');

        }

    }
}
