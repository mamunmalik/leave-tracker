<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\LeaveType;
use App\Enums\LeaveStatus;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Mail\LeaveRequestMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveRequestApprovedMail;
use App\Mail\LeaveRequestRejectedMail;
use App\Http\Requests\LeaveCreateRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leave_requests = LeaveRequest::with('user');

        //employee get history for his/her own
        if (!Auth::user()->isAdmin()) {
            $leave_requests->where('user_id', Auth::id());
        }
        $leave_requests = $leave_requests->paginate(10);
        return view('leave_requests.index', compact('leave_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->back();
        }
        return view('leave_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth()->id();
        $leaveRequestObj = LeaveRequest::create($data);

        $data['name'] = Auth()->user()->name;
        $data['leave_type'] = LeaveType::{$request->leave_type}->value;
        $data['start_date'] = $leaveRequestObj->start_date->format('jS M, Y');
        $data['end_date'] = $leaveRequestObj->end_date->format('jS M, Y');

        Mail::to(Auth()->user()->email, Auth()->user()->name)->send(new LeaveRequestMail($data));

        return redirect()
            ->route('leave_requests.index')
            ->with('flash_success', "Leave request created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $leaveRequest)
    {
        return view('leave_requests.show', compact('leaveRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'comments' => ['required', 'string'],
            'status' => ['required', Rule::in(array_column(LeaveStatus::cases(), 'name'))],
        ]);

        if ($leaveRequest->update($validated)) {
            $data = [];

            $userObj = User::find($leaveRequest->user_id);

            $data['name'] = $userObj->name;
            $data['leave_type'] = LeaveType::{$leaveRequest->leave_type}->value;
            $data['start_date'] = $leaveRequest->start_date->format('jS M, Y');
            $data['end_date'] = $leaveRequest->end_date->format('jS M, Y');
            $data['leave_reason'] = $leaveRequest->leave_reason;
            $data['comments'] = $request->comments;
            
            if ($request->status == LeaveStatus::APPROVED->name) {
                Mail::to($userObj->email, $userObj->name)->send(new LeaveRequestApprovedMail($data));
            } else {
                Mail::to($userObj->email, $userObj->name)->send(new LeaveRequestRejectedMail($data));
            }

            return redirect()
                ->route('leave_requests.index')
                ->with('flash_success', "Leave request updated successfully!");
        } else {
            return redirect()->back();
        }
    }
}
