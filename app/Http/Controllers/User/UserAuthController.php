<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;

class UserAuthController extends Controller
{
    /**
     * Shows authenticated user data.
     *
     * @return \Illuminate\View\View
     */
    public function myProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Shows authenticated user data.
     *
     * @return \Illuminate\View\View
     */
    public function editMyProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('user.editMyProfile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function updateMyProfile(UpdateRequest $request)
    {
        $user = User::where('id', '=', auth()->user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.myProfile', ['user' => $user]);
    }

    /**
     * Lists all orders of the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id, null)->paginate();

        return view('admin.orders.index', ['orders' => $orders]);
    }
}
