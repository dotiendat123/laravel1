<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) return $next($request);

        // Dùng enum để kiểm tra trạng thái tài khoản
        switch ($user->status) {
            case UserStatus::Locked:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
                ]);

            case UserStatus::Pending:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Tài khoản của bạn đang chờ phê duyệt.'
                ]);

            case UserStatus::Rejected:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Tài khoản của bạn đã bị từ chối.'
                ]);

            case UserStatus::Approved:
                // Cho phép tiếp tục
                return $next($request);
        }

        // Phòng trường hợp không đúng enum
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Tài khoản không hợp lệ.'
        ]);
    }
}
