$(document).ready(
    function () {
        // 👉 Admin users management
        const userListTbl = $('#users-list-table');
        if (userListTbl) {
            const userListTable = userListTbl.DataTable({
                pageLength: 15,
                responsive: true,
                order: [[0, "asc"]],
                fixedHeader: true,
                dom: '<"row"<"col-md-12"<"row"<"col-md-6 export-btn"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"l><"col-md-7"p>>> >',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
                buttons: [
                    {extend: 'excel', title: 'User List', className: 'btn'},
                ],
                processing: true,
                serverSide: true,
                deferLoading: 0,
                lengthMenu: [5, 10, 15, 20, 25, 50],
                ajax: {
                    url: '/admin/users/data',
                    type: 'POST',
                    data: (d) => {
                        d._token = window.WebCsrfToken;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'admin', name: 'user_details.admin'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'user_details.phone'},
                    {data: 'action', searchable: false, name: 'action'}
                ]
            }).columns.adjust().responsive.recalc();

            userListTable.ajax.reload();
        }
    }
);
