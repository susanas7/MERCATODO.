<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of roles.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::query()
            ->forIndex()
            ->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return View
     */
    public function create(): View
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
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
     * Display the specified role.
     *
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        return view('admin.roles.show', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Role $role): RedirectResponse
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->syncPermissions($request->input('permissions'));
        $role->save();

        toast('Rol actualizado correctamente', 'success');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->delete();

        return back();
    }
}
