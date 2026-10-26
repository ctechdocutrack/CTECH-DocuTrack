$('#usersTable').DataTable({
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    ordering: false,
    paging: true,
    info: true,
    autoWidth: false,
    language: {
        search: "Search documents:",
        searchPlaceholder: "Enter keyword...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ documents",
        infoEmpty: "Showing 0 to 0 of 0 documents",
        zeroRecords: "No matching documents found",
        emptyTable: "No documents available",
        paginate: {
            previous: "Previous",
            next: "Next"
        }
    },
    columnDefs: [
        {
            orderable: false,
            searchable: false,
            targets: 2
        }
    ]
});
