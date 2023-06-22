<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Notifications\TempPasswordNotification;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user();
        $users = User::whereNot('email', $auth_user->email)->where('role_id', '!=', 1)->get();
        return Inertia::render('Users', [
            'users' => $users,
            'page' => 'users',
        ]);
    }

    public function pending()
    {
        $auth_user = Auth::user();
        $users = User::whereNot('email', $auth_user->email)->where('role_id', '!=', 1)->where('status', '!=', 'ACTIVE')->get();
        return Inertia::render('Users', [
            'users' => $users,
            'page' => 'pending',
        ]);

    }

    public function view(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user) {
            return to_route('users.list');
        }

        return Inertia::render('Users/Profile', [
            'user' => $user,
            'provinces' => config('provinces'),
            'timezones' => config('timezones'),
        ]);

    }

    public function approve(Request $request)
    {
        $data = $request->validate(['user_id' => 'required']);
        $user = User::where('id', $data['user_id'])->first();
        $user->status = 'ACTIVE';
        $user->save();
    }

    public function lock(Request $request)
    {
        $data = $request->validate(['user_id' => 'required']);
        $user = User::where('id', $data['user_id'])->first();
        $user->status = 'LOCKED';
        $user->save();
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'provinces' => config('provinces'),
            'timezones' => config('timezones'),
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $temp_password = rand(99999, 9999999);

        $user = User::create([
            'name' => $request->first_name . " " . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'province' => $request->province,
            'timezone' => $request->timezone,
            'email' => $request->email_address,
            'password' => Hash::make($temp_password),
            'temp_password' => $temp_password,
            'requires_password_update' => true,
        ]);

        $user->notify((new WelcomeNotification())->delay(now()->addSeconds(30)));
        $user->notify((new TempPasswordNotification($temp_password))->delay(now()->addSeconds(30)));

        return Redirect::route('users.list');

    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();

        $user = User::where('id', $request->user_id)->update([
            'name' => $request->first_name . " " . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'province' => $request->province,
            'timezone' => $request->timezone,
        ]);

        return back();

    }
}
