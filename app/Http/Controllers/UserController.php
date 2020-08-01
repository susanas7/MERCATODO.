<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$name = $request->get('name');
        $email = $request->get('email');

        $users = User::name($name)->email($email)->paginate(10);
        return view('users.index', ['users' => $users]);*/
        $data = Cache::rememberForever('bigX', function(){
            return User::all();
        });
        $name = $request->get('name');
        $email = $request->get('email');

        $users = User::name($name)->email($email)->paginate(505);
        return view('users.index', ['users' => $users, 'data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $user = new User;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', [
          'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all()->pluck('name', 'id');
        $user = User::find($id);
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->role);
        $user->save();

        //return redirect('/users');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }


    public function changeStatus($id)
    {
        $user = User::find($id);
      
        $user->is_active=!$user->is_active;

        if ($user->save()) {
            return redirect(route('users.index'));
        } else {
            return redirect(route('users.index'));
        }
    }
}
