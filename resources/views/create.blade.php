@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('todo.store') }}" method="post">
            @csrf
            <div class="mb-3 input-group has-validation">
                <label for="exampleInputEmail1" class="form-label"></label>
                <input type="text" name="name" class="form-control" placeholder="Write your task" id="exampleInputEmail1">
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-3 input-group has-validation">
                <select class="form-control" id="type" name="type">
                    <option value="">Select Type</option>
                    <option value="task">Task</option>
                    <option value="hotfix">Hotfix</option>
                </select>
                @error('type')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="datetimepicker">Choose deadline</label>
                <input type="text" id="datetimepicker" class="form-control" placeholder="Choose date and time" name="datetime">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
