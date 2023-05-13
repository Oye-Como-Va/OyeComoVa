import * as bootstrap from "bootstrap";
import "./bootstrap";
import moment from "moment";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

document.addEventListener("DOMContentLoaded", function (event) {
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
              <textarea name="note" placeholder="Escribe tu nota aquí..."></textarea>
              <input type="color" name="color" value = "#FFFFCC"/>
              <input type="hidden" name="working_id" value="${working_id}"/>
              <button type="submit">Guardar</button>
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
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener("click", () => {
                // show navbar
                nav.classList.toggle("showMenu");
                // change icon
                toggle.classList.toggle("bx-x");
                // add padding to body
                bodypd.classList.toggle("body-pd");
                // add padding to header
                headerpd.classList.toggle("body-pd");
            });
        }
    };

    showNavbar("header-toggle", "nav-bar", "body-pd", "header");

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll(".nav_link");

    function colorLink() {
        if (linkColor) {
            linkColor.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));

    //CALENDAR:

    const createTask = new bootstrap.Modal(
        document.getElementById("createTask")
    );

    let calendarEl = document.getElementById("calendar");
    let calendar = new FullCalendar.Calendar(calendarEl, {
        locale: "es",
        initialView: "dayGridMonth",
        height: "auto",
        firstDay: 1, //para que el día de la semana empiece en lunes
        headerToolbar: {
            //definimos la cabecera del calendario
            left: "prev,next",
            center: "title",
            right: "dayGridMonth timeGridWeek",
        },
        events: tasks, //las tareas vienen de calendar.blade, que vienen del controlador de tareas show_tasks
        selectable: true,
        editable: true,
        dateClick: function (info) {
            //con dateClick capturamos el día en el que clica el usuario
            //controlamos que no pueda ser anterior a hoy
            let date = info.dateStr;
            let today = moment(new Date()).format("YYYY-MM-DD");
            if (date >= today) {
                //creamos el modal con la fecha introducida:
                document.getElementById("date").value = date;
                createTask.show();
            }
        },
        eventDrop: function (info) {
            //esta función captura cuando un evento es arrastro a otro día. Por tanto, es un update de la fecha
            let id = info.event.id;
            let date = moment(info.event.start).format("YYYY-MM-DD");
            let url = urlUpdate.replace("taskId", id); //la url de la ruta la definimos en la view de calendar

            $.ajax({
                url: url,
                type: "PUT",
                headers: { "X-CSRF-Token": tokenUpdate },
                dataType: "json",
                data: { date },
                success: function (response) {
                    toastr.success(response.message, "¡Listo!");
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message, "Error");
                },
            });
        },
        eventClick: function (info) {
            //eventClick captura cuando se clica en un evento
            const editTask = new bootstrap.Modal(
                document.getElementById("editTask")
            );

            let id = info.event.id;
            let url = urlEdit.replace("taskId", id);
            let urlSave = urlSaveChanges.replace("taskId", id);
            let urlToDelete = urlDelete.replace("taskId", id);
            let date = moment(info.event.start).format("YYYY-MM-DD");
            let startTime = moment(info.event.start).format("HH:mm");
            let endTime = moment(info.event.end).format("HH:mm");

            $.ajax({
                url: url,
                type: "GET",
                headers: { "X-CSRF-Token": tokenUpdate },
                dataType: "json",
                success: function ({ taskEdit, subject, course }) {
                    console.log(taskEdit);
                    document
                        .getElementById("formEdit")
                        .setAttribute("action", urlSave);
                    $("#nameEdit").val(taskEdit.name);
                    $("#descriptionEdit").val(taskEdit.description);
                    $("#dateEdit").val(date);
                    $("#start_timeEdit").val(startTime);
                    $("#end_timeEdit").val(endTime);
                    document
                        .getElementById("formDelete")
                        .setAttribute("action", urlToDelete);
                    if (subject !== null) {
                        let option = document.createElement("option");
                        option.value = subject.id;
                        option.text = subject.name;
                        option.setAttribute("selected", true);
                        $("#subjectEdit").append(option);

                        let optionCourse = document.createElement("option");
                        optionCourse.value = course.id;
                        optionCourse.text = course.name;
                        optionCourse.setAttribute("selected", true);
                        $("#courseEdit").append(optionCourse);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message, "Error");
                },
            });
            editTask.show();
        },
        windowResize: function (view) {
            if (view.name === "agendaWeek") {
                $("#calendar").fullCalendar(
                    "option",
                    "height",
                    $(window).height() - 100
                );
            }
        },
    });
    calendar.render();
});
