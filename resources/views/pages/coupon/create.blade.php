@extends('pages.coupon.index')

@section('form')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Create new</div>

        <div class="card-body">
            <form method="post" action="{{ route('coupons.store') }}">
                @csrf
                <div class="form-group">
                    <label>Coupon code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                        value="{{ old('code') }}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Product</label>
                    <select class="form-control select2  @error('product_id') is-invalid @enderror" name="product_id"
                        style="width: 100%;">
                        <option disabled selected>--none--</option>
                        @foreach ($products as $i )
                        <option value="{{ $i->id }}" {{ old('product_id') == $i->id ? 'selected' : '' }}>
                            {{ $i->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Bulk upload</div>
        <div class="card-body">
            <form action="{{ route('coupon.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file"
                                name="file">
                            <label class="custom-file-label" for="upload">Choose file</label>
                            @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                @if ($errors->has('file'))
                    @foreach ($errors->all() as $error)
                        <div class="text-sm text-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <button type="submit" class="btn btn-dark float-right">Upload</button>
            </form>
        </div>
    </div>
</div>
@endsection
