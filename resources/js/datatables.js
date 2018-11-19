// Datatables Employee













$('#setupBranchTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        "<'row'<'col-md-6'><'col-md-6'>>" +
        "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Copy'
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'clearfix btn-outline-primary rounded-0',
            titleAttr: 'Show/Hide Column'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-outline-success',
            titleAttr: 'Export CSV'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-outline-info',
            titleAttr: 'Print'
        },
    ]

});