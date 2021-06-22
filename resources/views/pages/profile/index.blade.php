@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }} Profile</div>
                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ Auth::user()->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                        <a href="{{ route('profile.changepassword') }}" class="text-muted">Change password form</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }} API Key</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{  route('profile.generateApiKey') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">Generate API Key</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                            <form action="{{  route('profile.deleteApiKey') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm float-right">Delete API
                                    Key</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
