<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    public function show($id)
    {
        $tickets = Ticket::with('taker', 'department')->where('department_id', $id)->get();
        // tODO: Get department data only once
        return view('show', ['tickets' => $tickets]);
    }

    public function create()
    {
        if (! Gate::allows('admin')) {
            abort(403);
        }
        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:departments','max:255']
        ]);
        $department = new Department();
        $department->name = $request['name'];
        $department->user_id = auth()->id();
        $department->role = User::where('id', auth()->id())->value('role');
        $department->save();

        return redirect('/');
    }

    public function edit(Department $department)
    {
        if (! Gate::allows('update-department', $department)) {
            abort(403);
        }
        return view('department.edit', ['department' => $department]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','unique:departments','max:255']
        ]);
        $department = Department::findOrFail($id);

        $department->name = $request['name'];
        $department->update();

        return redirect('/');
    }

    public function destroy(Request $request,$id)
    {
        $department = Department::findOrFail($id);
        if (! Gate::allows('update-department', $department)) {
            abort(403);
        }
        Department::destroy($id);
        return redirect('/');
    }
}
