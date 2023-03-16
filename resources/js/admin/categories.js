(function ($) {
    $(function () {
        // 👉 Admin categories management
        const categoriesListTbl = $('#categories-list-table');
        if (categoriesListTbl) {
            window.setCommonDataTable(
                '#categories-list-table',
                10,
                true,
                true,
                '/admin/categories/data',
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
