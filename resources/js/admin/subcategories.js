(function ($) {
    $(function () {
        // 👉 Admin orders management
        const subcategoriesListTbl = $('#subcategories-list-table');
        if (subcategoriesListTbl) {
            window.setCommonDataTable(
                '#subcategories-list-table',
                10,
                true,
                true,
                '/admin/subcategories/data',
                [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                }
            );
        }
    });
})(jQuery);
