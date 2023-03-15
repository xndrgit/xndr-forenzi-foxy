(function ($) {
    $(function () {
        // 👉 Admin products management

        // 👉 Product list table
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
                }],
                'desc'
            );
        }

        // 👉 Show subcategory when changing category on product create/update page.
        let oldCategoryID = null;

        const productCategorySel = $('#select-product-category');
        if (productCategorySel) {
            oldCategoryID = productCategorySel.val();

            productCategorySel.on('change', function () {
                changeCategory(this);
            });
        }

        // 👉 update subcategory dynamic
        function changeCategory(param) {
            const selectedCategoryID = param.value;
            hideOldSubcategories(selectedCategoryID);
            oldCategoryID = selectedCategoryID;
        }

        // 👉 Hide old subcategories
        function hideOldSubcategories(selectedCategoryID) {
            let subcategoryCheckboxes = document.querySelectorAll("input[type='checkbox'].subcategory-form-checkbox");
            if (subcategoryCheckboxes && subcategoryCheckboxes.length) {
                for (let subcategoryCheckbox of subcategoryCheckboxes) {
                    subcategoryCheckbox.checked = false;
                }
            }

            document.querySelector("#subcategory-pack-" + oldCategoryID).style.display = 'none';
            document.querySelector("#subcategory-pack-" + selectedCategoryID).style.display = '';
        }
    });
})(jQuery);
