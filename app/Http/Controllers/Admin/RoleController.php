<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->middleware('permission:create_role')->only(['create','store']) ;
        $this->middleware('permission:update_role')->only(['edit','update']) ;
        $this->middleware('permission:delete_role')->only(['destroy']) ;
        $this->middleware('permission:read_roles')->only(['index' , 'show']) ;
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        ;
        return view('admin.roles.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));
            return redirect()->route('roles.index')
                ->with('success', 'Role has been created successfully');
        } catch (\Exception $e) {
            return \generalException('roles.index');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = $role->Permissions;
            return view('admin.roles.show', compact('permissions'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('roles.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            return view('admin.roles.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            return \generalException('roles.index');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, string $id)
    {
        try {
            $role = Role::FindOrFail($id);
            $role->update(['name' => $request->input('name')]);
            $role->syncPermissions($request->permissions);
            return redirect()->route('roles.index')
                ->with('success', 'Role has been updated successfully');
        } catch (\Exception $e) {
            return \generalException('roles.index');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->route('roles.index')
                ->with('success', 'Role has been deleted successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            return \generalException('roles.index');
        }


    }
}