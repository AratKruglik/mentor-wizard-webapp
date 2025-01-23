<?php

namespace App\Enums;

enum RoleEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case SUPER_ADMIN = 'superadmin';
    case MENTOR = 'mentor';
    case MENTI = 'menti';
    case COACH = 'coach';
}
