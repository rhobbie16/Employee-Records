<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function showDepartments()
    {
        $departments = Department::all();
        return view('departments', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments']);
        Department::create($request->all());
        return redirect()->route('departments')->with('success', 'Department added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $id]);
        Department::findOrFail($id)->update($request->all());
        return redirect()->route('departments')->with('success', 'Department updated successfully!');
    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        return redirect()->route('departments')->with('success', 'Department deleted successfully!');
    }
}