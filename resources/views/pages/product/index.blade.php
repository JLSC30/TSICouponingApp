@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <table id="alltbl" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $products as $i )
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->sku }}</td>
                                <td>
                                    <a href="{{ route('products.show', $i->id) }}"
                                        class="btn btn-success btn-sm">Update</a>
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
