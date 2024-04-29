<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Request Approval') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Leave Request Approval') }}
                            </h2>
                        </header>

                        <div class="bg-white shadow-md rounded-lg p-4">
                            <div class="font-bold text-lg">Leave Request Information</div>
                            <div class="mt-2">Employee Name: {{ $leaveRequest->user?->name }}</div>
                            <div class="mt-1">Leave Type: {{ \App\Enums\LeaveType::{$leaveRequest->leave_type}->value }}</div>
                            <div class="mt-1">Start Date: {{ $leaveRequest->start_date->format('jS M, Y') }}</div>
                            <div class="mt-1">End Date: {{ $leaveRequest->end_date->format('jS M, Y') }}</div>
                            <div class="mt-1">Leave Reason: {{ $leaveRequest->leave_reason }}</div>
                        </div>

                        <form method="post" action="{{ route('leave_requests.update', $leaveRequest->id) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="comments" :value="__('Comments')" />
                                <x-text-input id="comments" name="comments" type="text" class="mt-1 block w-full"
                                    :value="old('comments', $leaveRequest->comments)" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('comments')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Leave Type')" />
                                <select id="status" name="status" type="text" class="mt-1 block w-full"
                                    :value="old('status', $leaveRequest->status)" required autofocus>
                                    @foreach (\App\Enums\LeaveStatus::cases() as $status)
                                        @if ($status->name != \App\Enums\LeaveStatus::PENDING->name)
                                            <option value="{{ $status->name }}">{{ $status->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
