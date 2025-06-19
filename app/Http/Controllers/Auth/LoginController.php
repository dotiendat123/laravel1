<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Enums\UserStatus;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->status === UserStatus::Locked) {
                return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa.']);
            }

            if ($user->status === UserStatus::Pending) {
                return back()->withErrors(['email' => 'Tài khoản của bạn đang chờ phê duyệt.']);
            }

            if ($user->status === UserStatus::Rejected) {
                return back()->withErrors(['email' => 'Tài khoản của bạn đã bị từ chối.']);
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('posts.index')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}
