@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('todo.update', $todo->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3 input-group has-validation">
                <label for="exampleInputEmail1" class="form-label"></label>
                <input type="text" name="name" value="{{$todo->name}}" class="form-control" placeholder="Write your task" id="exampleInputEmail1">
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="datetimepicker">Choose deadline</label>
                <input type="text" id="datetimepicker" class="form-control" placeholder="{{$todo->deadline_datetime}}" name="datetime" value="{{$todo->deadline_datetime}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>


    </div>
@endsection
