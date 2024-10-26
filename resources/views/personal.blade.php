@extends('panel')

@section('content')
    <div class="container">
        <form action="{{ route('todo.p_update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <center class="mt-3">
                <h2>Personal Information</h2>
            </center>
            <div class="mb-3 mt-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Write your task" id="exampleInputEmail1">
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>


            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Write order number" id="exampleInputEmail1" value="{{$user->email}}">
                @error('email')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>


            <div class="mb-5 form-group has-validation">
                <label>Access</label>
                <select class="form-control" id="type" name="admin">
                    <option value="{{$user->admin}}">{{($user->admin == 1) ? 'Admin' : 'Not admin'}}</option>
                    @if($user->admin == '0')
                        <option value="1">Admin</option>
                    @elseif($user->admin == '1')
                        <option value="0">Not admin</option>
                    @endif
                </select>
                @error('admin')
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
