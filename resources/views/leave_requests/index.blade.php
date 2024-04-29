<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Request History') }}
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
                                        Leave Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
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
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leave_requests as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->id }}
                                        </th>
                                        <th class="px-6 py-4">
                                            {{ $item->user?->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ constant("\App\Enums\LeaveType::$item->leave_type")->value }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->start_date->format('jS M, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->end_date->format('jS M, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->leave_reason }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch ($item->status)
                                                @case(\App\Enums\LeaveStatus::PENDING->name)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">{{ constant("\App\Enums\LeaveStatus::$item->status")->value }}</span>
                                                    @break;
                                                @case(\App\Enums\LeaveStatus::APPROVED->name)
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ constant("\App\Enums\LeaveStatus::$item->status")->value }}</span>
                                                    @break;
                                                @case(\App\Enums\LeaveStatus::REJECTED->name)
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">{{ constant("\App\Enums\LeaveStatus::$item->status")->value }}</span>
                                                    @break;
                                                @default
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">{{ constant("\App\Enums\LeaveStatus::$item->status")->value }}</span>
                                                    @break;
                                            @endswitch
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
                                        @endif
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
                            {{ $leave_requests->links() }}
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
