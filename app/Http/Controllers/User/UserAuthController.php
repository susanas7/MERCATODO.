<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Order;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    /**
     * Shows authenticated user data.
     *
     * @return View
     */
    public function myProfile(): View
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Shows authenticated user data.
     *
     * @return View
     */
    public function editMyProfile(): View
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
    public function updateMyProfile(UpdateRequest $request): RedirectResponse
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
     * @return View
     */
    public function myOrders(): View
    {
        $orders = Order::where('user_id', '=', auth()->user()->id, null)->paginate();

        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Generate an api token.
     * @return RedirectResponse
     */
    public function newApiToken(): RedirectResponse
    {
        if (auth()->user()->can('api')) {
            $user = User::where('id', '=', auth()->user()->id)->first();

            $user->update([
            'api_token' => Str::random(80),
            ]);

            return back();
        }
        return back();
    }

    /**
     * Remove current token api.
     * @return RedirectResponse
     */
    public function deleteApiToken(): RedirectResponse
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->update([
            'api_token' => null,
        ]);

        return back();
    }
}
