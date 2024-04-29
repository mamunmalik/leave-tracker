<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (!Auth::user()->isAdmin())
                    <div class="p-6 text-gray-900">
                        Welcome {{ Auth::user()->name }}
                    </div>
                @else
                    <div
                        class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse"
                            id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                            <li class="w-full">
                                <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab"
                                    aria-controls="stats" aria-selected="true"
                                    class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Statistics</button>
                            </li>
                        </ul>
                        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">

                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats"
                                role="tabpanel" aria-labelledby="stats-tab">
                                <dl
                                    class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-4 dark:text-white sm:p-8">
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl font-extrabold">{{ $totalLeaveRequests }}</dt>
                                        <dd  class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Number of Leave Requests</dd>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl font-extrabold">{{ $totalPendingRequests }}</dt>
                                        <dd class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Number of Pending Requests</dd>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl font-extrabold">{{ $totalApprovedRequests }}</dt>
                                        <dd class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Number of Approved Requests</dd>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl font-extrabold">{{ $totalRejectedRequests }}</dt>
                                        <dd class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Number of Rejected Requests</dd>
                                    </div>
                                </dl>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
