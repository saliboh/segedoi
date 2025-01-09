<?php

namespace App\Enums;

enum UserRoleTypeEnum: string
{
    case ADMIN = 'admin';
    case USER = 'client';
    case GUEST = 'financer';

    public static function toArray()
    {
        return [
            'admin' => 'admin',
            'client' => 'client',
            'financer' => 'financer',
        ];
    }
}
