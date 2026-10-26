$('#activityLogsTable').DataTable({
    pageLength: 5,
    lengthMenu: [10, 25, 50, 100],
    searching: true,
    ordering: true,
    order: [[0, 'desc']],
    paging: true,
    info: true,
    autoWidth: false,
    language: {
        emptyTable: "No activity logs found.",
        search: "Search logs:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ logs",
        infoEmpty: "Showing 0 to 0 of 0 logs",
        zeroRecords: "No matching activity logs found."
    }
});