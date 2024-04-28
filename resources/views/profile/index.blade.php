<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Employee name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Start Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        End Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Leave Reason
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Comments
                                    </th>
                                    @if (auth()->user()->isAdmin())
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->id }}
                                        </th>
                                        <th class="px-6 py-4">
                                            {{ $item->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->email }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $item->end_date->format('jS M, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->leave_reason }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusColor="";
                                                switch ($item->status) {
                                                    case \App\Enums\LeaveStatus::PENDING->name:
                                                        $statusColor="yellow";
                                                        break;
                                                    case \App\Enums\LeaveStatus::APPROVED->name:
                                                        $statusColor="green";
                                                        break;
                                                    case \App\Enums\LeaveStatus::REJECTED->name:
                                                        $statusColor="red";
                                                        break;
                                                    default:
                                                        $statusColor="blue";
                                                        break;
                                                }
                                            @endphp
                                            <span class="bg-{{$statusColor}}-100 text-{{$statusColor}}-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-{{$statusColor}}-300 border border-{{$statusColor}}-400">{{ \App\Enums\LeaveStatus::{$item->status}->value }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->comments }}
                                        </td>
                                        @if (Auth::user()->isAdmin())
                                            <td class="px-6 py-4 text-right">
                                                @if ($item->status == \App\Enums\LeaveStatus::PENDING->name)
                                                    <a href="{{ route('leave_requests.show', $item->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Approval</a>
                                                @endif
                                            </td>
                                        @endif --}}
                                    </tr>
                                @empty
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            colspan="8">
                                            No data
                                        </th>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
