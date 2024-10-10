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

//        $todos = $todos
//            ->orderBy('type', 'DESC')
//            ->orderBy('created_at', 'DESC')
//            ->orderBy('order', 'DESC')
//            ->get();

        $hotfixes = Todo::where('type', 'hotfix')
            ->orderBy('order', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        $tasks = Todo::where('type', 'task')
            ->orderBy('order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('welcome', compact('todos', 'hotfixes', 'tasks'));
    }



    public function create()
    {
        return view('create');
    }



    public function store(Request $request)
    {

         $validation = request()->validate([
             'name' => 'required|string|max:255',
             'type' => 'required|in:task,hotfix',
             'order' => 'required|integer',
             'deadline_datetime' => '',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);


        $todo = new Todo();
        $todo->name = $request->get('name');
        $todo->type = $request->get('type');
        $todo->order = $request->get('order');
        $todo->deadline_datetime = Carbon::createFromFormat('d-m-Y H:i', $request->get('datetime'));
        $todo->image = $request->file('image')->store('images', 'public');
        $todo->user_id = Auth::id();
        $todo->save();


//         $data = [
//             'name' => request('name'),
//             'type' => request('type'),
//             'deadline_datetime' => Carbon::createFromFormat('d-m-Y H:i', $request->get('datetime')),
//             'image' => request('image')->file('image')->store('images', 'public'),
//             'user_id' => auth()->id()
//         ];
//        Todo::create($data);

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
        return view('edit', compact('todo'));
    }



    public function view(Todo $todo)
    {
        return view('view', compact('todo'));
    }



    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:task,hotfix',
            'order' => 'required|integer',
            'datetime' => '',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $todo->name = $data['name'];
        $todo->type = $data['type'];
        $todo->order = $data['order'];
        $todo->deadline_datetime = Carbon::createFromFormat('Y-m-d H:i:s', $data['datetime']);

        if ($request->hasFile('image')) {
            $todo->image = $request->file('image')->store('images', 'public');
        }

        $todo->save();

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
