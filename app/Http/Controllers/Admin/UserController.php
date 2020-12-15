<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of users.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $name = $request->get('name');
        $users = User::name($name)->paginate();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole($request->role);

        toast('Usuario creado correctamente', 'success');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->role);
        $user->save();

        toast('Usuario actualizado correctamente', 'success');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back();
    }

    /**
     * Enable or disable the status of a user.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function changeStatus(int $id): RedirectResponse
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect(route('admin.users.index'));
    }
}
