<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Notifications\TempPasswordNotification;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user();
        $users = User::whereNot('email', $auth_user->email)->get();
        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }

    public function pending()
    {
        return Inertia::render('Users');
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
}
