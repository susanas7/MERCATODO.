<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        //$this->authorize('viewAny', auth()->user());
        $name = $request->get('name');
        $users = User::name($name)->paginate();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //$this->authorize('create', auth()->user());
        $roles = Role::all()->pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            $user->assignRole($request->role);
            if ($user->hasAnyRole('Super-administrador')) {
                $user->api_token = Str::random(50);
                $user->save();
            }

            toast('Usuario creado correctamente','success');
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        //$this->authorize('viewAny', auth()->user());
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        //$this->authorize('update', auth()->user());
        $roles = Role::all()->pluck('name', 'id');

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->role);
        if ($user->hasAnyRole('Super-administrador')) {
            $user->api_token = Str::random(50);
            $user->save();
        }

        $user->save();

        toast('Usuario actualizado correctamente','success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$this->authorize('create', auth()->user());
        $user->delete();

        return back();
    }

    /**
     * Enable or disable the status of a user.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function changeStatus(int $id)
    {
        //$this->authorize('update', auth()->user());
        $user = User::find($id);

        $user->is_active = !$user->is_active;

        if ($user->save()) {
            return redirect(route('users.index'));
        }

        return redirect(route('users.index'));
    }
}
