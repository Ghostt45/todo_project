@extends('welcome')

@section('porc')
    <div class="list-group-item d-flex gap-3 justify-content-between align-items-center" style="margin-bottom: 15px; width: 100%; border: 1px solid red">
        <div class="d-flex gap-3">
            {{--                <input class="form-check-input flex-shrink-0" type="checkbox" value="" checked style="font-size: 1.375em;">--}}
            @if($todo->status == 0)
                <a href="{{ route("todo.complete", $todo->id) }}" class="btn btn-success btn-sm" name="complete" style="display: flex; align-items: center">Complete</a>
            @endif
            @if($todo->status == 1)
                <a href="{{ route("todo.uncomplete", $todo->id) }}" class="btn btn-primary btn-sm" name="uncomplete" style="display: flex; align-items: center">Uncomplete</a>
            @endif
            <span class="pt-1 form-checked-content">
              <strong>{{$todo->name}}</strong>
              <small class="d-block text-muted">
                <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                {{$todo->created_at}}
              </small>
        </div>
        </span>
        <div style="display: flex; justify-content: space-between; align-items: center"  class="gap-3">
            @if(Auth::user()-> admin == 1)
                <p style="margin-bottom: 0">{{ $todo->user->name }}</p>
            @endif
            <a href="{{route("todo.edit",$todo->id)}}" class="btn btn-warning btn-sm" style="display: flex; align-items: center">Update</a>
            <form action="{{ route('todo.delete',$todo->id) }}" method="POST" style="display: flex;">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" style="display: flex; align-items: center" href="{{route("todo.delete",$todo->id)}}" class="btn btn-danger">
            </form>
        </div>
    </div>


    <div class="d-flex align-items-center">
        <p>{{$todo->type}}</p>

        @if($todo->type == 'hotfix')
            @yield('porc')
        @endif
    </div>
    </div>
@endsection
