@extends('master')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Adicionar Produto</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name" name="name" required>

                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        @error('description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
