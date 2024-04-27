<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        LeaveRequest::create($data);

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
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $leaveRequest->update($request->all());

        return redirect()
            ->route('leave_requests.index')
            ->with('flash_success', "Leave request updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        //
    }
}
