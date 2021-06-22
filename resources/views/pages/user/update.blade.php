@extends('pages.user.index')

@section('form')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Update {{$user->name}}</div>

        <div class="card-body">
            <form method="post" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $user->name, old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $user->email, old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
            <form action="{{ route('users.destroy', $user) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h6>Summary:</h6>
                    <ul class="text-muted">
                        <li>{{$user->name}}</li>
                        <li>{{ $user->email }}</li>
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
