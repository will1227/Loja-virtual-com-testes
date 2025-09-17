<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('search');
        if ($filter) {
            $products = Product::where('name', 'like', "%$filter%")->get();
        } else {
            $products = Product::with('type')->orderBy('name', 'asc')->get();
        }
        return view('products.index', ['products' => $products, 'filter' => $filter]);
    }

    public function create()
    {
        return view('products.create', [
            'types' => Type::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'image_path' => $imagePath, 
        ]);

        return redirect('/products')->with('success', 'Produto adicionado com sucesso!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product, 'types' => Type::all()]);
    }
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'type_id' => $request->type_id

        ]);
        return redirect('/products')->with('success', 'Produto atualizado
        com sucesso!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('success', 'Produto excluído com sucesso!');
    }
}
