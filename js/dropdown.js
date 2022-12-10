document.addEventListener("DOMContentLoaded", () => {
    let table = document.getElementsByTagName('tbody')[0];
    table.addEventListener("click", (e) => {
        if (e.target.classList.contains("nome")) {
            e.target.parentElement.classList.toggle("dropped");
        }
    })
});