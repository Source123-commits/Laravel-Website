<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use  Illuminate\Routing\Controllers\Middleware;


class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }
    public function index()
    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(25);
         return view('roles.list', [
            'roles' => $roles]);
        
        
    }

    public function create()
    {    
        $permissions = Permission::orderBy('created_at', 'ASC')->get();

        $hasPermissions = collect(old('permissions', []));

        return view('roles.create', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
        ]);
    }

    public function store(Request $request)
    {
           $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
           $role = Role::create(['name' => $request->name]);

            if(!empty($request->permissions)){
                foreach($request->permissions as $name){
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role added successfully.');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }
    public function edit($id){
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');

        $permissions = Permission::orderBy('created_at', 'ASC')->get();

        return view('roles.edit', 
        ['permissions' => $permissions,
        'hasPermissions' => $hasPermissions,
        'role' => $role]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (! $role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        try {
            $role->delete();
            session()->flash('success', 'Role deleted successfully.');
            return response()->json(['message' => 'Role deleted successfully.']);
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete role.');
            return response()->json(['message' => 'Unable to delete role.'], 500);
        }
    }
    public function update($id, Request $request){

         $role = Role::findOrFail($id);
         $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.'|min:3'
        ]);

        if ($validator->passes()) {
          
            $role->name = $request->name;
            $role->save();

            if(!empty($request->permissions)){
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
        }
    }
    
            
}
