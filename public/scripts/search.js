const search = document.querySelector('input[placeholder="search user"]');
const userContainer = document.querySelector(".users");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (users) {
            userContainer.innerHTML = "";
            loadUsers(users);
        });
    }
});

function loadUsers(users) {
    users.forEach(user => {
        console.log(user);
        createUser(user);
    });
}

function createUser(user) {
    const template = document.querySelector("#user-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = user.id;
    const photo = clone.querySelector("img");
    photo.src = user.photo;
    const name = clone.querySelector(".name");
    name.innerHTML = user.name;
    const email = clone.querySelector(".email");
    email.innerHTML = user.email;
    const role = clone.querySelector(".role");
    role.innerHTML = user.role;

    userContainer.appendChild(clone);
}