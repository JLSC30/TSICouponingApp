@extends('pages.coupon.index')

@section('form')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Update coupon</div>

        <div class="card-body">
            <form method="post" action="{{ route('coupons.update', $coupon) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Coupon code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                        value="{{ old('code', $coupon->code) }}" autofocus>
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
                        <option></option>
                        @foreach ($products as $i )
                        <option value="{{ $i->id }}" {{ $coupon->product_id == $i->id ? 'selected' : '' }}>
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
                <button type="submit" class="btn btn-success float-right">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
