<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_permission()
    {
        return view('admin.add_permission');
    }
    public function add_role_page()
    {
        return view('admin.add_role', [
            'permissions' => Permissions::all()
        ]);
    }
    public function add_new_user()
    {
        return view('admin.add_new_user', [
            'roles' => Role::all()
        ]);
    }
    public function add_role(Request $request)
    {

        $request->validate([
            'role_name' => 'required',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->input('role_name')]);

        if ($request->has('permissions')) {
            $role->permissions()->attach($request->input('permissions'));
        }

        return redirect()->back();
    }
    public function show_report()
    {
        return view('admin.report', [
            'attendances' => Attendance::all(), 'users' => User::all()
        ]);
    }
    public function assign_role_to_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $role = Role::where('name', $request->role)->first();

        $user->assignRole($role);

        return redirect()->back();
    }




    public function store_permission(Request $request)
    {
        $data = $request->validate([
            'permission_name' => 'required',

        ]);
        Permissions::create([
            'name' => $data['permission_name'],
        ]);

        return redirect()->back();
    }
}
