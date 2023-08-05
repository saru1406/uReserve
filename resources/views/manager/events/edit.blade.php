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

                    <form method="POST" action="{{ route('events.update',[ 'event' => $event->id ]) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="event_name" value="イベント名" />
                            <x-input id="event_name" class="block mt-1 w-full" type="text" name="event_name"
                                value="{{$event->name}}" required autofocus autocomplete="username" />
                        </div>

                        <div>
                            <x-label for="information" value="イベント詳細" />
                            <x-textarea row="3" id="information" class="block mt-1 w-full" name="information">
                                {{ $event->information }}</x-textarea>
                        </div>
                        <div class="md:flex justify-between mt-3">

                            <div>
                                <x-label for="event_date" value="日付" />
                                <x-input id="event_date" class="block mt-1 w-full" type="text" name="event_date"
                                    value="{{$editEventDate}}" required />
                            </div>

                            <div>
                                <x-label for="start_time" value="開始日時" />
                                <x-input id="start_time" class="block mt-1 w-full" type="text" name="start_time"
                                    value="{{$event->startTime}}" required />
                            </div>

                            <div>
                                <x-label for="end_time" value="終了日時" />
                                <x-input id="end_time" class="block mt-1 w-full" type="text" name="end_time"
                                    value="{{$event->endTime}}" required />
                            </div>
                        </div>
                        <div class="md:flex justify-between mt-3">
                            <div>
                                <x-label for="max_people" value="定員数" />
                                <x-input id="max_people" class="block mt-1 w-full" type="number" name="max_people"
                                    value="{{$event->max_people}}" required />
                            </div>
                            <div class="md:flex justify-around">
                                <input type="radio" name="is_visible" value="1" @if( $event->is_visible === 1 )checked @endif>表示
                                <input type="radio" name="is_visible" value="0" @if( $event->is_visible === 0 )checked @endif>非表示
                            </div>
                            <x-button class="ml-4">
                                更新
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
