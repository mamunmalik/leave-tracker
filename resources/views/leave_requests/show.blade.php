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

                        <form method="post" action="{{ route('leave_requests.update', $leaveRequest->id) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="user_id" :value="__('Employee')" />
                                <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full"
                                    :value="old('user_id', $leaveRequest->user?->name)" required autofocus disabled readonly />
                            </div>

                            <div>
                                <x-input-label for="leave_type" :value="__('Leave Type')" />
                                <select id="leave_type" name="leave_type" type="text" class="mt-1 block w-full"
                                    :value="old('leave_type', $leaveRequest - > leave_type)" required autofocus disabled
                                    readonly>
                                    @foreach (\App\Enums\LeaveType::cases() as $leave_types)
                                        <option value="{{ $leave_types->name }}" @selected($leave_types->name == $leaveRequest->leave_type)>
                                            {{ $leave_types->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                    value="{{ $leaveRequest->start_date }}" disabled readonly />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                                    :value="old('end_date', $leaveRequest->end_date)" disabled readonly />
                            </div>

                            <div>
                                <x-input-label for="leave_reason" :value="__('Leave Reason')" />
                                <x-text-input id="leave_reason" name="leave_reason" type="text"
                                    class="mt-1 block w-full" :value="old('leave_reason', $leaveRequest->leave_reason)" required disabled readonly />
                            </div>

                            <div>
                                <x-input-label for="comments" :value="__('Comments')" />
                                <x-text-input id="comments" name="comments" type="text" class="mt-1 block w-full"
                                    :value="old('comments', $leaveRequest->comments)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('comments')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Leave Type')" />
                                <select id="status" name="status" type="text" class="mt-1 block w-full"
                                    :value="old('status', $leaveRequest - > status)" required autofocus>
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
