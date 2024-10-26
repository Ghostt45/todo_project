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

        if (Auth::user()->admin) {
            $hotfixes = Todo::where('type', 'hotfix')
                ->orderBy('order', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->get();
            $tasks = Todo::where('type', 'task')
                ->orderBy('order', 'ASC')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $hotfixes = Todo::where('user_id', Auth::id())->where('type', 'hotfix')
                ->orderBy('order', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->get();
            $tasks = Todo::where('user_id', Auth::id())->where('type', 'task')
                ->orderBy('order', 'ASC')
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        return view('welcome', compact( 'hotfixes', 'tasks'));
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
            'datetime' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $todo = new Todo();
        $todo->name = $request->get('name');
        $todo->type = $request->get('type');
        $todo->order = $request->get('order');
        $todo->deadline_datetime = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('datetime'));
        $todo->image = $request->file('image')->store('images', 'public');
        $todo->user_id = Auth::id();
        $todo->save();


        return redirect('/');
    }



    public function edit(Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        return view('edit', compact('todo'));
    }



    public function view(Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        return view('view', compact('todo'));
    }



    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }


        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:task,hotfix',
            'order' => 'required|integer',
            'datetime' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $todo->name = $data['name'];
        $todo->type = $data['type'];
        $todo->order = $data['order'];
        $todo->deadline_datetime = Carbon::createFromFormat('Y-m-d\TH:i', $data['datetime']);

        if ($request->hasFile('image')) {
            $todo->image = $request->file('image')->store('images', 'public');
        }

        $todo->save();

        return redirect('/');
    }




    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        $todo->delete();
        return redirect('/');
    }



    public function complete(Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        $todo->status = 1;
        $todo->save();
        return redirect('/');
    }



    public function uncomplete(Todo $todo)
    {
        if ($todo->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        $todo->status = 0;
        $todo->save();
        return redirect('/');
    }
}
