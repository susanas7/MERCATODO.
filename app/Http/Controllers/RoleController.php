<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

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
     * @param App\Role $role
     *
     * @return \Illuminate\View\View
     */
    public function index(Role $role)
    {
        $id = Role::find($role);
        $roles = Role::paginate();
        $permissions = Permission::all()->pluck('name', 'id');

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', [
            'role' => $role,
        ]);
    }
}
