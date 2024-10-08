<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::query();


        if (!Auth::user()->admin) {
            $userId = Auth::id();
            $todos->where('user_id', $userId);
        }


        $todos = $todos
            ->orderBy('type', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();


        $hotfixes = Todo::where('type', 'hotfix')->get();
        $tasks = Todo::where('type', 'task')->get();


        return view('welcome', compact('todos', 'hotfixes', 'tasks'));
//        return view('welcome', ["todos"=>$todos]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // TODO avelacnel validation +++

         $validation = request()->validate([
             'name' => 'required|string|max:255',
             'type' => 'required|in:task,hotfix',
             'deadline_datetime' => '',
         ]);


        now('Asia/Yerevan');
//         $validated = $validator->validated();;
         $data = [
             'name' => request('name'),
             'type' => request('type'),
             'deadline_datetime' => Carbon::createFromFormat('d-m-Y H:i', $request->get('datetime')),
             'user_id' => auth()->id()
         ];
        Todo::create($data);


//          TODO PORCNAKAN

//        TODO NEW MODEL

//        dd($request->all());

//        $todo1 = new Todo([
//            'name' => $request->get('name'),
//            'type' => $request->get('type'),
//            'deadline_datetime' => Carbon::createFromFormat('d  -m-Y H:i', $request->get('datetime')),
//            'user_id' => Auth::id(),
//        ]);
//        $todo1->save();

////        TODO FILL
//        $todo2 = new Todo();
//        $todo2->fill([
//            'name' => $request->get('name'),
//            'type' => $request->get('type'),
//            'user_id' => Auth::id(),
//        ]);
//        $todo2->save();
//
////        TODO $model->property
//        $todo3 = new Todo();
//
//        $todo3->name = $request->get('name');
//        $todo3->type = $request->get('type');
//        $todo3->user_id = Auth::id();
//
//        $todo3->save();
//
//
//        $todo3 = Todo::find(1);
//
//        $todo3->name = $request->get('name');
//        $todo3->type = $request->get('type');
//        $todo3->user_id = Auth::id();
//
//        $todo3->save();


        return redirect('/');
    }

    public function edit(Todo $todo)
    {
//        dd($todo->name);
        return view('edit', compact('todo'));
//        dd($todo);
    }

    public function update(Todo $todo)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'deadline_datetime' => '',
        ]);
        $todo -> update($data);
        return redirect('/');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('/');
    }

    public function complete(Todo $todo)
    {
        $todo->status = 1;
        $todo->save();
        return redirect('/');
    }

    public function uncomplete(Todo $todo)
    {
        $todo->status = 0;
        $todo->save();
        return redirect('/');
    }
}
