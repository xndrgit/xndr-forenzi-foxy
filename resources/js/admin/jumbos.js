(function ($) {
    $(function () {
        // 👉 Admin jumbos management
        const jumbosListTbl = $('#jumbos-list-table');
        if (jumbosListTbl) {
            let jumbosTable = window.setCommonDataTable(
                '#jumbos-list-table',
                10,
                true,
                true,
                '/admin/jumbos/data',
                [
                    {data: 'id', name: 'id', width: '60px', sortable: false},
                    {data: 'order_number', name: 'order_number', searchable: false, visible: false},
                    {data: 'src', name: 'src', width: '200px', sortable: false},
                    {data: 'title', name: 'title', width: '150px', sortable: false},
                    {data: 'description', name: 'description', width: '250px', sortable: false},
                    {data: 'action', searchable: false, name: 'action'}
                ],
                (d) => {
                    d._token = window.WebCsrfToken;
                },
                [{
                    visible: false,
                    searchable: false,
                    targets: 1
                }, {
                    className: 'table-td-text-wrap',
                    targets: 4
                }],
                'asc',
                1,
                {
                    rowReorder: {
                        selector: 'tr td:not(:last-of-type).dtr-control',
                        dataSrc: 'order_number'
                    },
                    retrieve: true,
                    aaSorting: [],
                }
            );

            jumbosTable.on('row-reorder', function (e, details) {
                if (details.length) {
                    let rows = [];
                    for (let element of details) {
                        rows.push({
                            id: jumbosTable.row(element.node).data().id,
                            order_number: element.newData
                        });
                    }

                    $.ajax({
                        headers: {'x-csrf-token': window.WebCsrfToken},
                        method: 'POST',
                        url: "/admin/jumbos/reorder",
                        data: {rows}
                    }).done(function () { jumbosTable.ajax.reload() });
                }
            });
        }
    });
})(jQuery);
