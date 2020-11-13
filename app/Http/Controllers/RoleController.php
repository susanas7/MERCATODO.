<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Gestor de usuarios|Super-administrador']);
        $this->middleware(['verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::paginate();
        $permissions = Permission::all()->pluck('name', 'id');

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(CreateRequest $request)
    {
        $role = new Role;

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        return redirect()->route('roles.index');
    }

    public function destroy(int $id)
    {
        $role = Role::find($id);
        $role->delete();

        return back();
    }
}
