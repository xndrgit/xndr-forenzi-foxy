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

window.setCommonDataTable = (tableID, pLength, responsive, fixedHeader, url, columns, dataCallback) => {
    const commonServerDataTable = $(tableID).DataTable({
        pageLength: pLength,
        responsive: responsive,
        order: [[0, "asc"]],
        fixedHeader: fixedHeader,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6 export-btn"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"d-flex align-items-center justify-content-between"<l><"ml-auto pr-3"p>>> >',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false,
        }],
        buttons: [
            {extend: 'excel', className: 'btn'},
        ],
        processing: true,
        serverSide: true,
        deferLoading: 0,
        lengthMenu: [5, 10, 15, 20, 25, 50],
        ajax: {
            url: url,
            type: 'POST',
            data: dataCallback
        },
        columns: columns
    }).columns.adjust().responsive.recalc();

    commonServerDataTable.ajax.reload();

    return commonServerDataTable;
};
