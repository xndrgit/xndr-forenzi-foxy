(function ($) {
    $(function () {
        // 👉 Admin users management
        const userListTbl = $('#users-list-table');
        if (userListTbl) {
            window.setCommonDataTable(
                '#users-list-table',
                15,
                true,
                true,
                '/admin/users/data',
                [
                    {data: 'id', name: 'id'},
                    {data: 'admin', name: 'user_details.admin'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'user_details.phone'},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                }
            );
        }
    });
})(jQuery);
