import "./bootstrap";
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
});
