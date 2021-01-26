const checkButtons = document.querySelectorAll(".checkbox");
const deleteButtons = document.querySelectorAll(".fa-times-circle")

function checkTask() {
    const checked = this;
    const container = checked.parentElement;
    const id = container.getAttribute("id");

    fetch(`/checkTask/${id}`).then(function () {});
}

function deleteTask() {
    const deleted = this;
    const container = deleted.parentElement.parentElement;
    const id = container.getAttribute("id");
    fetch(`/deleteTask/${id}`).then(function () {
        container.remove();
    });
}

checkButtons.forEach(button => button.addEventListener("click", checkTask));
deleteButtons.forEach(button => button.addEventListener("click", deleteTask));

