function sidebarSwitch() {
    var element = document.getElementById("mainLayout");
    element.classList.toggle("sidebar-collapsed");
    document.body.classList.add('overflow-hidden-md');
}

function removeMenu() {
    var element = document.getElementById("mainLayout");
    element.classList.remove("sidebar-collapsed");
    document.body.classList.remove('overflow-hidden-md');
 }


// Tooltip 

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))