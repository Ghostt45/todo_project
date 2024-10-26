@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('todo.update', $todo->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" value="{{$todo->name}}" class="form-control" placeholder="Write your task" id="exampleInputEmail1">
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-3 form-group has-validation">
                <label>Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="{{$todo->type}}">{{$todo->type}}</option>
                    @if($todo->type == 'task')
                        <option value="hotfix">hotfix</option>
                    @elseif($todo->type == 'hotfix')
                        <option value="task">task</option>
                    @endif
                </select>
                @error('type')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Order number</label>
                <input type="text" name="order" class="form-control" placeholder="Write order number" id="exampleInputEmail1" value="{{$todo->order}}">
                @error('order')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="datetimepicker">Choose deadline</label>
                <input type="datetime-local" id="datetimepicker" class="form-control" placeholder="Choose deadline" name="datetime" value="{{$todo->deadline_datetime}}">
                @error('datetime')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="formFile" name="image" value="{{$todo->image}}">
            </div>

            <div class="form-group mb-1">
                <label for="formFile" class="form-label">Selected image</label>
            </div>

            @if($todo->image)
                <div>
                    <img class="img-fluid mb-4" style="width: 250px; height: 250px" src="{{ asset('storage/' . $todo->image) }}">
                </div>
            @endif


            <a href="{{route('todo.index')}}" class="btn btn-primary">Return to main page</a>
            <button type="submit" class="btn btn-success">Update</button>
        </form>


    </div>
@endsection
