<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
      $this->middleware(['permission:ver rol']);
      $this->middleware(['verified']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $id = Role::find($role);
        $roles = Role::paginate();
        $permissions = Permission::all()->pluck('name', 'id');

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$role = Role::create($request->all()); NO ME FUNCIONA
        $role->permissions()->sync($request->get('permissions'));

        return redirect('roles');*/

        
        /*$role = Role::create($request->all());
        
        $permissions = Permission::find($id);
        $permission = Permission::find($id);
        //$role->syncPermissions($permissions);
        $permissions->syncRoles($role);
        $role->permissions()->sync($request->get('permissions'));

        return redirect('/roles');*/
        $role = new Role;

      $role->name = $request->name;
      $role->slug = $request->slug;

      if($role->save()){
        $role->syncPermission($request->permissions);
        return redirect()->route('roles.index');}
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', [
          'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // funciona sin esto?   $roles = Role::all()->pluck('name', 'id');
        $permissions = Permission::get();
        $assignedPermissions = $role->permissions->pluck('id')->toArray(); 

        return view('roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
