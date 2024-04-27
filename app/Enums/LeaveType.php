<?php

namespace App\Enums;

enum LeaveType: string
{
    case CASUAL = "Casual Leave";
    case SICK = "Sick Leave";
    case EMERGENCY = "Emergency Leave";
}
