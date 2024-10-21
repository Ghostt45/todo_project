@extends('panel')

@section('content')
    <div class="container">
        <form action="{{ route('todo.s_update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <center class="mt-3">
                <h2>Security</h2>
            </center>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <div class="mb-3 mt-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" placeholder="Write your password" id="exampleInputEmail1">
                @error('password')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>


            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">New password</label>
                <input type="text" name="new_password" class="form-control" placeholder="Write new password" id="exampleInputEmail1">
                @error('new_password')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-5 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Confirm new password</label>
                <input type="text" name="password_confirm" class="form-control" placeholder="Confirm new password" id="exampleInputEmail1">
                @error('password_confirm')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>



            <a href="{{route('todo.index')}}" class="btn btn-primary">Return to main page</a>
            <button type="submit" class="btn btn-success">Update</button>
        </form>


    </div>
@endsection
