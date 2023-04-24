<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('home', ['departments' => $departments]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $department = new Department;
        $department->name = $request->validate([
            'name' => 'required|unique:departments|max:255',
        ]);
        $department->save();

        return view('home');
    }
}
