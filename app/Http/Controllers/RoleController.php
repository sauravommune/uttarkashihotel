<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        addVendors(['datatable']);
        $data['title'] = 'Roles list';
        return $dataTable->render('roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);

        $data['title'] = 'Roles Create';
        $permissions = Permission::get();
        $permission = [];
        $role = null;
        $rolePermission = [];
        foreach ($permissions as $key => $val) {
            $name = explode('-', $val['name']);
            $key = implode(' ', array_slice($name, 0, -1));

            $permission[$key][] = $val;
        }
        return view('roles.create', compact('permission', 'role', 'rolePermission'), $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $request->id,
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permission')
        );

        $role = Role::updateOrCreate(['id' => $request->id], ['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);
        return response()->json(['status' => 200, 'message' => "Update Successfully"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {

        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);


        $data['title'] = 'Edit Role';
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermission = $role?->permissions->pluck('id')->toArray();
        foreach ($permissions as $key => $val) {
            $name = explode('-', $val['name']);
            $key = implode(' ', array_slice($name, 0, -1));

            $permission[$key][] = $val;
        }

        return view('roles.create', compact('role', 'permissions', 'rolePermission', 'permission'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permissions')
        );

        $role->syncPermissions($permissionsID);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
