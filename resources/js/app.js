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
            document.getElementById("date").value = info.dateStr;
            createTask.show();
        },
        events: tasks, //las tareas vienen de calendar.blade, que vienen del controlador de tareas show_tasks
        selectable: true,
        editable: true,
        eventDrop: function (info) {
            console.log(info.event.start);
            let id = info.event.id;
            let date = moment(info.event.start).format("YYYY-MM-DD");
            let urlDelete = urlUpdate.replace("taskId", id);

            $.ajax({
                url: urlDelete,
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
