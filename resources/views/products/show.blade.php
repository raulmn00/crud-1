@extends('master')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Product Details</h4>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <hr>
                        <div class="card-text mb-4">
                            <p class="lead">{{ $product->description }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Products
                            </a>
                            <div>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
