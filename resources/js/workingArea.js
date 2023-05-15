import "./bootstrap";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

document.addEventListener("DOMContentLoaded", function (event) {
    function tiempo_transcurrido() {
        let hoursSpan = document.getElementById("transcurrido_hours");
        let minutesSpan = document.getElementById("transcurrido_minutes");
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
        let hoursSpan = document.getElementById("restante_hours");
        let minutesSpan = document.getElementById("restante_minutes");

        // Obtenemos la hora actual y la hora final como objetos Date
        let now = new Date();

        // Calculamos la diferencia en segundos entre la hora final y la hora actual
        let diff = Math.floor((end - now) / 1000);

        // Si la diferencia es menor que 0, el contador ha llegado a su fin
        if (diff <= 0) {
            toastr.warning("¡Ya deberías haber terminado!", "Ups");
            hoursSpan.innerText = "--";
            minutesSpan.innerText = "--";
            return;
        }

        let hours = Math.floor(diff / 3600);
        let minutes = Math.floor((diff % 3600) / 60);

        // Para respetar el formato hh:mm:ss, añadimos un 0 delante si es de 1 dígito
        hoursSpan.innerText = hours < 10 ? "0" + hours : hours;
        minutesSpan.innerText = minutes < 10 ? "0" + minutes : minutes;

        // Esperamos un segundo y actualizamos el contador
        setTimeout(() => countdown(end), 60000);
    }

    function stringToTime(string) {
        const [hours, minutes] = string.split(":");

        const time = new Date();
        time.setHours(hours);
        time.setMinutes(minutes);
        time.setSeconds(0);

        return time;
    }
    let end = document.getElementById("end_time").textContent;
    let start = document.getElementById("start_time").textContent;
    let durationInput = document.getElementById("duration");
    let startReal = document.getElementById("start_time_real").textContent;

    const endTime = stringToTime(end);
    const startTime = stringToTime(start);
    const startRealTime = stringToTime(startReal);

    let duration = endTime - startTime;

    const hoursDuration = Math.floor(duration / 3600000);
    let minutesDuration = Math.floor((duration % 3600000) / 60000);
    durationInput.innerHTML = `${hoursDuration}h ${minutesDuration}m`;

    const newEnd = new Date(startRealTime.getTime() + duration);

    const expected_end = document.getElementById("expected_end");
    expected_end.innerText = newEnd.toLocaleTimeString("es-ES", {
        hour: "numeric",
        minute: "numeric",
    });

    countdown(newEnd);
    const list = document.getElementById("notes");

    // Agregar un controlador de eventos al enlace "add-item"
    document
        .querySelector(".add-item")
        .addEventListener("click", function (event) {
            document
                .querySelector(".add-item")
                .parentElement.classList.add("d-none");
            event.preventDefault();

            // Crear un nuevo elemento del formulario
            const newItem = document.createElement("li");
            const formId = `createNote_${Date.now()}`;

            newItem.innerHTML = `
          <div class="note-container">
            <form action="${urlNote}" method="POST" id="${formId}">
            <div class = "d-flex flex-column h-100 gap-2">
              <textarea name="note" placeholder="Escribe tu nota aquí..."></textarea>
              <input type="color" class = "w-100" name="color" value = "#FFFFCC"/>
              <input type="hidden" name="working_id" value="${working_id}"/>
              <button class = "btn btn-main" type="submit">Guardar</button></div>
            </form>
          </div>
        `;

            // Agregamos el nuevo posit
            list.insertBefore(newItem, this.parentNode);

            // Agregar un controlador de eventos al formulario para enviar la nota
            const form = document.getElementById(formId);
            form.addEventListener("submit", async function (event) {
                event.preventDefault();

                const formData = new FormData(form);

                try {
                    const response = await fetch(urlNote, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": token },
                        body: formData,
                    });
                    if (response.ok) {
                        const { note } = await response.json();
                        const noteList = document.querySelector("#notes");
                        const noteItem = document.createElement("li");
                        noteItem.innerHTML = `
                        <p>${note.note}</p>
                        `;
                        noteList.insertBefore(noteItem, noteList.firstChild);
                        noteItem.style.backgroundColor = note.color;
                        newItem.remove();
                    } else {
                        toastr.success(response.message, "¡Listo!");
                    }
                } catch (error) {
                    toastr.error(response.responseJSON.message, "Error");
                }

                form.reset();
                document
                    .querySelector(".add-item")
                    .parentElement.classList.remove("d-none");
            });
        });
});
