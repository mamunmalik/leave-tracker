<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Request Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Leave Request Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Fill your leave request information.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('leave_requests.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="leave_type" :value="__('Leave Type')" />
                                <select id="leave_type" name="leave_type" type="text" class="mt-1 block w-full"
                                    :value="old('leave_type', null)" required autofocus autocomplete="off">
                                    @foreach (\App\Enums\LeaveType::cases() as $leave_types)
                                        <option value="{{ $leave_types->name }}">{{ $leave_types->value }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>
                            
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                    :value="old('start_date', null)" autocomplete="off" />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                                    :value="old('end_date', null)" autocomplete="off" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>

                            <div>
                                <x-input-label for="leave_reason" :value="__('Leave Reason')" />
                                <x-text-input id="leave_reason" name="leave_reason" type="text"
                                    class="mt-1 block w-full" :value="old('leave_reason', null)" required autocomplete="off" />
                                <x-input-error class="mt-2" :messages="$errors->get('leave_reason')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'leave-request-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
