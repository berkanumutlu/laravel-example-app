$(document).ready(function () {

    "use strict";

    $('#datatable1').DataTable();

    $('#datatable2').DataTable({
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false
    });

    $('#datatable3').DataTable({
        "scrollX": true
    });

    if ($('.data-table').length > 0) {
        $('.data-table tfoot th').each(function () {
            var title = $(this).text();
            if (title !== null && title !== '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
            }
        });

        // DataTable
        $('.data-table').DataTable({
            pageLength: 20,
            lengthMenu: [10,15,20,25,30,40,50,75,100],
            order: [0, 'desc'],
            initComplete: function () {
                // Apply the search
                this.api().columns().every(function () {
                    var that = this;
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
    }
});
