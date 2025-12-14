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
        $query = Folder::query();
        $parent_id = null;
        if(isset($request->folder_parent_id) && !empty($request->folder_parent_id)){
            $parent_id = $request->folder_parent_id;
        }
        $query->where('parent_id', $parent_id);

        $query->orderby('id', 'desc');
        return $query->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|integer'
        ]);

        //if name is existing
        $queryFolder = Folder::where('name', $request->name)->first();

        if($queryFolder){
            return response()->json([
                'success' => false,
                'message' => 'Folder name already existing!'
            ], 503);
        }

        $data['created_by'] = Auth::user()->id;
        Folder::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Folder created successfully!'
        ], 201);
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
