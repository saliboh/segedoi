<?php

namespace App\Enums;

enum UserRoleTypeEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case FINANCER = 'financer';

    public static function toArray()
    {
        return [
            'admin' => 'admin',
            'client' => 'client',
            'financer' => 'financer',
        ];
    }
}
