
<div>
{{--    <x-dialog-modal id="eventModal" wire:model="showModal">--}}
{{--        <x-slot name="title">--}}
{{--            <h2>{{ is_null($newAttendance['id']) ? 'Nieuw event' : 'Bewerk event' }}</h2>--}}
{{--            <h2>Voorkeur trainer</h2>--}}
{{--        </x-slot>--}}
{{--        <x-slot name="content">--}}
{{--            <div>--}}
{{--                <x-label for="title" value="{{ __('Gebruiker') }}"/>--}}
{{--                <x-input id="title" class="block mt-1 w-full" type="text"--}}
{{--                         wire:model.defer="newAttendance.title" required autofocus--}}
{{--                         autocomplete="title"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label type="hidden" for="weekday_id" value="{{ __('Dag van de week') }}"/>--}}
{{--                <x-input type="hidden" id="weekday_id" class="block mt-1 w-full" type="text"--}}
{{--                         wire:model.defer="newAttendance.weekday_id" required autofocus--}}
{{--                         autocomplete="weekday_id"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label for="present_start" value="{{ __('Aanwezig van') }}"/>--}}
{{--                <x-input id="present_start" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.start" required autofocus--}}
{{--                         autocomplete="start"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label for="present_end" value="{{ __('Aanwezig tot') }}"/>--}}
{{--                <x-input id="present_end" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.end" required autofocus--}}
{{--                         autocomplete="end"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label for="absent_start" value="{{ __('Afwezig van') }}"/>--}}
{{--                <x-input id="absent_start" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.absent_start" required autofocus--}}
{{--                         autocomplete="absent_start"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label for="absent_end" value="{{ __('Afwezig tot') }}"/>--}}
{{--                <x-input id="absent_end" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.absent_end" required autofocus--}}
{{--                         autocomplete="absent_end"/>--}}
{{--            </div>--}}
{{--        </x-slot>--}}
{{--        <x-slot name="footer">--}}
{{--            <div class="text-center">--}}
{{--                <x-secondary-button @click="showModal = false">Annuleer</x-secondary-button>--}}
{{--                @if(is_null($newAttendance['id']))--}}
{{--                    <x-button wire:click="createAttendance({{ $newAttendance['id'] }})" wire:loading.attr="disabled" class="ml-2 bg-blue-500">Opslaan</x-button>--}}
{{--                @else--}}
{{--                    <x-button class="ml-2 bg-green-500" wire:click="updateAttendance({{ $newAttendance['id'] }})" wire:loading.attr="disabled">Update event</x-button>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </x-slot>--}}
{{--    </x-dialog-modal>--}}


    @props(['events'])
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
    </div>




@push('script')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/nl.js'></script>
    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            // var containerEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');
            var events = @json($events);
            console.log(events);
            var checkbox = document.getElementById('drop-remove');


            var calendar = new Calendar(calendarEl, {
                locale: 'nl',
                buttonText: { month: "maand", week: "week", day: "dag", },
                allDayText: 'Hele dag',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                editable: true,
                selectable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                events: @json($events),
                eventRender: function(info) {
                    // Check if the event is a planned event
                    // if (info.event.extendedProps.type === 'planned') {
                    //     info.el.style.backgroundColor = '#FFA07A'; // Set the background color
                    // }
                },






            });

            calendar.render();


        });

    </script>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
</div>
{{--    <style>--}}

{{--        html, body {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        #external-events {--}}
{{--            /*position: fixed;*/--}}
{{--            /*z-index: 2;*/--}}
{{--            /*top: 20px;*/--}}
{{--            /*left: 20px;*/--}}
{{--            /*width: 150px;*/--}}
{{--            /*padding: 0 10px;*/--}}
{{--            /*border: 1px solid #ccc;*/--}}
{{--            /*background: #eee;*/--}}
{{--        }--}}

{{--        .demo-topbar + #external-events { /* will get stripped out */--}}
{{--            top: 60px;--}}
{{--        }--}}

{{--        #external-events .fc-event {--}}
{{--            cursor: move;--}}
{{--            margin: 3px 0;--}}
{{--        }--}}

{{--        #calendar-container {--}}
{{--            position: relative;--}}
{{--            z-index: 1;--}}
{{--            margin-left: 200px;--}}
{{--        }--}}

{{--        #calendar {--}}
{{--            max-width: 1100px;--}}
{{--            margin: 20px auto;--}}
{{--        }--}}

{{--    </style>--}}
@endpush
{{--<div>--}}
{{--<x-smod.calender :events="$events"></x-smod.calender>--}}
{{--@props(['events'])--}}
{{--    <div wire:ignore id="calender" >--}}
{{--    </div>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />--}}
{{--    <div class="w-full md:w-11/12 lg:w-10/12 mt-5 mb-5">--}}
{{--        <div class="w-full lg:w-auto">--}}
{{--            <x-button type="button" wire:click="setNewAttendance()">Wanneer afwezig</x-button>--}}
{{--        </div>--}}
{{--        <div wire:ignore id="calender">--}}
{{--        </div>--}}
{{--        <div id="draggable-calendar">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--<x-dialog-modal  id="eventModal"--}}
{{--                 wire:model="showModal">--}}
{{--    <x-slot name="title">--}}
{{--        <h2>{{ is_null($newAttendance['id']) ? 'Nieuw event' : 'Bewerk event' }}</h2>--}}
{{--        <h2>Voorkeur trainer</h2>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="content">--}}
{{--            <div>--}}
{{--                <x-label for="present_start" value="{{ __('Van') }}"/>--}}
{{--                <x-input id="present_start" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.present_start" required autofocus--}}
{{--                         autocomplete="present_start"/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <x-label for="present_end" value="{{ __('Tot') }}"/>--}}
{{--                <x-input id="present_end" class="block mt-1 w-full" type="time"--}}
{{--                         wire:model.defer="newAttendance.present_end" required autofocus--}}
{{--                         autocomplete="present_end"/>--}}
{{--            </div>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="footer">--}}
{{--        <div class="text-center">--}}
{{--            <x-secondary-button @click="showModal = false">Annuleer</x-secondary-button>--}}
{{--            @if(is_null($newAttendance['id']))--}}
{{--                <x-button wire:click="createNewAttendance" wire:loading.attr="disabled" class="ml-2 bg-blue-500">Opslaan</x-button>--}}
{{--            @else--}}
{{--                <x-button color="success" wire:click="updatedNewAttendance({{ $newAttendance['id'] }})" wire:loading.attr="disabled" class="ml-2 bg-blue-500">Update event</x-button>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </x-slot>--}}
{{--</x-dialog-modal>--}}
{{--    <div class="container">--}}
{{--        <div class="flex flex-col items-center">--}}
{{--            <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>--}}
{{--            <div class="w-full md:w-11/12 lg:w-10/12 mt-5 mb-5">--}}
{{--                <div id="calendar"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@push('script')--}}
{{--    <script defer src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>--}}
{{--        <script defer src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>--}}
{{--        <script defer src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/nl.js'></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>--}}
{{--        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}

{{--        <script defer>--}}

{{--        import {Draggable} from "@fullcalendar/interaction";--}}

{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            var calendarEl = document.getElementById('calender');--}}
{{--            var draggableEl = document.getElementById('draggable-calendar');--}}
{{--            var calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                locale: 'nl',--}}
{{--                header: {--}}
{{--                    left: 'prev, next today',--}}
{{--                    center: 'title',--}}
{{--                    right: 'month, agendaWeek, agendaDay',--}}
{{--                },--}}
{{--                --}}{{--initialView: '{{ $attributes["initial-view"] ?? "dayGridMonth" }}',--}}
{{--                initialView: 'dayGridMonth',--}}
{{--                // initialView: 'timeGridWeek',--}}
{{--                nowIndicator: {{ $attributes["now-indicator"] ?? "false" }},--}}
{{--                events: @json($events),--}}
{{--                eventRender: function(info) {--}}
{{--                    // Check if the event is a planned event--}}
{{--                    if (info.event.extendedProps.type === 'planned') {--}}
{{--                        info.el.style.backgroundColor = '#FFA07A'; // Set the background color--}}
{{--                    }--}}

{{--                },--}}
{{--                eventClick: function(info) {--}}
{{--                    console.log(info.event.id)--}}
{{--                    window.livewire.emit('openModal', info.event.id);--}}
{{--                    window.livewire.emit('createNewAttendance');--}}

{{--                    window.livewire.emit('newAttendanceUpdated');--}}
{{--                    // alert('Event: ' + info.event.title);--}}
{{--                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);--}}
{{--                    // alert('View: ' + info.view.type);--}}

{{--                    // change the border color just for fun--}}
{{--                    info.el.style.borderColor = 'red';--}}
{{--                },--}}
{{--            });--}}
{{--            calendar.render();--}}
{{--            new Draggable(draggableEl);--}}

{{--            // add event listener for month mode button--}}
{{--            document.getElementById('month-mode').addEventListener('click', function() {--}}
{{--                calendar.changeView('dayGridMonth');--}}
{{--            });--}}

{{--            document.getElementById('week-mode').addEventListener('click', function() {--}}
{{--                calendar.changeView('timeGridWeek');--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

{{--</div>--}}
