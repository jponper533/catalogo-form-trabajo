const toggle = document.getElementById("nav_toggle");
const menu = document.getElementById("nav_items");

toggle.addEventListener("click", (e) => {
    e.stopPropagation(); 
    toggle.classList.toggle("close");
    menu.classList.toggle("open");
});

menu.addEventListener("click", (e) => {
    if (!e.target.closest("#nav_toggle")) {
        e.stopPropagation();
    }
});
