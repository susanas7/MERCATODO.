<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::query()
            ->forIndex()
            ->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(CreateRequest $request)
    {
        $role = new Role;

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        toast('Rol creado correctamente', 'success');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', [
            'role' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        toast('Rol actualizado correctamente', 'success');
        return redirect()->route('admin.roles.index');
    }

    public function destroy(int $id)
    {
        $role = Role::find($id);
        $role->delete();

        return back();
    }
}
