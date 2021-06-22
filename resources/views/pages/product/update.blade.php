@extends('pages.product.index')

@section('form')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Update {{$product->name}}</div>

        <div class="card-body">
            <form method="post" action="{{ route('products.update', $product) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Product name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name, old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{$product->sku, old('sku') }}">
                    @error('sku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success float-right">Save changes</button>
                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                    data-target="#delete-modal" data-backdrop="static" data-keyboard="false">Delete</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-sm mt-0 mb-0 modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.destroy', $product) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h6>Summary:</h6>
                    <ul class="text-muted">
                        <li>{{$product->name}}</li>
                        <li>{{ $product->sku }}</li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-danger btn-sm">Yes, I'm sure</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No, take me
                        back</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
