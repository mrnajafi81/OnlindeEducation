let sidebar = document.getElementById('sidebar');
let sidebarCollapse = document.querySelector('.sidebar-collapse');

sidebarCollapse.onclick = function () {
    sidebar.classList.toggle('collapse-status');
}
