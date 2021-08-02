@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Coupons</div>

                <div class="card-body">
                    <table id="alltbl" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $coupons as $i )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->code }}</td>
                                <td>{{ $i->product->product_name() }}</td>
                                <td>
                                    <span class="text-{{$i->status === 'Unused' ? 'success' : 'secondary'}}"><strong>{{ $i->status }}</strong></span>
                                </td>
                                <td>
                                    @php
                                        $product = $i->product->sku;
                                        $public_runs = ['public', 'runs', 'public_runs'];
                                        $contains = Illuminate\Support\Str::contains($product, $public_runs);
                                    @endphp
                                    <a href="{{ route('coupons.edit', $i->id) }}" class="btn btn-secondary btn-sm {{ $contains ? '' : 'disabled' }}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @yield('form')
    </div>
</div>
@endsection
