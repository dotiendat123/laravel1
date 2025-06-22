<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserStatus;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }
    // protected $redirectTo = '/register';
    public function store(RegisterUserRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Tạo user
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'email'      => $request->email,
                    'password'   => $request->password, // đã được hash auto nếu dùng 'hashed' cast
                    'status'     => UserStatus::Pending,
                    'role'       => UserRole::User,
                ]);

                // Gửi email cảm ơn sau 10s (delay trong queue)
                SendWelcomeEmail::dispatch($user)->delay(now()->addSeconds(10));
            });

            return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
        } catch (\Exception $e) {
            return back()->withErrors(['register_error' => 'Đăng ký thất bại: ' . $e->getMessage()]);
        }
        // $user = User::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     // 'password' => Hash::make($request->password),
        //     'password' => $request->password,
        //     'status' => UserStatus::Pending,
        //     'role' => UserRole::User,
        // ]);

        // // Gửi email cảm ơn
        // // SendWelcomeEmail::dispatch($user);
        // SendWelcomeEmail::dispatch($user)->delay(now()->addSeconds(10));
        // return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
        // // return redirect()->route('home');

    }
}
