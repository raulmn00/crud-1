@extends('master')

@section('content')
    <div class="container">
        <div class="card mt-05">
            <div class="card-header">
                <h1>Lista de Produtos</h1>
            </div>

            @session('success')
                <div class="alert alert-success">{{ $value }}</div>
            @endsession
        </div>
        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm mt-2  mb-2">Add Product</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width='20px'>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-primary btn-sm">Visualizar</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-info btn-sm">Editar</a>
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
