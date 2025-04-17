$(document).ready(function () {
    $('#EasyOrdersTable').DataTable();
});

$(document).ready(function () {
    $('#UsersListTable').DataTable({
        columnDefs: [
            { targets: "_all", defaultContent: ""}
        ]
    });
});

$(document).ready(function () {
    $('#ManageProducts').DataTable();
});

