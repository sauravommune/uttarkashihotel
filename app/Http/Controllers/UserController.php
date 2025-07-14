<?php

namespace App\Http\Controllers;

use App\DataTables\AllUserDataTable;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(AllUserDataTable $dataTable)
    {
        $title = 'All Users';
        $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name')->get();
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('users.index', compact('title', 'roles'));
    }

    public function create()
    {
        $data['title'] = 'User Create';
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('users.create', compact('roles'));
    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'affiliate_code' => generateReferralCode()
        ]);

        if ($request->has('roles')) {
            $user->roles()->attach($request->input('roles'));
        }
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::where('name', '!=', 'Super Admin')->get();

        return view('users.edit', compact('user', 'roles'), $data);
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'roles' => 'required|array',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->affiliate_code = ! $user->affiliate_code ? generateReferralCode() : DB::raw('affiliate_code');

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if (!empty($validatedData['roles'])) {
            $user->roles()->sync($validatedData['roles']);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function updateStatus(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->status = $request->status=='active'?1:0;
            $user->save();
            return response()->json(['status' => 200, 'message' => 'Status Updated Successfully'], 200);
        }

        return response()->json(['status' => 400,'message' => 'User Nothing'], 400);
    }
}
