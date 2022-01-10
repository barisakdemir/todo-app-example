<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Todo;

class TodoController extends Controller
{
    public function dashboard()
    {
        $allTodos = Todo::orderBy('active', 'desc')->orderBy('deadline', 'asc')->paginate(10);
        return view('todo.dashboard', compact('allTodos'));
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name'      => 'required',
            'active'    => 'boolean',
            'deadline'  => 'required|date',
            'level'     => 'required|integer|between:1,5',
            'comment'   => 'required',
        ]);

        //store
        Todo::create($request->all());

        //redirect
        return Redirect()->route('dashboard')->withSuccess('Todo added successfully');
    }

    public function edit($id)
    {
        $todo = Todo::whereId($id)->first() ?? abort(404, 'Todo not found!');
        return view('todo.edit', compact('todo'));
    }

    public function patch($id, Request $request)
    {
        //validation
        $request->validate([
            'name'      => 'required',
            'active'    => 'boolean',
            'deadline'  => 'required|date',
            'level'     => 'required|integer|between:1,5',
            'comment'   => 'required',
        ]);

        //patch
        $todo = Todo::whereId($id)->first() ?? abort(404, 'Todo not found!');
        $todo->fill($request->all())->save();

        //redirect
        return Redirect()->route('dashboard')->withSuccess('Todo update successfully');
    }

    public function delete($id)
    {
        //delete
        $todo = Todo::whereId($id)->first() ?? abort(404, 'Todo not found!');
        $todo->delete();

        //redirect
        return Redirect()->route('dashboard')->withSuccess('Todo remove successfully');
    }
}
