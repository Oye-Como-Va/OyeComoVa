@extends('templates.general')

@section('workingAreaActive')
    <div class="workingArea d-flex  flex-column gap-3">
        <div>
            <h5 class="h5-0 m-0">{{ $task->name }}</h5>
            <h5 class="h5-0 m-0">{{ $task->description }}</h5>
        </div>
        @if (isset($task->subject))
            <div class="text-end">
                <h5 class="h5-0 m-0">{{ $task->subjects->course->name }}</h5>
                <h5 class="h5-0 m-0 d-flex flex-row align-items-center gap-2"><i class="bx bxs-circle"
                        style="color: {{ $task->subjects->color }}"></i>{{ $task->subject->name }}</h5>
            </div>
        @endif

        <div class="timeControl">
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">INICIO PROGRAMADO</p><span class="p-0 m-0"
                    id="start_time">{{ substr($task->pivot->start_time, 0, 5) }}</span>
                <p class="p-0 m-0">INICIO REAL</p><span class="p-0 m-0"
                    id="start_time_real">{{ substr($start_time_real, 0, 5) }}</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">TRANSCURRIDO</p>
                <span class="p-0 m-0 text-warning" id="transcurrido">
                    <span id="transcurrido_hours"></span>
                    <span>:</span>
                    <span id="transcurrido_minutes"></span>
                </span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">RESTANTE</p>
                <span class="p-0 m-0 text-warning" id="transcurrido">
                    <span id="restante_hours"></span>
                    <span>:</span>
                    <span id="restante_minutes"></span>
                </span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">FIN PROGRAMADO</p><span class="p-0 m-0 text-success"
                    id="end_time">{{ substr($task->pivot->end_time, 0, 5) }}</span>
                <p class="p-0 m-0">FIN ESPERADO</p><span class="p-0 m-0 text-success" id="expected_end"></span>
            </div>
        </div>

        <div class="notesArea">
            <ul id="notes">
                <li>
                    <a href="#" class="add-item justify-content-center align-items-center">
                        <i class='bx bx-plus fw-bold'></i>
                    </a>
                </li>
            </ul>
        </div>
        <form action={{ route('end_task') }} method="POST">
            @csrf
            <input type="hidden" value={{ $task->id }} name="task_id" />
            <input type="hidden" value={{ $working_id }} name="working_id" />
            <button type="submit">TERMINAR</button>
        </form>
    </div>
    @vite(['resources/js/workingArea.js'])
@endsection
<script>
    const working_id = "{{ $working_id }}";
    const urlNote = "{{ route('create_note') }}";
    const token = "{{ csrf_token() }}";
    //WorkingArea cronómetro:
    document.addEventListener("DOMContentLoaded", function(event) {
        function tiempo_transcurrido() {
            let hoursSpan = document.getElementById('transcurrido_hours');
            let minutesSpan = document.getElementById('transcurrido_minutes');
            let seconds = 0;

            hoursSpan.innerText = "00";
            minutesSpan.innerText = "00";

            function start() {
                setInterval(change, 60000);
            }

            function change() {
                seconds += 60;
                console.log(seconds);
                let minutes = Math.floor(seconds / 60);
                let hours = Math.floor(minutes / 60);

                // Para respetar el formato hh:mm, añadimos un 0 delante si es de 1 dígito:
                hoursSpan.innerText = hours < 10 ? "0" + hours : hours;
                minutesSpan.innerText =
                    minutes % 60 < 10 ? "0" + (minutes % 60) : minutes % 60;
            }

            start();
        }
        tiempo_transcurrido();

        function countdown(end) {
            let hoursSpan = document.getElementById('restante_hours');
            let minutesSpan = document.getElementById('restante_minutes');

            // Obtenemos la hora actual y la hora final como objetos Date
            let now = new Date();

            // Calculamos la diferencia en segundos entre la hora final y la hora actual
            let diff = Math.floor((end - now) / 1000);

            // Si la diferencia es menor que 0, el contador ha llegado a su fin
            if (diff <= 0) {
                alert('Ya deberías haber terminado :(');
                hoursSpan.innerText = "00";
                minutesSpan.innerText = "00";
                return
            }

            let hours = Math.floor(diff / 3600);
            let minutes = Math.floor((diff % 3600) / 60);
            let seconds = diff % 60;

            // Para respetar el formato hh:mm:ss, añadimos un 0 delante si es de 1 dígito
            hoursSpan.innerText = hours < 10 ? "0" + hours : hours;
            minutesSpan.innerText = minutes < 10 ? "0" + minutes : minutes;

            // Esperamos un segundo y actualizamos el contador
            setTimeout(() => countdown(end), 60000);
        }

        function stringToTime(string) {
            const [hours, minutes, seconds] = string.split(':');

            const time = new Date();
            time.setHours(hours);
            time.setMinutes(minutes);
            time.setSeconds(00);

            return time;
        }
        let end = document.getElementById('end_time').textContent;
        let start = document.getElementById('start_time').textContent;

        let startReal = document.getElementById('start_time_real').textContent;

        const endTime = stringToTime(end);
        const startTime = stringToTime(start);
        const startRealTime = stringToTime(startReal);

        let duration = endTime - startTime;

        const newEnd = new Date(startRealTime.getTime() + duration);

        const expected_end = document.getElementById('expected_end');
        expected_end.innerText = newEnd.toLocaleTimeString('es-ES', {
            hour: 'numeric',
            minute: 'numeric'
        });

        countdown(newEnd);
    });
</script>
