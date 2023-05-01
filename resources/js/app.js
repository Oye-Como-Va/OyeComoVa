import * as bootstrap from "bootstrap";
import "./bootstrap";
import moment from "moment";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

document.addEventListener("DOMContentLoaded", function (event) {
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
        initialView: "dayGridMonth",
        height: "auto",
        locale: "es",
        firstDay: 1, //para que el día de la semana empiece en lunes
        headerToolbar: {
            //definimos la cabecera del calendario
            left: "prev,next",
            center: "title",
            right: "dayGridMonth timeGridWeek",
        },
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
        events: tasks, //las tareas vienen de calendar.blade, que vienen del controlador de tareas show_tasks
        selectable: true,
        editable: true,
        eventDrop: function (info) {
            //esta función captura cuando un evento es arrastro a otro día. Por tanto, es un update de la fecha
            console.log(info.event.start);
            let id = info.event.id;
            let date = info.dateStr;
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
            const editTask = new bootstrap.Modal(
                document.getElementById("editTask")
            );

            let id = info.event.id;
            let url = urlEdit.replace("taskId", id);
            let urlSave = urlSaveChanges.replace("taskId", id);
            let date = moment(info.event.start).format("YYYY-MM-DD");
            let startTime = moment(info.event.start).format("HH:mm");
            
            // Endtime me está cogiendo la hora actual: 
            // let endTime = moment(info.end).format("HH:mm"); 



            $.ajax({
                url: url,
                headers: { "X-CSRF-Token": tokenSave },
                type: "GET",
                headers: { "X-CSRF-Token": tokenUpdate },
                dataType: "json",
                success: function ({ taskEdit, subject }) {
                    console.log(taskEdit);
                    document
                        .getElementById("formEdit")
                        .setAttribute("action", urlSave);
                    $("#nameEdit").val(taskEdit.name);
                    $("#descriptionEdit").val(taskEdit.description);
                    $("#dateEdit").val(date);
                    $("#start_timeEdit").val(startTime);
                    $("#end_timeEdit").val(endTime);

                    if (subject !== null) {
                        let option = document.createElement("option");
                        option.value = subject.id;
                        option.text = subject.name;
                        option.setAttribute("selected", true);
                        console.log(option);
                        $("#subjectEdit").append(option);
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
