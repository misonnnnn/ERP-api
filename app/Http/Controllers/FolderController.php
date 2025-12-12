<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function index(Request $request)
    {
        return Document::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $data['created_by'] = Auth::user()->id;
        return response()->json(Folder::create($data), 201);
    }

    public function show(Folder $employee)
    {
        return response()->json($employee);
    }

    public function update(Request $request, Folder $employee)
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

    public function destroy(Folder $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
