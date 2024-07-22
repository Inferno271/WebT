const clearBtn = document.getElementsByClassName("btn-danger")[0];
const cover = document.getElementsByClassName("cover")[0];
const modal = document.getElementsByClassName("modal")[0];
const noBtn = document.querySelector('.modal__content form button[type="button"]:nth-child(2)'); // Изменяем селектор

modal.addEventListener("click", () => {
    modal.classList.remove("d-block");
    cover.classList.remove("d-block");
});

clearBtn.addEventListener("click", () => {
    modal.classList.add("d-block");
    cover.classList.add("d-block");
});

noBtn.addEventListener("click", () => {
    modal.classList.remove("d-block");
    cover.classList.remove("d-block");
});
