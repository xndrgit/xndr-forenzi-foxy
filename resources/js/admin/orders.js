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
                    {data: 'email', name: 'users.email'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'order_date', name: 'order_date'},
                    {data: 'status', name: 'status'},
                    {data: 'payment_status', name: 'payments.payment_status'},
                    {data: 'total', name: 'total'},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                },
                null,
                'desc'
            );
        }
    });
})(jQuery);
