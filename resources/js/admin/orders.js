(function ($) {
    $(function () {
        // 👉 Admin orders management
        const ordersListTbl = $('#orders-list-table');
        if (ordersListTbl) {
            window.setCommonDataTable(
                '#orders-list-table',
                10,
                true,
                true,
                '/admin/orders/data',
                [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'color', name: 'color'},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                }
            );
        }
    });
})(jQuery);
