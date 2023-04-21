@extends('templates.general')

@section('calendar')
    <h4 class="text-start">Calendario</h4>


    <div id='calendar'></div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '80vh',
                locale: 'es'
            });
            calendar.render();
        });
    </script>
@endsection
