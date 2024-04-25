<?php

namespace App\Enums;

enum LeaveType: string
{
    case CasualLeave = 'Casual Leave';
    case SickLeave = 'Sick Leave';
    case EmergencyLeave = 'Emergency Leave';
}
