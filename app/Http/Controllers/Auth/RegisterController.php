<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserStatus;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendWelcomeEmail;
class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => UserStatus::Pending,
            'role' => 'user',
        ]);

        // Gửi email cảm ơn
        SendWelcomeEmail::dispatch($user);
        // SendWelcomeEmail::dispatch($user)->delay(now()->addSeconds(10));
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
        // return redirect()->route('home');
    }
}
