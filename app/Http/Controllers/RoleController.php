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
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //$this->authorize('viewAny', auth()->user());
        $roles = Role::paginate();
        $permissions = Permission::all()->pluck('name', 'id');

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        //$this->authorize('create', auth()->user());
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

        toast('Rol creado correctamente','success');
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
        //$this->authorize('viewAny', auth()->user());

        return view('roles.show', [
            'role' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        //$this->authorize('update', auth()->user());
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        toast('Rol actualizado correctamente','success');
        return redirect()->route('roles.index');
    }

    public function destroy(int $id)
    {
        //$this->authorize('create', auth()->user());
        $role = Role::find($id);
        $role->delete();

        return back();
    }
}
