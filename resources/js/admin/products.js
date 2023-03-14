(function ($) {
    $(function () {
        // 👉 Admin products management
        const productsListTbl = $('#products-list-table');
        if (productsListTbl) {
            window.setCommonDataTable(
                '#products-list-table',
                10,
                true,
                true,
                '/admin/products/data',
                [
                    {data: 'id', name: 'id'},
                    {data: 'category_name', name: 'categories.name'},
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'length', name: 'length'},
                    {data: 'width', name: 'width', visible: false},
                    {data: 'height', name: 'height', visible: false},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                },
                [{
                    targets: [5, 6],
                    visible: false,
                }]
            );
        }
    });
})(jQuery);
