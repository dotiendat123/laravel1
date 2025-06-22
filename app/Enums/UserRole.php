<?php

namespace App\Enums;

enum UserRole: string
{
    case User   = 'user';
    case Admin  = 'admin';
    case Editor = 'editor';
    case Guest  = 'guest';

    public function label(): string
    {
        return match ($this) {
            self::User   => 'Người dùng',
            self::Admin  => 'Quản trị viên',
            self::Editor => 'Biên tập viên',
            self::Guest  => 'Khách truy cập',
        };
    }
}
