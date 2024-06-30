@props(['events'])
<div wire:ignore id="calender" {{ $attributes }}></div>



@push('script')
    <script defer src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script defer>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calender');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: '{{ $attributes["initial-view"] ?? "dayGridMonth" }}',
                nowIndicator: {{ $attributes["now-indicator"] ?? "false" }},
                events: @json($events),
                eventRender: function(info) {
                    // Check if the event is a planned event
                    if (info.event.extendedProps.type === 'planned') {
                        info.el.style.backgroundColor = '#FFA07A'; // Set the background color
                    }

                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                }
            });
            calendar.render();

        });

    </script>
@endpush
