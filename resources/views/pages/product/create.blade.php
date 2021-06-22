@extends('pages.product.index')

@section('form')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Create new</div>

        <div class="card-body">
            <form method="post" action="{{ route('products.store') }}">
                @csrf
                <div class="form-group">
                    <label>Product name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ old('sku') }}">
                    @error('sku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
