<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use App\UserData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Session;

use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
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
    public function index(Request $request)
    {
        $name = $request->get('name');

        $users = User::name($name)->paginate();

        return view('users.index', [ 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
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

            return redirect()->route('users.index');
        }
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
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $roles = Role::all()->pluck('name', 'id');
        $user = User::find($id);
        $userData = UserData::where('user_id', $id);

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = UserData::where('user_id', $id);
        //$userData = UserData::find($id);

        //UserData::where('user_id',$id)->update(['document' => $request->document]);

        //no actualizar los datos de UserData
        $user->name = $request->name;
        $user->email = $request->email;
        //$user->data->document = $request->document;
        $data->document = $request->document;
        $user->syncRoles($request->role);
        $user->save();

        //return redirect()->route('users.index');
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
    public function changeStatus($id)
    {
        $user = User::find($id);

        $user->is_active = !$user->is_active;

        if ($user->save()) {
            return redirect(route('users.index'));
        }

        return redirect(route('users.index'));
    }

    public function search()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->get();

        return view('search', ['users' => $users]);
    }

    public function myProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('users.show', ['user' => $user]);

    }
}
