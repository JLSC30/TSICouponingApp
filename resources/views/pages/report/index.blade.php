@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generate Report</div>
                <div class="card-body">
                    <form action="{{ route('report.index') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <label>Product</label>
                            <select class="form-control select2 @error('product') is-invalid @enderror" name="product">
                                    <option disabled selected>--none--</option>
                                @foreach ($products as $p )
                                    <option value="{{$p->id}}" {{ old('product') == $p->id ? ' selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <small class="form-text  text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- <div class="form-group">
                            <label>Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="Unused" {{ old('status') == 'Unused' ? ' selected' : '' }}>Unused
                                </option>
                                <option value="Used" {{ old('status') == 'Used' ? ' selected' : '' }}>Used
                                </option>
                            </select>
                            @error('status')
                            <small class="form-text  text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for="reportDate">Date range</label>
                            <input type="text" class="form-control @error('reportDate') is-invalid @enderror"
                                id="reportDate" name="reportDate" value="{{ old('reportDate') }}">
                            @error('reportDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Generated Data</div>
                <div class="card-body">
                    <table id="reporttbl" class="table table-bordered table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Coupon</th>
                                <th>Status</th>
                                <th>Sold at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $i )
                            <tr>
                                <td>{{$i->product->name}}</td>
                                <td>{{$i->code}}</td>
                                <td>{{$i->status}}</td>
                                <td>{{$i->updated_at->format('M-d-Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
