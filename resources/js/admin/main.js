window.addEventListener('resize', () => {
    if (document.body.getBoundingClientRect().width > 768) {
        $('#navbarSupportedContent').removeClass('show');
        $('#background-cover').fadeOut();
    }
});

(function ($) {
    $(function () {
        $('#toggle-nav-button').on('click', function () {
            if ($(this).hasClass('collapsed')) {
                $('#background-cover').fadeIn();
            }
            else {
                $('#background-cover').fadeOut();
            }
        });

        $('#background-cover').on('click', function () {
            $('#navbarSupportedContent').removeClass('show');
            const toggleNavButton = $('#toggle-nav-button');
            toggleNavButton.addClass('collapsed');
            toggleNavButton.attr('aria-expanded', false);
            $(this).fadeOut();
        });
    });
})(jQuery);

window.setCommonDataTable = (
    tableID, pLength, responsive, fixedHeader, url, columns, dataCallback,
    columnDefs = null, order = "asc", orderNumber = 0, addOptions
) => {
    const defaultGlobalOptions = {
        pageLength: pLength,
        responsive: responsive,
        order: [[orderNumber, order]],
        fixedHeader: fixedHeader,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6 export-btn"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"d-flex align-items-center justify-content-between flex-wrap"<l><"ml-auto pr-3 w-sm-100"p>>> >',
        columnDefs: columnDefs ? [
            ...columnDefs,
            {
                targets: 'no-sort',
                orderable: false,
            }
        ] : [{
            targets: 'no-sort',
            orderable: false,
        }],
        buttons: $.extend(true, [
            {extend: 'excel', className: 'btn'}
        ], $.fn.dataTable.defaults.buttons),
        processing: true,
        serverSide: true,
        deferLoading: 0,
        lengthMenu: [5, 10, 15, 20, 25, 50],
        ajax: {
            headers: {'x-csrf-token': window.WebCsrfToken},
            url: url,
            type: 'POST',
            data: dataCallback
        },
        columns: columns
    }

    const commonServerDataTable = $(tableID).DataTable({
        ...defaultGlobalOptions,
        ...addOptions
    }).columns.adjust().responsive.recalc();

    commonServerDataTable.ajax.reload();

    return commonServerDataTable;
};
