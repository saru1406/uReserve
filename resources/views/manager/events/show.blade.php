<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <x-label for="event_name" value="イベント名" />
                        {{ $event->name }}
                    </div>

                    <div>
                        <x-label for="information" value="イベント詳細" />
                        {{ $event->information }}
                    </div>
                    <div class="md:flex justify-between mt-3">

                        <div>
                            <x-label for="event_date" value="日付" />
                            {{ $event->eventDate }}
                        </div>

                        <div>
                            <x-label for="start_time" value="開始日時" />
                            {{ $event->startTime }}
                        </div>

                        <div>
                            <x-label for="end_time" value="終了日時" />
                            {{ $event->endTime }}
                        </div>
                    </div>
                    <div class="md:flex justify-between mt-3">
                        <div>
                            <x-label for="max_people" value="定員数" />
                            {{ $event->max_people }}
                        </div>
                        <div class="md:flex justify-around">
                            {{ $event->is_visible }}
                        </div>
                        @if ($event->eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                            <button onclick="location.href='{{ route('events.edit', ['event' => $event->id]) }}'"
                                class="flex mb-4 ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">編集</button>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-3">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <th
                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約者名</th>
                            <th
                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                        </thead>
                        @foreach ($reservations as $reservation)
                        @if (!$users->isEmpty() && $reservation['canceled_date'] === null)
                            @if (is_null($reservation['canceled_date']))
                            <tbody>
                                <td>{{ $reservation['name'] }}</td>
                                <td>{{ $reservation['number_of_people'] }}</td>
                            </tbody>
                            @endif
                        @endif
                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
