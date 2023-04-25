<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function create()
    {
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

        return back();
    }

    public function edit(Department $department)
    {
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
        Department::destroy($id);
        return redirect('/');
    }
}
