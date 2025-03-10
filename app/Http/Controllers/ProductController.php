<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::get();

        return view('products.index', compact('products'));
    }

    public function create(Request $request)
    {

        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => ''
        ]);

        // Outra maneira de passar props pro ::create
        // Product::create([
        //     'name' => $request->name,
        //     'description' => $request->description
        // ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function show(Request $request, $id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => ''
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Produto não encontrado!');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function delete(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Produto não encontrado!');
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto deletado com sucesso!');
    }
}
