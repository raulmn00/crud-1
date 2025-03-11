<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Criar produto associado ao usuário logado
    $product = User::associateProduct(productId: $request->input('id'), userId: $request->input('user_id'));

    return redirect()
      ->route('products.my')
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

  public function myProducts(Request $request)
  {
    // Buscar produtos do usuário logado
    $products = Auth::user()->products;

    return view('products.my-products', [
      'products' => $products,
      'user' => Auth::user()
    ]);
  }
}
