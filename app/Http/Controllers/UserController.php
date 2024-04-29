<?php

namespace App\Http\Controllers;

use App\Enums\LeaveStatus;
use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard()
    {
        $totalLeaveRequests = 0;
        $totalPendingRequests = 0;
        $totalApprovedRequests = 0;
        $totalRejectedRequests = 0;

        if (Auth::user()->isAdmin()) {
            // Total leave requests
            $totalLeaveRequests = LeaveRequest::count();

            // Total pending leave requests
            $totalPendingRequests = LeaveRequest::where('status', LeaveStatus::PENDING->name)->count();

            // Total approved leave requests
            $totalApprovedRequests = LeaveRequest::where('status', LeaveStatus::APPROVED->name)->count();

            // Total rejected leave requests
            $totalRejectedRequests = LeaveRequest::where('status', LeaveStatus::REJECTED->name)->count();
        }

        return view('dashboard', compact('totalLeaveRequests', 'totalPendingRequests', 'totalApprovedRequests', 'totalRejectedRequests'));
    }

    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $users = User::where('type', 'employee')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function toggleActive(Request $request, User $user)
    {
        $user->update(['is_approved' => (bool)$request->is_approved]);

        return response()->json(['message' => 'User active status updated successfully']);
    }
}
