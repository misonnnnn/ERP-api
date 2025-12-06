<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:employees,email',
            'position_id' => 'nullable'
        ]);

        return response()->json(Employee::create($data), 201);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:employees,email,' . $employee->id,
            'position' => 'nullable'
        ]);

        $employee->update($data);
        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
