<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
      $this->middleware(['role:super-admin|editor|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $name = $request->get('name');
      $email = $request->get('email');

      $users = User::name($name)->email($email)->paginate(10);
      return view('users.index', ['users' => $users]);

      /*$users = User::name($request->name)
        ->orderBy('id', 'asc')
        ->paginate(5);
      return view('users.index', ['users' => $users]);*/


      /*$users = User::paginate(20);
            return view('users.index',[
        'users' => $users
      ]);*/


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
    public function store(Request $request)
    {
      
      $user = new User;

      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);

      if($user->save()){
        $user->assignRole($request->role);
        return redirect('/users');
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
    public function edit(User $user)
    {
      $roles = Role::all()->pluck('name', 'id');  
      return view('users.edit', compact('roles'))->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != null){
          $user->password = $request->password;
        }
        $user->syncRoles($request->role);
        $user->save();

        return redirect('/users');
  
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
}
