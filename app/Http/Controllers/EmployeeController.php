<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function showEmployees()
    {
        $employees   = Employee::with('department')->get();
        $departments = Department::all();
        return view('employees', compact('employees', 'departments'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'fullname'      => 'required',
                'gender'        => 'required',
                'email'         => 'required|email|unique:employees',
                'contact'       => 'nullable',
                'position'      => 'nullable',
                'department_id' => 'nullable|exists:departments,id',
                'status'        => 'required|in:active,inactive',
                'date_hired'    => 'nullable|date',
            ]);

            $last       = Employee::orderBy('id', 'desc')->first();
            $nextNum    = $last ? (intval(substr($last->employee_id, 4)) + 1) : 1;
            $employeeId = 'EMP-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

            Employee::create([
                'employee_id'   => $employeeId,
                'fullname'      => $request->fullname,
                'gender'        => $request->gender,
                'email'         => $request->email,
                'contact'       => $request->contact,
                'position'      => $request->position,
                'department_id' => $request->department_id,
                'status'        => $request->status,
                'date_hired'    => $request->date_hired,
            ]);

            return redirect()->route('employees')->with('success', 'Employee added successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', implode(' ', $e->validator->errors()->all()));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'fullname'      => 'required',
            'gender'        => 'required',
            'email'         => 'required|email|unique:employees,email,' . $id,
            'contact'       => 'nullable',
            'position'      => 'nullable',
            'department_id' => 'nullable|exists:departments,id',
            'status'        => 'required|in:active,inactive',
            'date_hired'    => 'nullable|date',
        ]);

        $employee->update([
            'fullname'      => $request->fullname,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'contact'       => $request->contact,
            'position'      => $request->position,
            'department_id' => $request->department_id,
            'status'        => $request->status,
            'date_hired'    => $request->date_hired,
        ]);

        return redirect()->route('employees')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees')->with('success', 'Employee deleted successfully!');
    }
}