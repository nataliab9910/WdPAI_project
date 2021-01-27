const deleteButtons = document.querySelectorAll(".fa-times-circle");

function deleteLesson() {
    const deleted = this;
    const container = deleted.parentElement.parentElement;
    const id = container.getAttribute("id");
    fetch(`/deleteLesson/${id}`).then(function () {
        container.remove();
    });
}

deleteButtons.forEach(button => button.addEventListener("click", deleteLesson));
