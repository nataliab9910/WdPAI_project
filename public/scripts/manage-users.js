function addEvents() {
    const deleteUserButtons = document.querySelectorAll(".del-user");
    const deletePhotoButtons = document.querySelectorAll(".del-photo");
    const giveAdminButtons = document.querySelectorAll(".give-admin")
    const giveUserButtons = document.querySelectorAll(".give-user")

    deleteUserButtons.forEach(button => button.addEventListener("click", deleteUser));
    deletePhotoButtons.forEach(button => button.addEventListener("click", deletePhoto));
    giveAdminButtons.forEach(button => button.addEventListener("click", giveAdmin));
    giveUserButtons.forEach(button => button.addEventListener("click", giveUser));
}

function deleteUser() {
    const toDelete = this;
    const container = toDelete.parentElement;
    const id = container.getAttribute("id");
    console.log(id);
    fetch(`/deleteUser/${id}`)
        .then(function () {
            container.remove();
        })
}

function deletePhoto() {
    const toDelete = this;
    const container = toDelete.parentElement;
    const id = container.getAttribute("id");

    fetch(`/deletePhoto/${id}`)
        .then(function () {
            const photo = container.querySelector("img");
            photo.src = '/public/img/user.png'
        })
}

function giveAdmin() {
    const user = this;
    const container = user.parentElement;
    const id = container.getAttribute("id");
    fetch(`/giveAdmin/${id}`)
        .then(function () {
            const role = container.querySelector(".role");
            role.innerHTML = 'admin';
        })
}

function giveUser() {
    const user = this;
    const container = user.parentElement;
    const id = container.getAttribute("id");

    fetch(`/giveUser/${id}`)
        .then(function () {
            const role = container.querySelector(".role");
            role.innerHTML = 'user';
        })
}

setInterval(addEvents, 3000);
